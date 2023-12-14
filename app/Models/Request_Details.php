<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Request_Details extends Model
{
    use HasFactory, Notifiable;

    protected $table = "request_details";
    
    protected $fillable = [
        'stud_no',
        'alumni_id',
        'name',
        'email',
        'degree',
        'college',
        'cont_no',
        'total_amount',
        'req_status',
        'reference_no',
        'OR_no',
        'remarks',
    ];

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
