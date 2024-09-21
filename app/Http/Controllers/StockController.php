<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class StockController extends Controller
{
    public function index(): View
    {
        $stock = new Stock;
        $latestStocks = $stock->getLatestStocks();

        $viewData = [
            'stocks' => $latestStocks,
            'title' => 'Stock List',
            'subtitle' => __('navbar.stock_entries'),
        ];

        $viewData['message'] = Session::get('message');
        Session::forget('message');

        return view('stock.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $stock = Stock::with('instrument')->findOrFail($id); // Eager load

        $viewData = [
            'title' => __('messages.stock_details'),
            'subtitle' => __('navbar.stock_details'),
            'stock' => $stock,
        ];

        return view('stock.show')->with('viewData', $viewData);
    }

    public function addStock(Request $request, int $id): RedirectResponse
    {
        $stock = Stock::findOrFail($id);

        $quantity = $request->input('addQuantity');
        $comments = $request->input('addComments');
        $stock->addStock($quantity, $comments);
        $viewData['message'] = 'Stock added successfully!';

        return redirect()->route('stock.show', ['id' => $id])->with('success', $viewData['message']);

    }

    public function lowerStock(Request $request, int $id): RedirectResponse
    {
        $stock = Stock::findOrFail($id);
        $quantity = $request->input('lower_quantity');
        $comments = $request->input('lower_comments');
        $stock->lowerStock($quantity, $comments);
        $viewData['message'] = 'Stock lowered successfully!';

        return redirect()->route('stock.show', ['id' => $id])->with('success', $viewData['message']);

    }

    public function delete(int $id): RedirectResponse
    {

        $stock = Stock::findOrFail($id);
        $stock->delete();
        $viewData['message'] = __('messages.deleted');

        return redirect()->route('stock.index')->with('message', $viewData['message']);

    }
}
