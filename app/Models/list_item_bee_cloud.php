<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_item_bee_cloud extends Model
{
    use HasFactory;
    public $table = 'list_item_bee_cloud';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'Item',
        'id_satuan',
        'bee_cloud_item_id',
        'bee_cloud_item_code',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
