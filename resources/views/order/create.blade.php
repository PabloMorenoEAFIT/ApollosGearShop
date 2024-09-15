@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
<div class="create-order-container container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Order</div>
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
                        <!-- Campo de seleccionador de fecha -->
                        <input type="date" class="form-control mb-2" placeholder="Select date" name="creationDate"
                            id="creationDate" value="{{ old('creationDate') }}" />

                        <!-- Campo de descripción que se llenará automáticamente -->
                        <input type="text" class="form-control mb-2" placeholder="Delivery date" name="deliveryDate"
                            id="deliveryDate" value="{{ old('deliveryDate') }}" readonly />

                        <input type="text" class="form-control mb-2" placeholder="Precio total" name="totalPrice"
                            value="{{ old('totalPrice') }}" />
                        <input type="submit" class="btn btn-primary" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para actualizar la descripción con 2 días después de la fecha seleccionada -->
<script>
    document.getElementById('creationDate').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (!isNaN(selectedDate.getTime())) { // Verificar si la fecha es válida
            selectedDate.setDate(selectedDate.getDate() + 2); // Sumar 2 días
            const day = ("0" + selectedDate.getDate()).slice(-2); // Formatear día
            const month = ("0" + (selectedDate.getMonth() + 1)).slice(-2); // Formatear mes
            const year = selectedDate.getFullYear();
            const formattedDate = `${year}-${month}-${day}`; // Formato AAAA-MM-DD
            document.getElementById('deliveryDate').value = formattedDate; // Poner la fecha en el campo
        }
    });
</script>
@endsection
