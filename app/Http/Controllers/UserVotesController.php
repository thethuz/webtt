<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserVotes;
use App\Question;

use DB;
use Auth;
use Config;

class QuestionsController extends Controller
{
  protected function findUserVote($vote_id, $vote_category ) {
    $user_vote = UserVotes::where('vote_id', $vote_id)
            ->where('vote_by', Auth::user()->id)
            ->where('vote_category', $vote_category) // 0 question, 1 answer
            // ->where('vote_type', $vote_type)    // 0 vote, 1 downvote
            ->first();
    return $user_vote;
  }

  protected function findUserVoteByType($vote_id, $vote_category, $vote_type) {

    $user_vote = UserVotes::where('vote_id', $vote_id)
            ->where('vote_by', Auth::user()->id)
            ->where('vote_category', $vote_category)
            ->where('vote_type', $vote_type)
            ->exists();
    return $user_vote;
  }

  protected function countUpVoteByUserAndVoteId($vote_id, $user_id, $vote_category ) {
    $up_vote = UserVotes::where('vote_id', $vote_id)
            // ->where('vote_by', $user_id)
            ->where('vote_type', Config::get('constants.VOTE_TYPE.UP_VOTE'))
            ->where('vote_category', $vote_category)
            ->count();
    return $up_vote;
  }

  protected function countDownVoteByUserAndVoteId($vote_id, $user_id, $vote_category ) {
    $up_vote = UserVotes::where('vote_id', $vote_id)
            // ->where('vote_by', $user_id)
            ->where('vote_type', Config::get('constants.VOTE_TYPE.DOWN_VOTE'))
            ->where('vote_category', $vote_category)
            ->count();
    return $up_vote;
  }

  protected function countUpVoteByVoteId($vote_id, $vote_category ) {
    $up_vote = UserVotes::where('vote_id', $vote_id)
            ->where('vote_type', Config::get('constants.VOTE_TYPE.UP_VOTE'))
            ->where('vote_category', $vote_category)
            ->count();
    return $up_vote;
  }

  protected function countDownVoteByVoteId($vote_id, $vote_category ) {
    $up_vote = UserVotes::where('vote_id', $vote_id)
            ->where('vote_type', Config::get('constants.VOTE_TYPE.DOWN_VOTE'))
            ->where('vote_category', $vote_category)
            ->count();
    return $up_vote;
  }

}
