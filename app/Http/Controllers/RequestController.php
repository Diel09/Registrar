<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Details;
use App\Models\DocumentRequest;
use App\Models\DocumentType;
use App\Models\AddDocument;
use App\Models\Client;
use Carbon\Carbon;
use Auth;
use stdClass;

use App\Notifications\RequestNotification;

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


    public function getRequestDetails(){
        $request = [];
        $data = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 0)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }


    public function getProcessing(){
        $request = [];
        $data = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 3)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }

    public function getReady(){
        $request = [];
        $data = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 4)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }

    public function getRequests(){
        $request = [];
        $data = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 1)->get();
        foreach($data as $index=>$value) {
            $request[$index] = DocumentRequest::where('req_id', $value->id)->join('doc_type', 'doc_request.doctype_id', 'doc_type.id')->get();
        }
        return response()->json([
            'data' => $data, 
            'request' => $request
        ]);
    }

    public function updateStatus(Request $req){
        $acc = Request_Details::find($req->id);
        $acc->req_status = 1;
        $acc->save();
        return $acc;
    }

    public function rejectStatus(Request $req){
        $acc = Request_Details::find($req->id);
        $acc->req_status = 2;
        $acc->save();
        return $acc;
    }

    public function readyStatus(Request $req){
        $acc = Request_Details::find($req->id);
        
        $acc->notify((new RequestNotification($acc)));

        $acc->req_status = 4;
        $acc->save();
        return 'success';
    }

    public function doneStatus(Request $req){
        $acc = Request_Details::find($req->id);
        $acc->req_status = 5;
        $acc->save();
        return $acc;
    }

    public function deleteRequest(Request $request){
        $res= Request_Details::where('id', $request->id)->delete();
    
        return 1;
       //  $list = $this->table();
       //  return $list;
    }

    public function getItemRequestDetails(){
            $requestDetails = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 0)->get();
            $data = $requestDetails->count();
            $request = $requestDetails->map(function ($item) {
                return DocumentRequest::where('req_id', $item->id)->count();
            });
            return response()->json([
                'data' => $data,
                'request' => $request,
            ]);
        }

    public function getItemProcessing(){
        $requestDetails = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 3)->get();
        $data = $requestDetails->count();
        $request = $requestDetails->map(function ($item) {
            return DocumentRequest::where('req_id', $item->id)->count();
        });
        return response()->json([
            'data' => $data,
            'request' => $request,
        ]);
    }

    public function getItemCompleted(){
        $requestDetails = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 4)->get();
        $data = $requestDetails->count();
        $request = $requestDetails->map(function ($item) {
            return DocumentRequest::where('req_id', $item->id)->count();
        });
        return response()->json([
            'data' => $data,
            'request' => $request,
        ]);
    }

    public function suggestions()
    {
        $documents = AddDocument::select('id', 'description')->get();
        return response()->json($documents);
    }
    
    public function fetchDoctypes(){
        $pie = [];
        $doc_request = DocumentRequest::select('doc_request.doctype_id')->get();
        $doc_type = DocumentType::select('id', 'name')->get();
        foreach($doc_type as $index => $docs) {
            $count = 0;
            foreach($doc_request as $request) {
                if($docs['id'] == $request['doctype_id']){
                    $pie[$index]['label'] = $docs['name'];
                    $count++;
                }
            }
            if($count != 0) {
                $pie[$index]['number'] = $count;
            }
        }
        return response()->json($pie); 
    }
    public function lineChart(){
        $requestDetails = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)->where('req_status', 4)->get();
        $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $request = [];
        foreach($month as $key => $value) {
            $count = Request_Details::where('college', Auth::guard('registrar')->user()->college_id)
                ->where('req_status', 4)
                ->whereMonth('completed_at', $value)->count();
            array_push($request, $count);
        }
        return response()->json([
            'request' => $request,
        ]);
    }
    public function pendingSearch(Request $request){
        //Search data using reference number with the req_status equal to 1
        $term = $request->get('search');

        $results = Request_Details::where('req_status', 0)
                        ->where('reference_no', 'LIKE', '%' . $term . '%')
                        ->get();

        return response()->json($results);
    }
    public function completedSearch(Request $request){
        //Search data using reference number with the req_status equal to 1
        $term = $request->get('search');

        $results = Request_Details::where('req_status', 4)
                        ->where('reference_no', 'LIKE', '%' . $term . '%')
                        ->get();

        return response()->json($results);
    }
    public function processSearch(Request $request){
        //Search data using reference number with the req_status equal to 1
        $term = $request->get('search');

        $results = Request_Details::where('req_status', 3)
                        ->where('reference_no', 'LIKE', '%' . $term . '%')
                        ->get();

        return response()->json($results);
    }


}






