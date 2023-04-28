<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi_bee_cloud;
use App\Models\doutlet;
use App\Models\list_item_bee_cloud;
use App\Models\list_sales;
use App\Models\satuan;
use App\Models\sinkronisasi_transaksi_bee_cloud;
use App\Models\tanggal_all;
use App\Models\transaksi_bee_cloud;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class api_bee_cloud_controller extends Controller
{
    //
    // Token atau kunci API yang diperlukan untuk autentikasi
    private $token = 'eyJ0eXAiOiJKV1MiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcHAuYmVlY2xvdWQuaWQiLCJqdGkiOiI4MjcwZWM0MGRlN2NmMmMwNjRkODgzOGEyZWIwMDk2NyIsImRibmFtZSI6IjE4NDAyYXJpc3RyYXZlbG9rYSIsImRiaG9zdCI6IjEwLjEzMC4yLjE1NyIsInVzZXJfaWQiOiIzIn0.BpU5CqCQY8wWNGhjzDc3YpRhmQ6Z_POt8KsBLXGCGXo';
    private $context;

    function __construct()
    {
        // Menambahkan header Authorization pada permintaan GET
        $options = array(
            'http' => array(
                'header' => "Authorization: Bearer $this->token\r\n"
            )
        );

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $this->context = stream_context_create($options);
    }

    public function getAllTransaction()
    {
        // $this->getItemBee();
        $urlGetTransaksi = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/sale';
        $data = file_get_contents($urlGetTransaksi, false, $this->context);
        $result = json_decode($data);
        // @dd(json_encode($result));
        // @dd($result);

        //Dapatkan semua list_sales dan masukkan ke variabel $listSalesAll dengan format (id_channel_bee_cloud,id)
        $listSalesAll = [];
        $list_sales = list_sales::all();
        for ($i = 0; $i < $list_sales->count(); $i++) {
            $listSalesTemp = [];
            array_push($listSalesTemp, $list_sales[$i]->id_channel_bee_cloud, $list_sales[$i]->id);
            array_push($listSalesAll, $listSalesTemp);
        }

        //Dapatkan data dari akhir transaksi, ini merupakan acuan dasar dari id bee cloud saat akan masuk ke sistem
        $lastTransaksi = transaksi_bee_cloud::orderBy('id_transaksi_bee_cloud', 'DESC')->first();
        // @dd($lastTransaksi);

        //Buat sebuah array untuk menampung semua data yang valid sebelum kemudian dimasukkan ke database
        $allDataInsertTransaksi = [];

        //$doutletDB berisi semua outlet
        $doutletDB = doutlet::all();

        //$listSalesDB berisi semua list sales
        $listSalesDB = list_sales::all();

        //Dapatkan semua tanggal di database dan masukkan ke array $tanggalAll
        $tanggalAll = [];
        $tanggal_all = tanggal_all::all();
        for ($i = 0; $i < $tanggal_all->count(); $i++) {
            array_push($tanggalAll, [
                $tanggal_all[$i]->id,
                $tanggal_all[$i]->Tanggal
            ]);
        }

        // @dd($result);
        //Lakukan looping untuk semua transaksi, dan jangan dimasukkan ke database jika data tersebut sudah ada
        foreach ($result->data as $item) {
            //Cari didalam transaksi ada atau tidak data untuk id tertentu berdasarkan id transaksi dalam bee cloud
            // @dd($item);
            if ($lastTransaksi != null) {
                if ($lastTransaksi->id_transaksi_bee_cloud >=  $item->id) {
                    continue;
                }
            }

            list($date, $time) = explode(' ', $item->trxdate);

            //Cari tanggal di tabel tanggal all dan dapatkan id nya
            $loopFoundTanggal = false;
            $idFoundTanggal = 0;
            $id_outlet = 0;
            $id_list_sales = 0;

            foreach ($tanggalAll as $loopSearchTanggal) {
                if (strtotime($loopSearchTanggal[1]) == strtotime($date)) {
                    $loopFoundTanggal = true;
                    $idFoundTanggal = $loopSearchTanggal[0];
                    break;
                }
            }
            if (!$loopFoundTanggal) {
                $tanggalTempDB = new tanggal_all();
                $tanggalTempDB->Tanggal = $date;
                $tanggalTempDB->save();
                array_push($tanggalAll, [
                    $tanggalTempDB->id,
                    $tanggalTempDB->Tanggal
                ]);
                $idFoundTanggal = $tanggalTempDB->id;
            }

            foreach ($doutletDB as $loopOutlet) {
                if ($loopOutlet->branch_id_bee_cloud == $item->branch_id) {
                    $id_outlet = $loopOutlet->id;
                    break;
                }
            }
            foreach ($listSalesDB as $loopListSales) {
                if ($loopListSales->id_channel_bee_cloud == $item->channel_id) {
                    $id_list_sales = $loopListSales->id;
                    break;
                }
            }

            array_push($allDataInsertTransaksi, [
                'id_tanggal' => $idFoundTanggal,
                'time' => $time,
                'total' => (int)$item->subtotal,
                'id_transaksi_bee_cloud' => $item->id,
                'trxno_bee_cloud' => $item->trxno,
                'id_outlet' => $id_outlet,
                'id_list_sales' => $id_list_sales,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        // $allDataInsertTransaksi = array_chunk($allDataInsertTransaksi,10);
        $allDataInsertTransaksi = array_slice($allDataInsertTransaksi, 0, 100);
        // @dd($allDataInsertTransaksi);
        transaksi_bee_cloud::insert($allDataInsertTransaksi);
        echo 'Success update transaction';
    }


    public function sinkronisasiTransaksi()
    {
        // $this->getAllTransaction();
        $step = 10;
        $startIteration = 0;
        $sinkronTransaksi = sinkronisasi_transaksi_bee_cloud::orderBy('id', 'DESC')->first();
        $lastIdTransaksi = transaksi_bee_cloud::orderBy('id', 'DESC')->first()->id;
        $listItemDB = list_item_bee_cloud::all();
        if ($sinkronTransaksi != null) {
            $startIteration = $sinkronTransaksi->end_transaksi_id;
        }
        for ($i = $startIteration; $i < $lastIdTransaksi; $i = $i + $step) {
            $transaksiBeeClouds = transaksi_bee_cloud::skip($i)->take($step)->get();
            $countData = 0;
            $tempDataToSend = [];
            foreach ($transaksiBeeClouds as $transaksiBeeCloud) {
                $countData = $countData + 1;

                // URL API yang ingin diambil datanya
                $urlData = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/saled?';
                $urlData .= 'sale_id=';
                $urlData .= $transaksiBeeCloud->id_transaksi_bee_cloud;
                $urlData .= '&';
                $urlData .= 'sale_no=';
                $urlData .= $transaksiBeeCloud->trxno_bee_cloud;

                // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
                $data = file_get_contents($urlData, false, $this->context);
                // Mengubah respons JSON menjadi objek PHP dengan json_decode()
                $result = json_decode($data);
                $dataArray = $result->data->data;

                foreach ($dataArray as $dataLoop) {
                    $temp_qty = (int)$dataLoop->qty;
                    $temp_total = (int)$dataLoop->subtotal;
                    $temp_id_transaksi = $transaksiBeeCloud->id;
                    $temp_id_list_item = 0;
                    foreach ($listItemDB as $loopListItem) {
                        if ($loopListItem->bee_cloud_item_id == $dataLoop->item_id) {
                            $temp_id_list_item = $loopListItem->id;
                            break;
                        }
                    }
                    array_push($tempDataToSend,[
                        'id_transaksi' => $temp_id_transaksi,
                        'id_list_item' => $temp_id_list_item,
                        'qty' => $temp_qty,
                        'total' => $temp_total,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            detail_transaksi_bee_cloud::insert($tempDataToSend);

            $sinkronisasiTransaksi = new sinkronisasi_transaksi_bee_cloud();
            $sinkronisasiTransaksi->start_transaksi_id = $i + 1;
            $sinkronisasiTransaksi->end_transaksi_id = $i + $countData;
            $sinkronisasiTransaksi->save();
        }
        echo 'Success update detail transaction';
    }

    public function getItemBee()
    {
        // $this->getSatuanBee();
        ///   Program Berikut Untuk Update Item Agar Sama Dengan Item Pada Bee Cloud ////
        // URL API yang ingin diambil datanya
        $urlItem = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/item';

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $data = file_get_contents($urlItem, false, $this->context);

        // Mengubah respons JSON menjadi objek PHP dengan json_decode()
        $result = json_decode($data);
        // print_r(json_encode($result));

        $arrayItem = [];
        $itemDB = list_item_bee_cloud::all();
        foreach ($itemDB as $eachItem) {
            array_push($arrayItem, [
                $eachItem->bee_cloud_item_id,
                $eachItem->id
            ]);
        }

        $arraySatuan = [];
        $satuanDB = satuan::all();
        foreach ($satuanDB as $eachSatuan) {
            array_push($arraySatuan, [
                $eachSatuan->satuan,
                $eachSatuan->id
            ]);
        }

        foreach ($result->data as $item) {
            $dataFoundItem = false;
            $dataFoundSatuan = false;
            $indexIfFoundSO = 1;
            $idIfFoundSatuan = 1;

            for ($i = 0; $i < count($arrayItem); $i++) {
                if ($arrayItem[$i][0] == $item->id) {
                    $indexIfFoundSO = $i;
                    $dataFoundItem = true;
                    break;
                }
            }

            for ($j = 0; $j < count($arraySatuan); $j++) {
                if (strcmp($arraySatuan[$j][0], $item->unitdesc) == 0) {
                    $dataFoundSatuan = true;
                    $idIfFoundSatuan = $arraySatuan[$j][1];
                    break;
                }
            }

            if (!$dataFoundSatuan) {
                $satuanDatabase = new satuan();
                $satuanDatabase->satuan = $item->unitdesc;
                $satuanDatabase->save();

                $satuan = [];
                array_push($satuan, $item->unitdesc, $satuanDatabase->id);

                array_push($arraySatuan, $satuan);
            }

            if ($dataFoundItem) {
                list_item_bee_cloud::find($arrayItem[$indexIfFoundSO][1])->update([
                    'Item' => $item->name1,
                    'id_satuan' => $idIfFoundSatuan,
                    'bee_cloud_item_id' => $item->id,
                    'bee_cloud_item_code' => $item->code
                ]);
            } else {
                $list_so_db = new list_item_bee_cloud();
                $list_so_db->Item = $item->name1;
                $list_so_db->id_satuan = $idIfFoundSatuan;
                $list_so_db->bee_cloud_item_id = $item->id;
                $list_so_db->bee_cloud_item_code = $item->code;
                $list_so_db->save();


                $itemTemp = [];
                array_push($itemTemp, $list_so_db->bee_cloud_item_id, $list_so_db->id);

                array_push($arrayItem, $itemTemp);
            }
        }
        echo 'Success update item';
    }

    public function getSatuanBee()
    {
        ///   Program Berikut Untuk Update Satuan Agar Sama Dengan Unit Satuan Pada Bee Cloud ////
        $urlSatuan = 'https://private-anon-d985942e71-beecloud.apiary-proxy.com/api/v1/unit';
        $data = file_get_contents($urlSatuan, false, $this->context);
        $result = json_decode($data);

        $satuanDB = satuan::all();
        $satuanAll = [];
        //  Dapatkan semua satuan
        foreach ($satuanDB as $eachSatuan) {
            array_push($satuanAll, [
                $eachSatuan->satuan,
                $eachSatuan->id
            ]);
        }

        foreach ($result->data as $item) {
            $satuanBeeCloud = $item->unit;
            $dataFound = false;
            for ($i = 0; $i < count($satuanAll); $i++) {
                if (strcmp($satuanAll[$i][0], $satuanBeeCloud) == 0) {
                    $dataFound = true;
                    break;
                }
            }
            if (!$dataFound) {
                $satuanDatabase = new satuan();
                $satuanDatabase->Satuan = $satuanBeeCloud;
                $satuanDatabase->save();

                $satuan = [];
                array_push($satuan, $satuanBeeCloud, $satuanDatabase->id);

                array_push($satuanAll, $satuan);
            }
        }
        echo 'Success update satuan';
    }
}
