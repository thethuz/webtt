@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profile page of {{$username}}</h1>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->

<div id="activity">
    <div class="row">
        <div class="col-lg-6">
            <h3>Posted these questions</h3>
            @foreach ($questions as $question)
                <div>
                    <a href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                </div>
            @endforeach
        </div>
        <div class="col-lg-6">
            <h3>Answered on these questions</h3>
            @foreach ($answers as $answer)
                
                <div>
                    <a href="/questions/{{ $answer->id }}">
                        {{ $answer->title }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row"></div>
</div>
          
@endsection
