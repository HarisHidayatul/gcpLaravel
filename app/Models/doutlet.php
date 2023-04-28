<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doutlet extends Model
{
    use HasFactory;
    public $table = 'doutlet';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'nama_store',
        'branch_id_bee_cloud',
        'doutlet_id_laporta',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
