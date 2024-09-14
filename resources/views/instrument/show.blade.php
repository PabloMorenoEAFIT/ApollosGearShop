@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $viewData['instrument']->getImage() }}" class="card-img-top img-card" alt="{{ __('attributes.instrument_image') }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $viewData['instrument']->getName() }}</h5>

                <!-- Details Table -->
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">{{ __('attributes.id') }}</th>
                            <td>{{ $viewData['instrument']->getId() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.description') }}</th>
                            <td>{{ $viewData['instrument']->getDescription() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.category') }}</th>
                            <td>{{ $viewData['category'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.brand') }}</th>
                            <td>{{ $viewData['instrument']->getBrand() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.price') }}</th>
                            <td>
                                <span class="text-success">{{ $viewData['instrument']->getFormattedPrice() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.rating') }}</th>
                            <td>{{ number_format($viewData['instrument']->getReviewSum(), 1) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.number_of_reviews') }}</th>
                            <td>{{ $viewData['instrument']->getNumberOfReviews() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('attributes.available_quantity') }}</th>
                            <td>{{ $viewData['instrument']->getQuantity() }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Mostrar las reviews del instrumento -->
                <div class="container mt-4">
                    <div class="row mb-3">
                        <!-- Columna para el título -->
                        <div class="col-md-8">
                            <h3>{{ __('attributes.reviews') }}</h3>
                        </div>
                        <!-- Columna para el botón -->
                        <div class="col-md-4 text-end">
                            <a href="{{ route('review.create', $viewData['instrument']->getId())}}" class="btn btn-primary">{{ __('messages.add_review') }}</a>
                        </div>
                    </div>

                    <!-- Mostrar las reviews del instrumento -->
                    @if (isset($viewData['reviews']) && count($viewData['reviews']) > 0)
                        <ul class="list-group">
                            @foreach ($viewData['reviews'] as $review)
                                <li class="list-group-item">
                                    <strong>{{ $review->user->name }}</strong> 
                                    <p>Score: {{ $review->score }} / 5</p>
                                    <p>{{ $review->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('attributes.no_reviews') }}</p>
                    @endif
                </div>
            </div>

            <!-- Card Footer with Delete Button -->
            <div class="card-footer text-muted text-center">
                <form action="{{ route('instrument.delete', $viewData['instrument']->getId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('messages.delete_instrument') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
