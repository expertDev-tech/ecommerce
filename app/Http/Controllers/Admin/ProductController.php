<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\Admin\ProductService;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) 
    {

    }

    public function index(Request $request)
    {
        $products = $this->productService->getProducts($request->all());

        $allCategories = Category::where('status',true)->get();

        $categories = Category::getNestedCategories($allCategories);

        $brands = Brand::where('status',true)->orderBy('name')->get();

        return Inertia::render(
            'Admin/Products/Index',
            [
                'products' => $products,

                'categories' => $categories,

                'brands' => $brands,

                'filters' => $request->only([
                    'search',
                    'category_id',
                    'brand_id',
                    'status',
                    'sort_by',
                    'sort_direction',
                ]),
            ]
        );
    }


    public function create()
    {
        $allCategories = Category::where('status',true)->get();

        $categories = Category::getNestedCategories($allCategories);

        $brands = Brand::where(
            'status',
            true
        )->orderBy('name')->get();

        return Inertia::render(
            'Admin/Products/Create',
            [
                'categories' => $categories,
                'brands' => $brands,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = $this->productService
            ->createProduct($data);

        return redirect()
            ->route(
                'products.edit',
                $product->id
            )
            ->with(
                'success',
                'Product created successfully.'
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
    public function edit(Product $product)
    {
        $product->load([
            'images'
        ]);

        $allCategories = Category::where('status',true)->get();

        $categories = Category::getNestedCategories($allCategories);

        $brands = Brand::where(
            'status',
            true
        )->orderBy('name')->get();

        $attributes = Attribute::query()

        ->with('options')

        ->where(
            'category_id',
            $product->category_id
        )

        ->where(
            'status',
            1
        )

        ->latest()

        ->get();

        $attributeValues = AttributeValue::query()

        ->with([
            'attribute.options',
        ])

        ->where(
            'product_id',
            $product->id
        )

        ->latest()

        ->paginate(10)

        ->withQueryString();

        return Inertia::render(
            'Admin/Products/Edit',
            [
                'product' => $product,

                'categories' => $categories,

                'brands' => $brands,

                'attributes' => $attributes,

                'attributeValues' => $attributeValues ,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) 
            {
                Storage::disk('public')->delete($product->thumbnail);
            }

            $data['thumbnail'] = $request
                ->file('thumbnail')
                ->store(
                    'products',
                    'public'
                );
        }

        $this->productService
            ->updateProduct(
                $product,
                $data
            );

        return redirect()
            ->route(
                'products.edit',
                $product->id
            )
            ->with(
                'success',
                'Product updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
