<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function show_details($id){
        $medicines = Medicine::find($id);
        return view('details' , compact('medicines') );

    }
    public function search(Request $request){
        $search = $request->input('search');
        $medicine = Medicine::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->orWhere('compenent', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('medicine'));
    }
    
}
