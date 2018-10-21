<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
class LoginController extends Controller{
   // public function FuncName(Request $request){
   
   //    // log something to storage/logs/laravel.log
   //    Log::info(['Request'=>$request]);}
   // }
   public function FuncName(Request $request){
      
      // log something to storage/logs/debug.log
      Log::useDailyFiles(storage_path().'/logs/debug.log');
      Log::info(['Request'=>$request]);
   }
?>