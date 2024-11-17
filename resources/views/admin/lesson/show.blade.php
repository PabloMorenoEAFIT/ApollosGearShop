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
                <h5 class="card-title">{{ $viewData["lesson"]->getName() }}</h5>
                

                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $viewData["lesson"]->getId() }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $viewData["lesson"]->getName() }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $viewData["lesson"]->getDescription() }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $viewData["lesson"]->getFormattedPrice() }}</td>
                    </tr>
                    <tr>
                        <th>Schedule</th>
                        <td>{{ $viewData["lesson"]->getSchedule() }}</td>
                    </tr>
                    <tr>
                        <th>Total Hours</th>
                        <td>{{ $viewData["lesson"]->getTotalHours() }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $viewData["lesson"]->getLocation() }}</td>
                    </tr>
                    <tr>
                        <th>Difficulty</th>
                        <td>{{ ucfirst($viewData["lesson"]->getDifficulty()) }}</td>
                    </tr>
                    <tr>
                        <th>Teacher</th>
                        <td>{{ $viewData["lesson"]->getTeacher() }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="card-footer text-muted text-center">
                <!-- Delete Lesson -->
                <form action="{{ route('admin.lesson.delete', $viewData['lesson']->getId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete lesson</button>
                </form>
                
                <!-- Add to Cart -->
                <form action="{{ route('cart.add', ['id' => $viewData['lesson']->getId(), 'type'=> 'Lesson']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
