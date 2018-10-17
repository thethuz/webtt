<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudInsertController extends Controller
{
	public function index(){
		$users = DB:select('select * from student');
		return view('stud_view',['usersInView'=>$users])
		// $users = DB::select('select * from student');
		// return view('stud_view',['users'=>$users]);
	}
}
