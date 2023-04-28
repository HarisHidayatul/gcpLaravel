<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    use HasFactory;
    public $table = 'satuan';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'satuan',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
