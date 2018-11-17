<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Answer;
use App\Question;

use Config;
use Auth;
use Response;
use DB;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected function countAnswerByQuestionId($questionId) {

       $answers = Answer::where('answers.question_id', $questionId)
                 ->count();
       return $answers;
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function create()
     {

       $answer_id = Input::get("answer_id");

       $answer = new Answer;
       $answer->content = Input::get("content");
       $answer->question_id = 0;
       $answer->answer_id = $answer_id;
       $answer->status = 1;
       $answer->created_by = Auth::user()->id;
       $answer->save();

       return Response::json(['status' => true, 'answer' => $answer
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function getAnswersById($questionId){

       $answers = Answer::with(array('children'=>function($query){
                     $query
                     ->with(array('user'=>function($query1){
                                   $query1->select('*');
                               }))->select('*');
                 }))
                 ->with(array('user'=>function($query){
                               $query->select('*');
                           }))
                 ->where('answers.question_id', $questionId)
                 ->orderBy('answers.status', 'desc')
                 ->orderBy('answers.created_at', 'desc')
                 ->get();

       foreach ($answers as $key => $answer) {

         if (Auth::user()) {
           $answers[$key]->up_voted = $this->findUserVoteByType($answer->id, Config::get('constants.VOTE_CATEGORY.ANSWER'), Config::get('constants.VOTE_TYPE.UP_VOTE'));
           $answers[$key]->down_voted = $this->findUserVoteByType($answer->id, Config::get('constants.VOTE_CATEGORY.ANSWER'), Config::get('constants.VOTE_TYPE.DOWN_VOTE'));
         } else {
           $answers[$key]->up_voted = false;
           $answers[$key]->down_voted = false;
         }

         $answers[$key]->formatted_created_at = $answers[$key]->created_at->format('M-d-Y') . ' at ' . $answers[$key]->created_at->format('h:i');

         $answers[$key]->votes = $this->countUpVoteByUserAndVoteId($answer->id, ($answer->user)['id'], Config::get('constants.VOTE_CATEGORY.ANSWER') )
                                 - $this->countDownVoteByUserAndVoteId($answer->id, ($answer->user)['id'], Config::get('constants.VOTE_CATEGORY.ANSWER') );
       }


       return Response::json($answers);
     }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showEditAnswer($id) {

       $answer = Answer::find($id);

       if (!Auth::check() || (Auth::user()->id != $answer->created_by)) {
         return redirect('/questions/list');
       }

       return view('question.edit_answer', ['answer' => $answer]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update() {
       $id = Input::get('id');

       $answer = Answer::find($id);
       $answer->content = Input::get('content');
       $answer->save();

       $question = Question::find($answer->question_id);
       $question_url = Config::get('constants.QUESTION_URL') . '/' . $question->id . '/' . $question->slug ;

       return redirect($question_url);

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
