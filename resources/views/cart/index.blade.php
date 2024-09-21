@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="container">
    <h1>{{ $viewData['subtitle'] }}</h1>
    @if(count($viewData['cartProducts']) > 0)
        <ul class="list-group">
            @foreach($viewData['cartProducts'] as $item)
                <li class="list-group-item">
                    <strong>Instrument:</strong> {{ $item['product']->getName() }} - {{ $item['product']->getFormattedPrice() }} 
                    @if($item['type'] === 'Instrument')
                        - Quantity: {{ $item['quantity'] }}
                    @endif
                </li>
            @endforeach
        </ul>
        <a class="btn btn-danger mt-3" href="{{ route('cart.removeAll') }}">{{ __('attributes.remove_All') }}</a>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

