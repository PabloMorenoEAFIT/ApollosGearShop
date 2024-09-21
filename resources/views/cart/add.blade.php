<form action="{{ route('cart.add', ['id' => $productId, 'type' => $productType]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
    </div>
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>
