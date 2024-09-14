@extends('layouts.app')

@section("title", $viewData["title"])
@section("subtitle", $viewData["subtitle"])

@section('content')
<div class="create-instrument-container container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{__('navbar.create_review')}}</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form action="{{ route('review.save', ['id' => $viewData['instrument']->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('attributes.description') }}</label>
                            <textarea id="description" class="form-control" placeholder="{{ __('attributes.placeholders.description') }}" name="description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="score">Score:</label>
                            <input type="number" name="score" id="score" class="form-control" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="{{ __('messages.save') }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection