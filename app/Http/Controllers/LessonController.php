<?php

namespace App\Http\Controllers;

use App\Models\Lesson; // importar Request
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // Importa el modelo Leccion
use Illuminate\View\View;

class LessonController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Lesson - Online Store';
        $viewData['subtitle'] = 'List of Lessons';
        $viewData['Lessons'] = Lesson::all();

        return view('lesson.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        $lesson = Lesson::findOrFail($id);
        $viewData['title'] = $lesson['name'].' - AGS';
        $viewData['subtitle'] = $lesson['name'].' - lesson information';
        $viewData['lesson'] = $lesson;

        return view('lesson.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData['title'] = 'Create lesson';

        return view('lesson.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'difficulty' => 'required',
            'schedule' => 'required',
            'totalHours' => 'required|numeric|gt:0',
            'location' => 'required',
            'price' => 'required|numeric|gt:0',
            'teacher' => 'required',
        ]);

        $lesson = Lesson::create($request->only(['name', 'description', 'difficulty',
            'schedule', 'totalHours', 'location', 'price', 'teacher']));

        return redirect()->route('lesson.success', [
            'id' => $lesson->id,
            'name' => $lesson->name,
            'description' => $lesson->description,
            'difficulty' => $lesson->difficulty,
            'schedule' => $lesson->schedule,
            'totalHours' => $lesson->totalHours,
            'location' => $lesson->location,
            'price' => $lesson->price,
            'teacher' => $lesson->teacher,
        ]);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $lesson = $request->only(['id', 'name', 'description', 'difficulty', 'schedule', 'totalHours', 'location', 'price', 'teacher']);

        if (empty($lesson['id']) || empty($lesson['name']) || empty($lesson['description'])) {
            Log::info('lesson details missing in query parameters.');

            return redirect()->route('home.index');
        }

        $viewData = [];
        $viewData['title'] = 'Success - AGS';
        $viewData['subtitle'] = 'Lesson successfully created!';
        $viewData['lesson'] = $lesson;

        return view('lesson.success')->with('viewData', $viewData);
    }

    public function delete($id): RedirectResponse
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lesson.index')->with('success', 'Lesson deleted successfully.');
    }
}
