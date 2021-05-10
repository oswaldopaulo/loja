<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        $this->middleware('auth');
    }

    
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function carrinho()
    {
        return view('carrinho');
    }
    
    public function details($id)
    {
        
      
        return view('details')->with(['id'=>$id,  'produto' => Request::input('produto')]);
    }
}
