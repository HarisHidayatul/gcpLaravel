<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggal_all extends Model
{
    use HasFactory;
    public $table = 'tanggal_all';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'Tanggal',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
