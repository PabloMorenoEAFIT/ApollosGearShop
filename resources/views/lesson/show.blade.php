@extends('layouts.app')
@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="https://picsum.photos/seed/picsum/300/200" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5>ID {{  $viewData["lesson"]["id"]  }}</h5>
                <h5 class="card-title">
                    {{ $viewData["lesson"]["name"] }}
                </h5>
                @if ($viewData["lesson"]["price"] > 100)
                <p class="card-text text-danger">Price: ${{ $viewData["lesson"]["price"] }}</p>
                @else
                <p class="card-text">Price: ${{ $viewData["lesson"]["price"] }}</p>
                @endif
            </div>
            <div class="card-footer text-muted text-center">
                <form action="{{ route('lesson.delete', $viewData['lesson']['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete lesson</button>
                </form>
            </div>
    
        </div>
    </div>
</div>
@endsection