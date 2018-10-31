<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Question;

use Auth;
use Config;

class QuestionController extends Controller
{
    public function showQuestionList()
    {
        $questions = Question::orderBy('create_at', 'desc')->paginate(10);
        $newest_questions = Question::orderBy('created_at', 'desc')->paginate(20);

//        foreach ($questions as $key => $question){
//
//        }
        return view('question.list', ['questions' => $questions]);
    }

    public function showAsk()
    {
        if (Auth::user()) {
            return view('question.ask');
        } else {
            return view('auth.login');
        }
    }

    public function ask()
    {
        $question = new Question();
        $question->title = Input::get('title');
        $question->slug = str_slug($question, '-');
        $question->content = Input::get('content');
        $question->status = Config::get('constants.QUESTION_STATUS.ACTIVE');
        $question->created_by = Auth::user()->id;

        $question->save();

        $question_url = Config::get('constants.QUESTION_URL') . '/' . $question->id . '/' . $question->slug;
        return redirect($question_url);
    }

    public function showQuestionDetail($id, $slug)
    {
        $currentUserId = 0;
        if (Auth::user()) {
            $currentUserId = Auth::user()->id;
        }
        $question = Question::find($id);

        if ($question) {
            $question->views++;
            $question->save();
        }
        $newest_questions = Question::orderBy('created_at', 'desc')->paginate(3);
        return view('question.detail', [
            'question' => $question,
            'newest_questions' => $newest_questions,
            'currentUserId' => $currentUserId,
            'isLogin' => $currentUserId > 0]);
    }
}
