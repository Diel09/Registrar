<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Client;
use Auth;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;
    public $connection="dbiusis";
    protected $table = "sresu";

    public function routeNotificationForMail($notification)
    {
        // Replace this with your custom logic to get the email address
        $email = Client::select('student_info.email')->where('id', Auth::id())->join('student_info', 'sresu.student_number', 'student_info.student_number')->get();
        return $email;
    }
}
