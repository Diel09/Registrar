<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Registrar extends Authenticatable
{
    use HasFactory;
    public $connection="dbiusis";
    protected $table = "sresu_registrars";
}