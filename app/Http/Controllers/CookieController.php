<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {
   public function setCookie(Request $request){
      $minutes = 1;
      $response = new Response('Hello World');
      $response->withCookie(cookie('name', 'con cho Cun mat day', $minutes));
      return $response;
   }
   public function getCookie(Request $request){
      $value = $request->cookie('name');
      echo $value;
   }
   public function attachCookieAndHeader(Request $request){
		return response("Hello", 200)->header('Content-Type','text/html')->withcookie('name','Virat Gandhi');
	}
	public function attachJSON(Request $request)
	{
		return response()->json(['name' => 'Virat Gandhi', 'state' => 'Gujarat']);
	}
}