<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVideo;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductVideoController extends Controller
{
    public function store(Request $request,Product $product
    ) {

        $data = $request->validate([

            'title' => ['nullable', 'string'],

            'video_type' => [
                'required',
                Rule::in([
                    'youtube',
                    'vimeo',
                    'upload',
                ]),
            ],

            'video_url' => [
                'required',
            ],

        ]);

        if ($request->video_type === 'youtube') {

            preg_match(
                '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
                $request->video_url,
                $matches
            );

            if (isset($matches[1])) {

                $thumbnail =
                    'https://img.youtube.com/vi/' .
                    $matches[1] .
                    '/hqdefault.jpg';
            }
        }

        if ($request->video_type === 'upload' && $request->hasFile('video_url')) {

            $data['video_url'] =
                $request->file('video_url')
                    ->store(
                        'products/videos',
                        'public'
                    );

            $thumbnail = 'defaults/video-placeholder.jpg';
        }

        $data['thumbnail'] = $thumbnail;

        $product->videos()->create($data);

        return back()->with(
            'success',
            'Video added successfully.'
        );
    }

    public function destroy(ProductVideo $video) {

        // if (
        //     $video->video_type === 'upload'
        //     &&
        //     Storage::disk('public')->exists($video->video_url)
        // ) {

        //     Storage::disk('public')
        //         ->delete($video->video_url);
        // }

        $video->delete();

        return back()->with(
            'success',
            'Video deleted successfully.'
        );
    }

    public function trash(Product $product)
    {
        $videos = ProductVideo::onlyTrashed()

            ->where(
                'product_id',
                $product->id
            )

            ->latest()

            ->get();

        return Inertia::render(
            'Admin/Products/Videos/Trash',
            [
                'product' => $product,

                'videos' => $videos,
            ]
        );
    }

    public function restore($id)
    {
        $video = ProductVideo::onlyTrashed()
            ->findOrFail($id);

        $video->restore();

        return back()->with(
            'success',
            'Video restored successfully.'
        );
    }

    public function forceDelete($id)
    {
        $video = ProductVideo::withTrashed()
            ->findOrFail($id);

        if (
            $video->video_type === 'upload'
            &&
            $video->video_url
            &&
            Storage::disk('public')->exists(
                $video->video_url
            )
        ) {

            Storage::disk('public')
                ->delete($video->video_url);

        }

        if (
            $video->thumbnail
            &&
            Storage::disk('public')->exists(
                $video->thumbnail
            )
        ) {

            Storage::disk('public')
                ->delete($video->thumbnail);

        }

        $video->forceDelete();

        return back()->with(
            'success',
            'Video permanently deleted.'
        );
    }

    public function setPrimary(ProductVideo $video) {

        ProductVideo::where(
            'product_id',
            $video->product_id
        )->update([
            'is_primary' => false,
        ]);

        $video->update([
            'is_primary' => true,
        ]);

        return back()->with(
            'success',
            'Primary video updated.'
        );
    }

}
