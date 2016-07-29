<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use App\User;
use App\Info;
use DB;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
         $user=Auth::user();
         // $d1=time();
         
               
         //   echo (time()-strtotime($user->updated_at));
         //     // echo($d1-$d2);
         // $user_info=Info::all();

         // $info=DB::table('password_resets')->where('email','shivamyadav1995d@gmail.com')->first();
         $result_array=Info::get_rank_list();
         if($user->admin)
            return redirect('/admin');
         else 
          return view('/home',compact('user','result_array'));
    }


    public function view_notifications()
     {

            //code
     }
}
