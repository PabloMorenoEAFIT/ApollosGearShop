@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
<div class="create-lesson-container container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create lesson</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('lesson.save') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control mb-2" placeholder="Enter the lesson name" name="name"
                            value="{{ old('name') }}" />
                        <textarea class="form-control mb-2" placeholder="Enter description" name="description"
                            rows="4">{{ old('description') }}</textarea>
                        <select class="form-control mb-2" name="difficulty">
                            <option value="">{{ __('Select difficulty') }}</option>
                            <option value="principiante" {{ old('difficulty') == 'principiante' ? 'selected' : '' }}>
                                Principiante</option>
                            <option value="intermedio" {{ old('difficulty') == 'intermedio' ? 'selected' : '' }}>
                                Intermedio</option>
                            <option value="avanzado" {{ old('difficulty') == 'avanzado' ? 'selected' : '' }}>Avanzado
                            </option>
                        </select>
                        <input type="text" class="form-control mb-2" placeholder="Enter schedule" name="schedule"
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