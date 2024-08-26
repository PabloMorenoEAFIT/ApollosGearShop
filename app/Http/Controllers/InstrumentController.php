<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class InstrumentController extends Controller
{
    public function index(): View
    {

        $viewData = [];
        $viewData['title'] = 'Instrument - Online Store';
        $viewData['subtitle'] = 'List of instruments';
        $viewData['instruments'] = Instrument::all();

        return view('instrument.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        $instrument = Instrument::findOrfail($id);
        $viewData['title'] = $instrument['name'].' - AGS';
        $viewData['subtitle'] = $instrument['name'].' - instrument information';
        $viewData['instrument'] = $instrument;

        return view('instrument.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData['title'] = 'Create instrument';

        return view('instrument.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
        ]);

        $instrument = Instrument::create($request->only(['name', 'price']));

        return redirect()->route('instrument.success', [
            'id' => $instrument->id,
            'name' => $instrument->name,
            'price' => $instrument->price,
        ]);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $instrument = $request->only(['id', 'name', 'price']);

        if (empty($instrument['id']) || empty($instrument['name']) || empty($instrument['price'])) {
            Log::info('Instrument details missing in query parameters.');

            return redirect()->route('home.index');
        }

        $viewData = [];
        $viewData['title'] = 'Success - AGS';
        $viewData['subtitle'] = 'Instrument successfully created!';
        $viewData['instrument'] = $instrument;

        return view('instrument.success')->with('viewData', $viewData);
    }

    public function delete($id): RedirectResponse
    {
        $instrument = Instrument::findOrFail($id);
        $instrument->delete();

        return redirect()->route('instrument.index')->with('success', 'Instrument deleted successfully.');
    }
}
