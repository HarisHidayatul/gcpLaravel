<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $outletArray = array(
            [
                'nama_store' => 'Kedungturi',
                'branch_id_bee_cloud' => '25',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sumorame',
                'branch_id_bee_cloud' => '26',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Krian',
                'branch_id_bee_cloud' => '27',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sekardangan',
                'branch_id_bee_cloud' => '28',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Tulangan',
                'branch_id_bee_cloud' => '29',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sidokare',
                'branch_id_bee_cloud' => '30',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Ganting',
                'branch_id_bee_cloud' => '31',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Wadung Asri',
                'branch_id_bee_cloud' => '32',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Probolinggo',
                'branch_id_bee_cloud' => '33',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Kusuma Bangsa',
                'branch_id_bee_cloud' => '34',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'GK Kedungsari',
                'branch_id_bee_cloud' => '35',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Ampel',
                'branch_id_bee_cloud' => '36',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Bungkul',
                'branch_id_bee_cloud' => '37',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'RA Jombang',
                'branch_id_bee_cloud' => '38',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'GK Darmo Permai',
                'branch_id_bee_cloud' => '39',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'CK Pondok Aren',
                'branch_id_bee_cloud' => '40',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'CK Mangonda',
                'branch_id_bee_cloud' => '41',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Suhat',
                'branch_id_bee_cloud' => '42',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Ponorogo',
                'branch_id_bee_cloud' => '43',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'PT. Lazizaa Rahmat Semesta',
                'branch_id_bee_cloud' => '24',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Serua Jakarta',
                'branch_id_bee_cloud' => '44',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Pati',
                'branch_id_bee_cloud' => '45',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Capiting KBA',
                'branch_id_bee_cloud' => '46',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'SCM',
                'branch_id_bee_cloud' => '48',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Trunojoyo',
                'branch_id_bee_cloud' => '49',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Pandaan',
                'branch_id_bee_cloud' => '50',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Bungkul Baru',
                'branch_id_bee_cloud' => '51',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Gedangan',
                'branch_id_bee_cloud' => '52',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Tebel',
                'branch_id_bee_cloud' => '53',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sidayu',
                'branch_id_bee_cloud' => '54',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Wonoayu',
                'branch_id_bee_cloud' => '55',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sigura-gura',
                'branch_id_bee_cloud' => '56',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Pasuruan',
                'branch_id_bee_cloud' => '57',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Sukun Baru',
                'branch_id_bee_cloud' => '58',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Keputih',
                'branch_id_bee_cloud' => '59',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Bangil',
                'branch_id_bee_cloud' => '60',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Batu',
                'branch_id_bee_cloud' => '61',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Madiun',
                'branch_id_bee_cloud' => '62',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Magetan',
                'branch_id_bee_cloud' => '63',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Ngawi',
                'branch_id_bee_cloud' => '64',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Ampel Baru',
                'branch_id_bee_cloud' => '65',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Petemon',
                'branch_id_bee_cloud' => '66',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'BR Booth Bekasi',
                'branch_id_bee_cloud' => '69',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'BR Phx Grogol',
                'branch_id_bee_cloud' => '68',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Panjaitan',
                'branch_id_bee_cloud' => '70',
                'doutlet_id_laporta' => '0'
            ],
            [
                'nama_store' => 'Trial',
                'branch_id_bee_cloud' => '71',
                'doutlet_id_laporta' => '0'
            ],
        );
        DB::table('doutlet')->insert($outletArray);

        $listSales = array(
            [
                'sales' => 'Dine In',
                'id_channel_bee_cloud' => '1',
            ],
            [
                'sales' => 'Take Away',
                'id_channel_bee_cloud' => '2',
            ],
            [
                'sales' => 'Delivery Order',
                'id_channel_bee_cloud' => '3',
            ],
            [
                'sales' => 'Gojek',
                'id_channel_bee_cloud' => '4',
            ],
            [
                'sales' => 'Grab',
                'id_channel_bee_cloud' => '5',
            ],
            [
                'sales' => 'Shopee',
                'id_channel_bee_cloud' => '6',
            ],
            [
                'sales' => 'Shopeefood',
                'id_channel_bee_cloud' => '7',
            ],
            [
                'sales' => 'Big Order',
                'id_channel_bee_cloud' => '8',
            ],
            [
                'sales' => 'Bazar',
                'id_channel_bee_cloud' => '9',
            ],
            [
                'sales' => 'Telemarketing',
                'id_channel_bee_cloud' => '10',
            ],
            [
                'sales' => 'Fun Class',
                'id_channel_bee_cloud' => '11',
            ],
            [
                'sales' => 'Reseller',
                'id_channel_bee_cloud' => '12',
            ],
            [
                'sales' => 'Party',
                'id_channel_bee_cloud' => '13',
            ],
            [
                'sales' => 'Traveloka',
                'id_channel_bee_cloud' => '14',
            ],
            [
                'sales' => 'Mall',
                'id_channel_bee_cloud' => '15',
            ]
        );
        DB::table('list_sales')->insert($listSales);
    }
}
