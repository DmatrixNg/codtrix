<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;

class UploadfileController extends Controller
{
    function index()
    {
      return view('upload');
    }
    function upload(Request $request)
    {

      $file = $request->file('select_file');

      $fileName = $file->getClientOriginalName();
      $filePath = $fileName;
  //    dd(\Auth::user()->getStorageInstance()->files());
  //  return \Auth::user()->getStorageInstance()->files();
        $user = Auth::user();

      $email = $user->email;
      $username = strstr($email, '@', true);

      $file->storeAs('/'.$username, $fileName, 'public');


  return back()->with('success', 'File upload successfully');
    }

}
