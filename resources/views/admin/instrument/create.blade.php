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
                <div class="card-header">{{__('navbar.create_instrument')}}</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form action="{{ route('admin.instrument.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('attributes.name') }}</label>
                            <input type="text" id="name" class="form-control" placeholder="{{ __('attributes.placeholders.name') }}" name="name"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('attributes.description') }}</label>
                            <textarea id="description" class="form-control" placeholder="{{ __('attributes.placeholders.description') }}" name="description" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('attributes.category') }}</label>
                            <select id="category" class="form-control" name="category" required>
                                <option value="">{{ __('attributes.placeholders.category') }}</option>
                                @foreach($viewData['categories'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">{{ __('attributes.brand') }}</label>
                            <input type="text" id="brand" class="form-control" placeholder="{{ __('attributes.placeholders.brand') }}" name="brand"
                                value="{{ old('brand') }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('attributes.price') }}</label>
                            <input type="number" id="price" class="form-control" placeholder="{{ __('attributes.placeholders.price') }}" name="price"
                                step="0.01" min="0" value="{{ old('price') }}" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">{{ __('attributes.quantity') }}</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}" min="0" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('attributes.image') }}</label>
                            <input type="file" id="image" class="form-control" name="image" />
                        </div>
                        <input type="submit" class="btn btn-primary" value="{{ __('messages.save') }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection