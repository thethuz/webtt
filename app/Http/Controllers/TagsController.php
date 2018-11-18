<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Question;

use DB;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected function getTopTags() {

       $tags = DB::table('tags')
       ->select('name', DB::raw('count(question_id) as total'))
       ->groupBy('name')
       ->orderBy('total', 'desc')
       ->paginate(10);

       return $tags;
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            if (!$request->body or !$request->user_id) {
                $result = [
                    'message' => 'Please Provide Both body and user_id',
                    'data' => []
                ];
                return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            Tag::create($request->all());
            $result = [
                'message' => 'Post Created Succesfully',
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_OK);
        } catch (Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'data' => []
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showQuestionByTag($tag) {

       $questions = Question::
                   whereHas('tag', function ($query) use ($tag) {
                       $query->where('name', '=', $tag);
                   })
                   ->orderBy('created_at', 'desc')->paginate(10);

       $newest_questions = Question::orderBy('created_at', 'desc')->paginate(20);

       $question_count = Question::count();

       foreach ($questions as $key => $question) {
         $questions[$key]->votes = $this->countUpVoteByVoteId($question->id, Config::get('constants.VOTE_CATEGORY.QUESTION') )
                            - $this->countDownVoteByVoteId($question->id, Config::get('constants.VOTE_CATEGORY.QUESTION') );

         $questions[$key]->answers = $this->countAnswerByQuestionId($question->id);
       }

       $top_tags = $this->getTopTags();

       return view('question.list', ['questions' => $questions, 'newest_questions' => $newest_questions
                                     ,'question_count' => $question_count, 'top_tags' => $top_tags ]);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            if (!$request->body or !$request->user_id) {
                $result = [
                    'message' => 'Please Provide Both body and user_id',
                    'data' => []
                ];
                return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $post = Posts::find($id);
            $post->body = $request->body;
            $post->user_id = $request->user_id;
            $post->save();
            $result = [
                'message' => 'Post Updated Succesfully'
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_OK);
        } catch (Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'data' => []
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
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
        try {
            Tag::destroy($id);
            $result = [
                'message' => 'Post Deleted Succesfully'
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_OK);
        } catch (Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'data' => []
            ];
            return response()->json(['data' => $result], \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}
