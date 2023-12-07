<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDocument extends Model
{
    use HasFactory;
    protected $connection = "dbpayments";
    protected $table = "collections";
    
    protected $fillable = [
        'id',
        'fund_id',
        'c_code',
        'description',
    ];
}
