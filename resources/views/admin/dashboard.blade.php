@extends('layouts.app')
@section('subtitle', __('navbar.admin_subtitle'))

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Stock Container -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('messages.stock_title') }}</h5>
                </div>
                @foreach ($viewData["stocks"] as $stock)
                <div class="card-body">
                    <h5 class="card-title">{{ $stock->instrument ? $stock->instrument->getName() : __('messages.unknown_instrument') }}</h5>
                    <span class="badge bg-info text-dark">{{ __('attributes.quantity') }}: {{ $stock->getQuantity() }}</span>
                    <!-- Aquí puedes agregar más información sobre el stock -->
                </div>
                @endforeach
            </div>
        </div>

        <!-- Orders Container -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('messages.order_title') }}</h5>
                </div>
                @foreach ($viewData["orders"] as $order)
                <div class="card-body">
                    <h5 class="card-title">{{ __('attributes.id') }}: {{ $order->getId()}}</h5>
                    {{ __('attributes.created_at') }} <span class="badge bg-info text-dark">{{ $order->getCreatedAt()}}</span>
                    <!-- Aquí puedes agregar más información sobre las órdenes -->
                </div>
                @endforeach
            </div>
        </div>

        <!-- Buttons Container -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('messages.admin_navigate') }}</h5>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.lesson.index') }}" class="btn btn-primary mb-2">{{ __('messages.list_lessons') }}</a>
                    <a href="{{ route('admin.lesson.create') }}" class="btn btn-primary mb-2">{{ __('navbar.create_lesson') }}</a>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.instrument.index') }}" class="btn btn-primary">{{ __('messages.instrument_list') }}</a>
                    <a href="{{ route('admin.instrument.create') }}" class="btn btn-primary">{{ __('navbar.create_instrument') }}</a>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.stock.index') }}" class="btn btn-primary">{{ __('navbar.stock') }}</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
