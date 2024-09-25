@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
<div class="create-lesson-container container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.create_lessons') }}</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('admin.lesson.save') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control mb-2" placeholder="Enter the lesson name" name="name"
                            value="{{ old('name') }}" />
                        <textarea class="form-control mb-2" placeholder="Enter description" name="description"
                            rows="4">{{ old('description') }}</textarea>
                        <select class="form-control mb-2" name="difficulty">
                            <option value="">{{ __('Select difficulty') }}</option>
                            <option value="easy" {{ old('difficulty') == 'principiante' ? 'selected' : '' }}>
                                Beginner</option>
                            <option value="medium" {{ old('difficulty') == 'intermedio' ? 'selected' : '' }}>
                                Intermediate</option>
                            <option value="hard" {{ old('difficulty') == 'avanzado' ? 'selected' : '' }}>
                                Advanced
                            </option>
                        </select>
                        <input type="datetime-local" class="form-control mb-2" name="schedule"
                            value="{{ old('schedule') }}" />
                        <input type="text" class="form-control mb-2" placeholder="Enter totalHours" name="totalHours"
                            value="{{ old('totalHours') }}" />
                        <input type="text" class="form-control mb-2" placeholder="Enter location" name="location"
                            value="{{ old('location') }}" />
                        <input type="text" class="form-control mb-2" placeholder="Enter price" name="price"
                            value="{{ old('price') }}" />
                        <input type="text" class="form-control mb-2" placeholder="Enter teacher" name="teacher"
                            value="{{ old('teacher') }}" />
                        <input type="submit" class="btn btn-primary" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection