<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;


class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('Second');
    }
  	public function showPath(Request $request){
  		$uri = $request->path();
  		echo "<br>URI: ".$uri;

  		$url = $request->url();
  		echo "<br>URL: ".$url;

  		$method = $request->method();
  		echo "<br>Method: ".$method;
  	}
  	public function showProfile($id){
        $user = Auth::user();
    }
}
