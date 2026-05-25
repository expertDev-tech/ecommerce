<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::query()

        ->with('category','options')

        ->when(
            request('search'),
            function ($query, $search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            }
        )

        ->latest()

        ->paginate(10)

        ->withQueryString();

        return Inertia::render(
            'Admin/Attributes/Index',
            [
                'attributes' => $attributes,

                'filters' => request()->only(
                    'search'
                ),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allCategories = Category::where(
            'status',
            true
        )->get();

        $categories = Category::getNestedCategories(
            $allCategories
        );

        return Inertia::render(
            'Admin/Attributes/Create',
            [
                'categories' => $categories,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug(
            $request->name
        );

        $exists = Attribute::where(
            'category_id',
            $request->category_id
        )->where(
            'slug',
            $data['slug']
        )->exists();

        if ($exists) {
            return back()->withErrors([
                'name' => 'Attribute already exists for this category.'
            ]);
        }

        $attribute = Attribute::create($data);

        if (in_array($attribute->type,['select','radio','checkbox','color'])) {
            foreach ($request->options ?? []as $option) {

                $attribute->options()->create([

                    'label' => $option['label'],

                    'value' => $option['value'],

                ]);
            }
        }

        return redirect()
            ->route('attributes.index')
            ->with(
                'success',
                'Attribute created successfully.'
            );
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
    public function edit(Attribute $attribute)
    {
        $attribute->load('options');

        $allCategories = Category::where(
            'status',
            true
        )->get();

        $categories = Category::getNestedCategories(
            $allCategories
        );

        return Inertia::render(
            'Admin/Attributes/Edit',
            [
                'attribute' => $attribute,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request,Attribute $attribute)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug(
            $request->name
        );

        $attribute->update($data);

        $attribute->options()->delete();

        if (in_array($attribute->type,['select','radio','checkbox','color'])) {

            foreach ($request->options ?? [] as $option) {

                $attribute->options()->create([

                    'label' => $option['label'],

                    'value' => $option['value'],

                ]);
            }
        }

        return redirect()
            ->route('attributes.index')
            ->with(
                'success',
                'Attribute updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()
            ->route('attributes.index')
            ->with(
                'success',
                'Attribute deleted successfully.'
            );
    }

    public function trash()
    {
        $attributes = Attribute::onlyTrashed()
            ->with('category')
            ->latest()
            ->paginate(10);

        return Inertia::render(
            'Admin/Attributes/Trash',
            [
                'attributes' => $attributes,
            ]
        );
    }

    public function restore($id)
    {
        $attribute = Attribute::onlyTrashed()
            ->findOrFail($id);

        $attribute->restore();

        return redirect()
            ->route('attributes.trash')
            ->with(
                'success',
                'Attribute restored successfully.'
            );
    }
}
