<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class InstrumentController extends Controller
{
    public function index(): View
    {

        $viewData = [];
        $viewData['title'] = 'Instrument - Online Store';
        $viewData['subtitle'] = 'List of instruments';
        $viewData['message'] = Session::get('message');
        Session::forget('message');
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
        $viewData = [];
        $viewData['title'] = 'Create instrument';

        return view('instrument.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {

        $instrument = new Instrument;
        $instrument->validate($request->only(['name', 'price']));
        $instrument = Instrument::create($request->only(['name', 'price']));

        $viewData = [
            'message' => 'Instrument created successfully!',
        ];

        $message = 'Instrument created successfully!';

        return redirect()->route('instrument.index')->with('message', $message);

    }

    public function delete(int $id): RedirectResponse
    {
        $instrument = Instrument::findOrFail($id);
        $instrument->delete();

        $message = 'Instrument deleted successfully!';

        return redirect()->route('instrument.index')->with('message', $message);
    }
}
