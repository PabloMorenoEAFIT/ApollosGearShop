@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container">
    <div class="row text-center">
        <h2>Lesson</h2>
        <div class="col-lg-4 ms-auto">
            <p class="lead">Name: {{$viewData["lesson"]->getName()}} </p>
        </div>
        <div class="col-lg-4 me-auto">
            <p class="lead">Price: {{$viewData["lesson"]->getPrice()}}</p>
        </div>
    </div>
</div>
@endsection