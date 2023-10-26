<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $table = "doc_request";
    
    protected $fillable = [
        'req_id',
        'doctype_id',
        'copies',
        'pages',
        'price',
    ];
}
