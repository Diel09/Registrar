<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Details;

class RequestController extends Controller
{
    public function submit(Request $request)
    {
        $student_id = $request->input('stud_no');
        $alumni = $request->input('alumni_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $degree = $request->input('degree');
        $college = $request->input('college');
        $contact = $request->input('cont_no');
        $total = $request->input('total_amount');
        $status = $request->input('req_status');
        $reference = $request->input('reference_no');
        $or = $request->input('OR_no');
        $remarks = $request->input('remarks');

        $request = new Request_Details();
        $request->stud_no = $student_id;
        $request->alumni_id = $alumni;
        $request->name = $name;
        $request->email = $email;
        $request->degree = $degree;
        $request->college = $college;
        $request->cont_no = $contact;
        $request->total_amount = $total;
        $request->req_status = $status;
        $request->reference_no = $reference;
        $request->OR_no = $or;
        $request->remarks = $remarks;

        // Save the document to the database
        $request->save();

        // Process the text data as needed
        return 1;
    }
}
