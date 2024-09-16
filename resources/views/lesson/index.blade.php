@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

<div class="row">
    @foreach ($viewData["Lessons"] as $lesson)
    <div class="col-md-4 col-lg-3 mb-3">
        <div class="card h100 shadow-sm">
            <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top img-card">
            
            <div class="card-body text-center">
                <h4>{{ $lesson["name"]}}</h4>
                <h6>Difficulty: {{ $lesson["difficulty"]}}</h6>

                <p class="card-text text-success">
                    <strong>Price:</strong> ${{ number_format($lesson->getPrice(), 2) }}
                </p>

                <a href="{{ route('lesson.show', ['id'=> $lesson["id"]]) }}"
                    class="btn bg-primary text-white">OK</a>

                

            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection