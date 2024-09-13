<div class="card mt-4">
    <div class="card-header">
        <h3>{{ __('messages.update_stock') }}</h3>
    </div>
    <div class="card-body">
        <div class="row d-flex align-items-stretch">
            <div class="col">
                <!-- Form to Add Stock -->
                <form action="{{ route('stock.add', $viewData["stock"]->getId()) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="addQuantity">{{ __('attributes.add_quantity') }}</label>
                        <input type="number" id="addQuantity" name="addQuantity" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="addComments">{{ __('attributes.comments') }}</label>
                        <textarea id="addComments" name="addComments" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">{{ __('messages.add_stock') }}</button>
                </form>
            </div>
            <div class="col">
                <!-- Form to Lower Stock -->
                <form action="{{ route('stock.lower', $viewData["stock"]->getId()) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="lower_quantity">{{ __('attributes.lower_quantity') }}</label>
                        <input type="number" id="lower_quantity" name="lower_quantity" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="lower_comments">{{ __('attributes.comments') }}</label>
                        <textarea id="lower_comments" name="lower_comments" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning mt-3">{{ __('messages.lower_stock') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 mx-auto">
    <div class="col d-flex justify-content-center">
        <!-- Form to Delete Stock -->
        <form action="{{ route('stock.delete', $viewData["stock"]->getId()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
        </form>
    </div>
</div>