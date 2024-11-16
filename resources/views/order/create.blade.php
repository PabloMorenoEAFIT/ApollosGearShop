@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
{{ Breadcrumbs::render() }}
<div class="create-order-container container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('order.create_order')}}</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('order.save') }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-2" placeholder="{{ __('order.select_date') }}" name="creationDate"
                            id="creationDate" value="{{ old('creationDate') }}" />

                        <input type="text" class="form-control mb-2" placeholder="{{ __('order.delivery_date') }}" name="deliveryDate"
                            id="deliveryDate" value="{{ old('deliveryDate') }}" readonly />

                        <input type="text" class="form-control mb-2" placeholder="{{ __('order.total_price') }}" name="totalPrice"
                            value="{{ old('totalPrice') }}" />
                        <input type="submit" class="btn btn-primary" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection