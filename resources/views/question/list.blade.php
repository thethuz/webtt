@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header text-black">All Questions</h1>

            @foreach ($questions as $question)
                <div class="col-lg-2">

                </div>
                <div class="col-lg-10">
                    <a href="/question/{{$question->id}}//{{$question->slug}}"/>
                    <div></div>
                </div>

            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="row ask-question">
                {{--<span class="questions-count">{{ $question_count }}</span>&nbsp;<span>questions</span>--}}
                <a href="/questions/ask" class="pull-right btn btn-primary">Ask Question</a>
            </div>
        </div>
    </div>
    </div
@endsection