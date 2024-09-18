<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function save(Request $request, int $id): RedirectResponse
    {

        Review::createReview($request->all(), $id);

        return redirect()->route('instrument.show', ['id' => $id])
            ->with('success', 'Review added successfully!');
    }

    public function create(int $id): View
    {
        $instrument = Instrument::findOrFail($id);

        $viewData = [
            'title' => __('navbar.create_review'),
            'subtitle' => __('navbar.create_review'),
            'instrument' => $instrument,
        ];

        return view('review.create')->with('viewData', $viewData);
    }
}
