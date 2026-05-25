<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController
{

    public function store(
        Request $request,
        Product $product
    )
    {
        $request->validate([
            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        foreach (
            $request->file('images', [])
            as $index => $image
        ) {

            $path = $image->store(
                'products/gallery',
                'public'
            );

            ProductImage::create([

                'product_id' => $product->id,

                'image' => $path,

                'alt_text' => $product->name,

                'is_primary' => $index === 0
                    && !$product->images()->exists(),

                'sort_order' => $index + 1,

                'status' => true,

            ]);
        }

        return back()->with(
            'success',
            'Product images uploaded successfully.'
        );
    }

    public function toggleStatus(ProductImage $productImage)
    {
        $productImage->update([

            'status' => !$productImage->status,

        ]);

        return back()->with(

            'success',

            'Image status updated successfully.'

        );
    }

    /**
     * Delete Product Image
     */
    public function destroy(
        ProductImage $productImage
    )
    {

        $productImage->delete();

        return back()->with(
            'success',
            'Product image moved to trash successfully.'
        );
    }

    /**
     * Set Primary Image
     */
    public function setPrimary(ProductImage $productImage)
    {
        /*
        |--------------------------------------------------------------------------
        | Remove Old Primary
        |--------------------------------------------------------------------------
        */

        ProductImage::where(
            'product_id',
            $productImage->product_id
        )->update([
            'is_primary' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Set New Primary
        |--------------------------------------------------------------------------
        */

        $productImage->update([
            'is_primary' => true,
        ]);

        return back()->with(
            'success',
            'Primary image updated successfully.'
        );
    }

    /**
     * Update Alt Text
     */
    public function updateAltText(
        Request $request,
        ProductImage $productImage
    )
    {
        $request->validate([
            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $affected_row = $productImage->update([
            'alt_text' => $request->alt_text,
        ]);

        return back()->with(
            'success',
            'Alt text updated successfully.'
        );
    }

    /**
     * Trash Images
     */
    public function trash(Product $product)
    {
        $images = ProductImage::onlyTrashed()
            ->where(
                'product_id',
                $product->id
            )
            ->latest()
            ->get();

        return inertia(
            'Admin/Products/Images/Trash',
            [
                'product' => $product,
                'images'  => $images,
            ]
        );
    }

    /**
     * Restore Image
     */
    public function restore($id)
    {
        $image = ProductImage::onlyTrashed()
            ->findOrFail($id);

        $image->restore();

        return back()->with(
            'success',
            'Image restored successfully.'
        );
    }

    public function forceDelete($id)
    {


        $image = ProductImage::onlyTrashed()
            ->findOrFail($id);


        if (
            Storage::disk('public')->exists(
                $image->image
            )
        ) {

            Storage::disk('public')->delete(
                $image->image
            );
        }

        $image->forceDelete();

        return back()->with(
            'success',
            'Image permanently deleted.'
        );
    }
}