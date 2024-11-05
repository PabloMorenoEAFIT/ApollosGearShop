@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    @foreach ($viewData["orders"] as $order)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top img-card">
            <div class="card-body text-center">
                <h5>ID: {{ $order->getId() }}</h5>
                <h6>Creation Date: {{ $order->getCreatedAt() }}</h6>
                <a href="{{ route('order.show', ['id'=> $order->getId()]) }}"
                    class="btn bg-primary text-white">{{ __('messages.details') }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
