<form action="{{ route('cart.add', ['id' => $productId, 'type' => $productType]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="quantity">"{{ __('cart.quantity') }}"</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $maxQuantity }}">
    </div>
    <button type="submit" class="btn btn-primary"> __('cart.add_to_cart')</button>
</form>
