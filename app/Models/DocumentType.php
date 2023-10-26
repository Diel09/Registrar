<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $table = "doc_type";
    
    protected $fillable = [
        'doc_name',
        'price',
        'collection_id'
    ];
}
