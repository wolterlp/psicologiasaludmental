<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\Level;
use App\Models\CategoryLesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;


class LessonController extends Controller
{
    const NUNBER_OF_ITEMS_PER_PAGE = 25;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::paginate(self::NUNBER_OF_ITEMS_PER_PAGE);
        return inertia('Lessons/Index',['lessons'=>$lessons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        return inertia('Lessons/Create', ['categories'=>$categories, 'levels' =>$levels]);
    }

    /**
     * Store a newly created resource in storage.
     * @param App\Http\Requests\LessonRequest
     */
    public function store(LessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        $validCategories = array_filter($request->categories);
    
        // Asigna las categorías a la lección
        $lesson->categories()->sync($validCategories);
        
        /*
        foreach ($validCategories as $categoryId) {
            CategoryLesson::create([
                'category_id' => $categoryId,
                'lesson_id' => $lesson->id,
            ]);
        }
        */
        return redirect()->route('lessons.index')->with('success', 'Lección creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lessons)
    {
        $lessons->delete();
        return redirect()->route('lessons.index');
    }
}
