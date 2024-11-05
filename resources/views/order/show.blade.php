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
                <h5>ID: {{ $viewData["order"]->id }}</h5>
                <h5 class="card-title">
                    Creation Date: {{ $viewData["order"]->created_at->format('Y-m-d H:i') }}
                </h5>
                <h5 class="card-title">
                    Delivery Date: {{ $viewData["order"]->deliveryDate }}
                </h5>
                <h6>Products:</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData["items"] as $item)
                        <tr>
                            <td>
                                @if($item->getType() == 'instrument')
                                <p>Instrument</p>
                                @else
                                <p>Lesson</p>
                                @endif
                            </td>
                            <td>
                                @if($item->getType() == 'instrument')
                                {{ $item->getInstrument()->getName() }}
                                @else
                                {{ $item->getLesson()->getName() }}
                                @endif
                            </td>
                            <td>
                                {{ $item->getQuantity() }}
                            </td>
                            <td>
                                $ {{ $item->getCustomPrice($item->getPrice()) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="h3 secondary">
                    Total: <p class="text-success"> $ {{ $viewData['order']->getCustomTotalPrice() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
