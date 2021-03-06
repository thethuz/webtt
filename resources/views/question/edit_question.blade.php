@extends('layouts.app')

@section('script')
    <link href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@section('script')
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.js') }}"></script>
@endsection
@section('content')
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Question</h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <form method="POST" action="{{ route('api.questions.update',['id'=>$question->id]) }}"> check the method
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{ $question->id }}">
                <div class="form-group">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $question->title }}"
                           required autofocus>
                </div>

                <div class="form-group">
                    <textarea name="content" class="form-control" rows="15" required>{{ $question->content }}</textarea>
                </div>

                <div class="form-group">
                    {{--<input type="text" value="{{ $question->tags }}" name="tag" class="form-control"--}}
                    {{--data-role="tagsinput">--}}
                    <p>Tag for your questions {{$question->tags}}</p>
                    <select name="tag">
                        @foreach ($alltags as $tag)
                            @if (strcmp(strtolower($tag),$question->tags)==0)
                                <option value="{{$tag}}" selected>{{$tag}}</option>
                            @else
                                <option value="{{$tag}}">{{$tag}}</option>
                            @endif
                        @endforeach
                        {{--<option value="volvo">Volvo</option>--}}
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
