<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doc_Type;
use Inertia\Inertia;
use Auth;
use App\Models\Client;


class ClientController extends Controller
{
    public function list(){
        // return doc_type::all();
        return DB::table('doc_type')->get();
        // return DB::connection('second')->table('sresu')->get();
    }

    public function index(){
        $data = Client::select('sresu.student_number', 'degrees.degree', 'degrees.abbr', 'student_info.firstname', 'student_info.middlename', 'student_info.surname', 'student_info.email')
            ->where('sresu.student_number', Auth::user()->student_number)
            ->join('student_info', 'student_info.student_number', 'sresu.student_number')
            ->join('degrees', 'student_info.degree_id', 'degrees.id')
            ->first();
        return Inertia::render('Client/Request', [
            'details' => $data
        ]);
    }
}
