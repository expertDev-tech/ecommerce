<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Common\SlugService;
use App\Models\ProductCollection;
use App\Http\Requests\Admin\ProductCollectionRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductCollectionController extends Controller
{
    protected $slugService;

    public function __construct(SlugService $slugService) {
        $this->slugService = $slugService;
    }
    public function index(Request $request)
    {
        $collections = ProductCollection::query()

            ->when(
                $request->search,
                function ($query, $search) {

                    $query->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                }
            )

            ->when(
                $request->filled('status'),
                function ($query) use ($request) {

                    $query->where(
                        'status',
                        $request->status
                    );
                }
            )

            ->when(
                $request->filled('featured'),
                function ($query) use ($request) {

                    $query->where(
                        'is_featured',
                        $request->featured
                    );
                }
            )

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return Inertia::render(
            'Admin/Collections/Index',
            [

                'collections' => $collections,

                'filters' => [

                    'search' =>
                        $request->search,

                    'status' =>
                        $request->status,

                    'featured' =>
                        $request->featured,

                ],

            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Admin/Collections/Create'
        );
    }

    public function store(ProductCollectionRequest $request)
    {
        $data = $request->validated();

         $data['slug'] = $this->slugService
            ->generateUniqueSlug(
                $data['name'],
                \App\Models\ProductCollection::class
            );

            if ($request->hasFile('image')) {

                $data['image'] =
                    $request->file('image')
                        ->store(
                            'collections',
                            'public'
                        );
            }

        ProductCollection::create($data);

        return redirect()
            ->route(
                'collections.index'
            )
            ->with(
                'success',
                'Collection created successfully.'
            );
    }

    public function edit(ProductCollection $collection)
    {
        return Inertia::render(
            'Admin/Collections/Edit',
            [
                'collection' => $collection,
            ]
        );
    }

    public function update(ProductCollectionRequest $request,ProductCollection $collection)
    {
        $data = $request->validated();

        if ($collection->name !== $data['name']) {

            $data['slug'] = $this->slugService
                    ->generateUniqueSlug(
                        $data['name'],
                        \App\Models\ProductCollection::class,
                        $collection->id
                    );

        }

        if ($request->hasFile('image')) {

            if (
                $collection->image &&
                Storage::disk('public')->exists(
                    $collection->image
                )
            ) {

                Storage::disk('public')->delete(
                    $collection->image
                );
            }

            $data['image'] = $request
                ->file('image')
                ->store(
                    'collections',
                    'public'
                );
        }
        else {
            unset($data['image']);
        }

        $collection->update(
            $data
        );

        return redirect()
            ->route(
                'collections.index'
            )
            ->with(
                'success',
                'Collection updated successfully.'
            );
    }

    public function destroy(ProductCollection $collection)
    {
        $collection->delete();

        return back()->with(
            'success',
            'Collection moved to trash.'
        );
    }

    public function trash()
    {
        $collections = ProductCollection::onlyTrashed()
            ->latest()
            ->get();

        return Inertia::render(
            'Admin/Collections/Trash',
            [
                'collections' => $collections,
            ]
        );
    }

    public function restore($id)
    {
        $collection = ProductCollection::onlyTrashed()
            ->findOrFail($id);

        $collection->restore();

        return back()->with(
            'success',
            'Collection restored successfully.'
        );
    }

    public function forceDelete($id)
    {
        $collection = ProductCollection::onlyTrashed()
            ->findOrFail($id);

        if ($collection->image && Storage::disk('public')->exists($collection->image)) {

            Storage::disk('public')
                ->delete(
                    $collection->image
                );
        }

        $collection->forceDelete();

        return back()->with(
            'success',
            'Collection permanently deleted.'
        );
    }
}
