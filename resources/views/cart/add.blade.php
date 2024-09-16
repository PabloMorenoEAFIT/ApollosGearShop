<!-- resources/views/cart/add.blade.php -->
<form id="addToCartForm" action="{{ route('instrument.addToCart', ['id' => $instrument->getId()]) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="quantity" class="form-label">{{ __('attributes.quantity') }}</label>
        <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="{{ $instrument->getQuantity() }}" value="1" required data-max-quantity="{{ $instrument->getQuantity() }}">
    </div>
    <button type="submit" class="btn btn-primary">{{ __('messages.add_to_cart') }}</button>
</form>
