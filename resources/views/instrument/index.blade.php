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
    <div class="col-md-4 col-lg-3 mb-3">
        <div class="card h-100 shadow-sm">
            <!-- Instrument Image -->
            <img src="{{ $instrument->getImage() }}" class="card-img-top img-card" alt="Instrument Image">

            <div class="card-body text-center">
                <!-- Instrument Name -->
                <h5 class="card-title">{{ $instrument->getName() }}</h5>
                
                <!-- Brand and Category -->
                <p class="card-text">
                    <span class="badge bg-info text-dark">{{ $instrument->getBrand() }}</span>
                    <span class="badge bg-secondary">{{ $instrument->getCategory() }}</span>
                </p>
                
                <!-- Price -->
                <p class="card-text text-success">
                    <strong>Price:</strong> ${{ number_format($instrument->getPrice(), 2) }}
                </p>

                <!-- Review Information -->
                <p class="card-text">
                    <strong>Rating:</strong> {{ number_format($instrument->getReviewSum(), 1) }} 
                    <span class="text-muted">({{ $instrument->getNumberOfReviews() }} reviews)</span>
                </p>

                <!-- Short Description -->
                <p class="card-text">
                    {{ Str::limit($instrument->getDescription(), 60) }} <!-- Limit description length -->
                </p>

                <!-- Details Button -->
                <a href="{{ route('instrument.show', ['id'=>  $instrument->getId()]) }}" class="btn btn-primary">
                    View Details
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{--
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
--}}
@endsection