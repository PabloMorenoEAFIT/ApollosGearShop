@extends('layouts.app')
@section("title", $viewData["title"])
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
                <div class="card-header">Create instrument</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('instrument.save') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control mb-2" placeholder="Enter name" name="name"
                            value="{{ old('name') }}" />
                        <input type="text" class="form-control mb-2" placeholder="Enter price" name="price"
                            value="{{ old('price') }}" />
                        <input type="submit" class="btn btn-primary" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection