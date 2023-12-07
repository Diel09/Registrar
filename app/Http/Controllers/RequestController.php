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
        return 'success';
    }
    public function getAllRequest(){
        //Fetching Data from the Model Request_Details
        $request = [];
        $data = Request_Details::where('stud_no', Auth::user()->student_number)->where('req_status', '!=', 4)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }
    public function saveData(Request $request){
        //
        $copies = $request->input('copies');

        $request = new DocumentRequest();
        $request->copies = $copies;
        
        $request->save();

        return response()->json(['message' => 'Data saved successfully']);
    }
    public function getRequest(){ 
        $reqdetails = Request_Details::all();

        return response()->json($reqdetails);
    }
    public function getTimestamp()
    {
        $timestamp = now();
        return response()->json(['timestamp' => $timestamp]);
    }
    public function filter($filter, $student) {
        //Filters the displayed depending on the req_status
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
    public function getPayment(){
        //Fetching the Data with a req_status equal to 1
        $request = [];
        $data = Request_Details::where('req_status', 1)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }
    public function search(Request $request){
        //Search data using reference number
        $term = $request->get('search');

        $results = Request_Details::where('reference_no', 'LIKE', '%' .$term. '%')->where('req_status', '!=', 4)->get();
        return response()->json($results);
    }
    public function approveSearch(Request $request){
        //Search data using reference number with the req_status equal to 1
        $term = $request->get('search');

        $results = Request_Details::where('req_status', 1)
                        ->where('reference_no', 'LIKE', '%' . $term . '%')
                        ->get();

        return response()->json($results);
    }
}

