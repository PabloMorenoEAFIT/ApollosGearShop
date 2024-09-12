@extends('layouts.app')
@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $viewData['instrument']->getImage() }}" class="img-fluid rounded-start" alt="Instrument Image">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $viewData['instrument']->getName() }}</h5>

                <!-- Details Table -->
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">ID</th>
                            <td>{{ $viewData['instrument']->getId() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td>{{ $viewData['instrument']->getDescription() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Category</th>
                            <td>{{ $viewData['instrument']->getCategory() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Brand</th>
                            <td>{{ $viewData['instrument']->getBrand() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Price</th>
                            <td>
                                @if ($viewData['instrument']->getPrice() > 100)
                                    <span class="text-danger">${{ number_format($viewData['instrument']->getPrice(), 2) }}</span>
                                @else
                                    ${{ number_format($viewData['instrument']->getPrice(), 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Rating</th>
                            <td>{{ number_format($viewData['instrument']->getReviewSum(), 1) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Number of Reviews</th>
                            <td>{{ $viewData['instrument']->getNumberOfReviews() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Available Quantity</th>
                            <td>{{ $viewData['instrument']->getQuantity() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Card Footer with Delete Button -->
            <div class="card-footer text-muted text-center">
                <form action="{{ route('instrument.delete', $viewData['instrument']->getId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Instrument</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
