<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = "doc_type";
    
    protected $fillable = [
        'name',
        'price',
        'collection_id'
    ];

}
