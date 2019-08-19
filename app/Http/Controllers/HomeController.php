<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tutorial;
use Auth;

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
      $user = Auth::user();
    //  dd($user);
  $data= tutorial::get();
  $data = json_decode($data, true);
//dd( $data);
    $tut = [];
    foreach ($data as $key => $value) {
      $content['title'] = $value['title'];
      $content['body'] = $value['body'];
      $content['desc'] = $value['desc'];

        array_push($tut, $content);

  }
     $tut;
    //  dd( $tut);

        return view('home',['tut' => $tut ]);
    }
}
