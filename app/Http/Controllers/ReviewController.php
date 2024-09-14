<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;   
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function save(Request $request, $id): RedirectResponse
    {

        $instrument = Instrument::findOrFail($id);

        $validatedData = $request->validate([
            'description' => 'required|max:255',
            'score' => 'required|integer|min:1|max:5',]);

        $review = new Review();
        $review->instrument_id = $instrument->id;
        $review->user_id = auth()->user()->id; //id of logged in user
        $review->score = $validatedData['score'];
        $review->description = $validatedData['description'];
        $review->save();

        //redirect to the show page
        return redirect()->route('instrument.show', ['id' => $instrument->id])
                        ->with('success', 'Review added successfully!');
    }

    public function create($id): View
    {
        $instrument = Instrument::findOrFail($id);
        $viewData = [];
        $viewData['title'] = __('navbar.create_review');
        $viewData['subtitle'] = __('navbar.create_review');
        $viewData['instrument'] = $instrument;

        return view('review.create')->with('viewData', $viewData);
    }


    /**
     * Delete a review.
     */
}
