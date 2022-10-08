<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function store()
    {
        if (session('success'))
        {
           toast(session('success'), 'success');
        }
        // toast('Your Post as been submited!','success');

        // Alert::success('Success Title', 'Success Message');
        $latestProduct= Product::latest()->take(3)->get();
        return view('Product.store' , compact('latestProduct'));
        // dd($latestProduct);
    }
}
