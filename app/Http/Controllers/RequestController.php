<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Details;
use App\Models\DocumentRequest;
use Carbon\Carbon;
use Auth;

class RequestController extends Controller
{
    public function submit(Request $request)
    {   $now = Carbon::now();
        $ref = $now->year . '-' . $now->hour . $now->minute . $now->second . $now->micro;

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
        $req->reference_no = $ref;

        // Save the document to the database
        $req->save();

        foreach($request->documents as $document) {
            $doc = new DocumentRequest();
            $doc->req_id = $req->id;
            $doc->doctype_id = $document['id'];
            $doc->copies = $document['copies'];
            $doc->price = $document['price'];
            $doc->purpose = $document['purpose'];
            $doc->save();
        }
        
        // Process the text data as needed
        return 'success';
    }
    public function getAllRequest(){
        $request = [];
        $data = Request_Details::where('stud_no', Auth::user()->student_number)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }
    public function saveData(Request $request){
        $copies = $request->input('copies');

        $request = new DocumentRequest();
        $request->copies = $copies;
        
        $request->save();

        return response()->json(['message' => 'Data saved successfully']);
    }
    public function getRequest(){
        // $docreq = DocumentRequest::all();
        $reqdetails = Request_Details::all();

        // $data = [
        //     'request_details' => $docreq,
        //     'doc_request' => $reqdetails,
        // ];
        return response()->json($reqdetails);
    }
    public function getTimestamp()
    {
        $timestamp = now(); // Get the current timestamp (you can replace it with your timestamp data from the database)
        return response()->json(['timestamp' => $timestamp]);
    }

    public function filter($filter, $student) {
        $request = [];
        $details = Request_Details::where('req_status', $filter)->where('stud_no', $student)->get();
        foreach($details as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'details' => $details, 
            'request' => $request
        ]);
    }
}
