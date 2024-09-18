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
                <h5>ID: {{  $viewData["lesson"]->getId()  }}</h5>
                <h5 class="card-title">
                    {{ $viewData["lesson"]->getName() }}
                </h5>
                <p>
                {{  $viewData["lesson"]->getDescription()  }}
                </p>
                <strong>Price: </strong>{{ $viewData["lesson"]->getFormattedPrice() }}
            </div>
            <div class="card-footer text-muted text-center">
                <form action="{{ route('lesson.delete', $viewData['lesson']->getId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete lesson</button>
                </form>
                
                <form action="{{ route('cart.add', ['id' => $viewData['lesson']->getId(), 'type'=> 'Lesson']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
    
        </div>
    </div>
</div>
@endsection