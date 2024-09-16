@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container">
    <div class="row text-center">
        <h2>Lesson</h2>
        <div class="col-lg-4 ms-auto">
            <p class="lead">Creation date: {{$viewData["order"]["creationDate"]}} </p>
        </div>
        <div class="col-lg-4 me-auto">
            <p class="lead">Delivery date: {{$viewData["order"]["deliveryDate"]}}</p>
        </div>
        <div class="col-lg-4 me-auto">
            <p class="lead">Total price: {{$viewData["order"]["totalPrice"]}}</p>
        </div>
    </div>
</div>
@endsection