<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Services\CartUtils;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LessonController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request): View
    {
        $viewData = [
            'title' => __('messages.list_lessons'),
            'subtitle' => __('navbar.list_lessons'),
            'message' => Session::get('message'),
            'lessons' => Lesson::all(),
        ];

        Session::forget('message');

        return view('lesson.index')->with('viewData', $viewData);
    }

    public function show(string $id, Request $request): View|RedirectResponse
    {
        $lesson = Lesson::findOrFail($id);

        /*if (CartUtils::addToCart($request, $id, 'lesson')) {
            return redirect()->route('cart.index')->with('message', 'Lesson added to cart!');
        }*/
        $viewData = [
            'title' => $lesson['name'].' - AGS',
            'subtitle' => $lesson['name'].' - lesson information',
            'lesson' => $lesson,
        ];

        return view('lesson.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create lesson';

        return view('lesson.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $lesson = new Lesson;
        $validatedData = $lesson->validate($request->all());

        $lesson = Lesson::create($validatedData);
        $viewData['message'] = 'Lesson successfully created!';

        return redirect()->route('lesson.index', $viewData);
    }

    public function delete($id): RedirectResponse
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lesson.index')->with('success', 'Lesson deleted successfully.');
    }
}
