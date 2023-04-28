<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi_bee_cloud extends Model
{
    use HasFactory;
    public $table = 'detail_transaksi_bee_cloud';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'id_transaksi',
        'id_list_item',
        'qty',
        'total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
