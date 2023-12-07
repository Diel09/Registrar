<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Client;
use App\Models\Request_Details;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');

        $request = new Document();
        $request->name = $name;
        $request->price = $price;

        // Save the document to the database
        $request->save();

        // Process the text data as needed
        return redirect()->route('document')->with('success', 'Data added successfully.');
    }

    public function getAllDocTypes(){
        $data = DocumentType::all();
        return response()->json($data);
        
    }
    

    public function deleteDocs(Request $request){
        $res= DocumentType::where('id', $request->id)->delete();

        return 1;
       //  $list = $this->table();
       //  return $list;
   }

    
}



