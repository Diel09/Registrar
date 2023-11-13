<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Details;
use App\Models\DocumentRequest;

class RequestController extends Controller
{
    public function submit(Request $request)
    {
        $amount = 0;
        foreach($request->documents as $doc) {
            $amount += $doc['price'];
        }

        $req = new Request_Details();
        $req->stud_no = $request->details['studno'];
        $req->alumni_id = $request->details['studno'];
        $req->name = $request->details['name'];
        $req->email = $request->details['email'];
        $req->degree = $request->details['degree'];
        $req->college = $request->details['college'];
        $req->cont_no = $request->details['contact'];
        $req->total_amount = $amount;
        $req->remarks = $request->details['remarks'];

        // Save the document to the database
        $req->save();

        foreach($request->documents as $document) {
            $doc = new DocumentRequest();
            $doc->req_id = $req->id;
            $doc->doctype_id = $document['id'];
            $doc->copies = $document['copies'];
            $doc->price = $document['price'];
            $doc->save();
        }
        
        // Process the text data as needed
        return 'success';
    }
    public function getAllRequest(){
        $data = Request_Details::all();

        return response()->json($data);
    }
    public function saveData(Request $request){
        $copies = $request->input('copies');

        $request = new DocumentRequest();
        $request->copies = $copies;
        
        $request->save();

        return response()->json(['message' => 'Data saved successfully']);
    }
}
