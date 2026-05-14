<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')
        ->latest()
        ->paginate(10);

        return Inertia::render(
            'Admin/Categories/Index',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('sort_order')
        ->get();

        return Inertia::render(
            'Admin/Categories/Create',
            [
                'categories' => $categories
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }

        Category::create($data);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
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
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return Inertia::render(
            'Admin/Categories/Edit',
            [
                'category' => $category,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,Category $category) 
    {
        
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // Delete old image
            if ($category->image && Storage::disk('public')->exists($category->image)) {

                Storage::disk('public')
                    ->delete($category->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('categories', 'public');

        } else {

            unset($data['image']);
        }

        $category->update($data);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
