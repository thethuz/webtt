<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function showQuestionList(){
        $questions = Question::orderBy('created_at','desc')->paginate(10);
        $newest_questions = Question::orderBy('created_at', 'desc')->paginate(20);

//        foreach ($questions as $key => $question){
//
//        }
        return view('/question/list',['questions'=> $questions]);
    }
}
