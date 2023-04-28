<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_bee_cloud extends Model
{
    use HasFactory;
    public $table = 'transaksi_bee_cloud';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_tanggal',
        'time',
        'id_outlet',
        'id_list_sales',
        'total',
        'id_transaksi_bee_cloud',
        'trxno_bee_cloud',
        'created_at',
        'updated_at'
    ];
}
