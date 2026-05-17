<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Brand;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()
        ->paginate(10);

        return Inertia::render(
            'Admin/Brands/Index',
            [
                'brands' => $brands
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Brands/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {

            $data['logo'] = $request
                ->file('logo')
                ->store('brands', 'public');
        }

        Brand::create($data);

        return redirect()
            ->route('brands.index')
            ->with('success', 'Brand created successfully.');
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
    public function edit(Brand $brand)
    {
        $brands = Brand::where('id', '!=', $brand->id)
            ->orderBy('name')
            ->get();

        return Inertia::render(
            'Admin/Brands/Edit',
            [
                'brand' => $brand,
                'brands' => $brands,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request,Brand $brand)
    {
         $data = $request->validated();

        if ($request->hasFile('logo')) {

            // Delete old image
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {

                Storage::disk('public')
                    ->delete($brand->logo);
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('brands', 'public');

        } else {

            unset($data['logo']);
        }

        $brand->update($data);

        return redirect()
            ->route('brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
