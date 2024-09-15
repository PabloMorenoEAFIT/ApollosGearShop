@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["Lessons"] as $lesson)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top img-card">
            <div class="card-body text-center">
                <h5>ID: {{ $lesson["id"]}}</h5>
                <a href="{{ route('lesson.show', ['id'=> $lesson["id"]]) }}"
                    class="btn bg-primary text-white">{{ $lesson["name"] }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection