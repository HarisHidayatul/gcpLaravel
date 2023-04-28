<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_sales extends Model
{
    use HasFactory;
    public $table = 'list_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'sales',
        'id_channel_bee_cloud',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
