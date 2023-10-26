<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Form extends Controller
{
    public function insertData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        YourModel::create($validatedData);

        return response()->json(['message' => 'Data inserted successfully']);
    }
}
