<?php

namespace App\Http\Controllers;
use App\Models\theme;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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


public function Mode(Request $request)
{ 
             

           
       Theme::updateOrCreate(
    ['user_id' => auth()->user()->id], 
    ['mode' => $request->mode] ,  

);

    return redirect()->back();

}

 

    public function Logout(Request $request)
    {


         $request->session()->invalidate();
 
        $request->session()->regenerate();

         return  redirect()->route("login");
 
    }


    


}
