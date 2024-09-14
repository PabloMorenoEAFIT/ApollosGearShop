<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;   
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function save(Request $request, int $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a review.');
        }

        $instrument = Instrument::findOrFail($id);
        
        $review = new Review();
        $validatedData = $review->validate($request->all());
        $userId = auth()->user()->id;
        
        try {
            $review = Review::create([
                'instrument_id' => $instrument->getId(),
                'user_id' => $userId,
                'score' => $validatedData['score'],
                'description' => $validatedData['description'],
            ]);

            $instrument->setNumberOfReviews(1);
            $instrument->setReviewSum($validatedData['score']);
            $instrument->save();
        } catch (\Exception $e) {
            return redirect()->route('instrument.show', ['id' => $instrument->getId()])
                            ->with('error', 'An error occurred while saving the review.');
        }

        return redirect()->route('instrument.show', ['id' => $instrument->getId()])
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


    /**
     * Delete a review.
     */
}
