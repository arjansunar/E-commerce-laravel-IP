<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class BillController extends Controller
{
    public function index(Request $req){

        $phone = $req->input('phone');
        $address = $req->input('address');
        $date = $req->input('date');    
        $name= $req->input('name') ;

        $prev_cookie= (array)json_decode($req->cookie("cart"));
        $total=0;
        foreach ($prev_cookie as $key => $value) {
            $total += ($value->price * $value->quantity);
        }
        // dd($phone,$address,$date,$prev_cookie);
        return view('bill',[
            "products"=> $prev_cookie,
            "info"=> ["name"=> $name,"phone"=> $phone, "address"=> $address, "date" => $date],
            "total"=> $total
        ]);
    }

    public function generatePDF(Request $req){

        $phone = $req->input('phone');
        $address = $req->input('address');
        $date = $req->input('date');    
        $name= $req->input('name') ;
        $prev_cookie= (array)json_decode($req->cookie("cart"));
        $total=0;
        foreach ($prev_cookie as $key => $value) {
            $total += ($value->price * $value->quantity);
        }
        $data= [
            "products"=> $prev_cookie,
            "info"=> ["name"=> $name,"phone"=> $phone, "address"=> $address, "date" => $date ],
            "total"=> $total
        ];
        $pdf = PDF::loadView('bill', $data);
        return $pdf->download('invoice.pdf');
    }
}
