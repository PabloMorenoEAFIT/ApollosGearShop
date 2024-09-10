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
                <h5>ID: {{ $viewData["instrument"]->getId() }}</h5>
                <h5 class="card-title">{{ $viewData["instrument"]->getName() }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $viewData["instrument"]->getDescription() }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $viewData["instrument"]->getCategory() }}</p>
                <p class="card-text"><strong>Brand:</strong> {{ $viewData["instrument"]->getBrand() }}</p>
                <p class="card-text">
                    <strong>Price:</strong> 
                    @if ($viewData["instrument"]->getPrice() > 100)
                        <span class="text-danger">${{ $viewData["instrument"]->getPrice() }}</span>
                    @else
                        ${{ $viewData["instrument"]->getPrice() }}
                    @endif
                </p>
                <p class="card-text"><strong>Review Sum:</strong> {{ $viewData["instrument"]->getReviewSum() }}</p>
                <p class="card-text"><strong>Number of Reviews:</strong> {{ $viewData["instrument"]->getNumberOfReviews() }}</p>
                <p class="card-text"><strong>Quantity:</strong> {{ $viewData["instrument"]->getQuantity() }}</p>
            </div>
            <div class="card-footer text-muted text-center">
                <form action="{{ route('instrument.delete', $viewData['instrument']->getId())}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Instrument</button>
                </form>
            </div>
    
        </div>
    </div>
</div>
@endsection