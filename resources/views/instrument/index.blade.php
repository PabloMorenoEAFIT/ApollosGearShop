@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

<div class="text-info text-center">
    @if (isset($viewData["message"]) && $viewData["message"])
        <h2>{{ $viewData["message"] }}</h2>
    @endif
</div>

<div class="row">
    @foreach ($viewData["instruments"] as $instrument)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top img-card">
            <div class="card-body text-center">
                <h5>ID: {{ $instrument->getId() }}</h5>
                <a href="{{ route('instrument.show', ['id'=>  $instrument->getId()]) }}"
                    class="btn bg-primary text-white">{{ $instrument->getName() }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection