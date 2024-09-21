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
                <h5>ID: {{  $viewData["order"]->getId()  }}</h5>
                <h5 class="card-title">
                    Creation Date: {{ $viewData["order"]->getCreatedAt() }}
                </h5>
                <h5 class="card-title">
                    <b>Delivery date: </b>{{--Delivery Date: {{ $viewData["order"]->getDeliveryDate()}}--}}
                </h5>
            </div>
            <div class="card-footer text-muted text-center">
                <form action="{{ route('order.delete', $viewData['order']->getId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete order</button>
                </form>
            </div>
    
        </div>
    </div>
</div>
@endsection