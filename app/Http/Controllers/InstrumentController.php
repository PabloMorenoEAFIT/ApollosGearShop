<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InstrumentController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request): View
    {
        $filters = $this->getFilters($request);
        $instruments = Instrument::filterInstruments($filters)->get();

        //Get unique categories to show as filter options
        $allCategories = Instrument::pluck('category')->unique();
        $categories = $allCategories->mapWithKeys(function ($category) {
            return [$category => __('attributes.categories.'.$category)];
        });

        $viewData = [
            'title' => __('messages.instrument_list'),
            'subtitle' => __('navbar.list_instruments'),
            'message' => Session::get('message'),
            'categories' => $categories,
            'instruments' => $instruments,
        ];

        return view('instrument.index')->with('viewData', $viewData);
    }

    protected function getFilters(Request $request): array
    {
        return [
            'searchByName' => $request->input('searchByName'),
            'category' => $request->input('category'),
            'rating' => $request->input('rating'),
            'filterOrder' => $request->input('filterOrder'),
        ];
    }

    public function create(): View
    {
        $allCategories = Instrument::pluck('category')->unique();
        $categories = $allCategories->mapWithKeys(function ($category) {
            return [$category => __('attributes.categories.'.$category)];
        });

        $viewData = [
            'title' => __('navbar.create_instrument'),
            'subtitle' => __('navbar.create_instrument'),
            'categories' => $categories,
        ];

        return view('instrument.create')->with('viewData', $viewData);
    }

    public function show(string $id, Request $request): View|RedirectResponse
    {
        $instrument = Instrument::findOrFail($id);
        $instrument = Instrument::with('reviews.user')->findOrFail($id);

        $viewData['message'] = 'Instrument added to cart!';

        $viewData = [
            'title' => $instrument['name'].' - AGS',
            'subtitle' => Str::limit($instrument['name'].' - instrument information', 50),
            'instrument' => $instrument,
            'category' => __('attributes.categories.'.$instrument->getCategory()),
            'reviews' => $instrument->reviews,
        ];

        return view('instrument.show')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $instrument = new Instrument;
        $imagePath = $this->imageService->store($request);
        Instrument::createInstrument($request->all(), $imagePath);

        $message = __('messages.created');

        return redirect()->route('instrument.index')->with('message', $message);
    }

    public function delete(int $id): RedirectResponse
    {
        try {
            $instrument = Instrument::findOrFail($id);
            $instrument->delete();
            $viewData['message'] = __('messages.deleted');
        } catch (\Exception $e) {
            return redirect()->route('instrument.index')->with('error', __('messages.delete_failed'));
        }

        return redirect()->route('instrument.index')->with('message', $viewData['message']);
    }
}
