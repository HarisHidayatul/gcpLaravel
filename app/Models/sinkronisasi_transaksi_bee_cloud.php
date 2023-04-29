<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sinkronisasi_transaksi_bee_cloud extends Model
{
    use HasFactory;
    public $table = 'sinkronisasi_transaksi_bee_cloud';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'skip',
        'take',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
