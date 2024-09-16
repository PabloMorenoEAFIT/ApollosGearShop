<?php

namespace App\Http\Controllers;

use App\Models\Lesson; // importar Request
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse; // Importa el modelo Leccion
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
            'Lessons' => Lesson::all(),
        ];
        // $viewData['title'] = 'Lesson - Online Store';
        // $viewData['subtitle'] = 'List of Lessons';
        // $viewData['Lessons'] = Lesson::all();

        return view('lesson.index')->with('viewData', $viewData);
    }

    public function show(string $id, Request $request): View|RedirectResponse
    {
        $viewData = [];
        $lesson = Lesson::findOrFail($id);

        if ($request->isMethod('post') && $request->has('add_to_cart')) {
            // Agregar la leccion al carrito
            $cartItems = $request->session()->get('cart_items', []);
            $cartItems[] = ['id' => $id, 'type' => 'lesson'];
            $request->session()->put('cart_items', $cartItems);

            return redirect()->route('cart.index')->with('message', 'Instrument added to cart!');
        }

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

    public function addToCart(string $id, Request $request): RedirectResponse
    {
        // Verifica si el instrumento existe
        $lesson = Lesson::findOrFail($id);

        // Agregar el instrumento al carrito
        $cartItems = $request->session()->get('cart_items', []);
        $cartItems[] = ['id' => $id, 'type' => 'lesson'];
        $request->session()->put('cart_items', $cartItems);

        return redirect()->route('cart.index')->with('message', 'Instrument added to cart!');
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
