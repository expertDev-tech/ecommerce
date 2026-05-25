<?php

namespace App\Repositories\Admin;

use App\Models\Product;

class ProductRepository
{

    public function getProducts(array $filters = [])
    {
        return Product::query()

            ->with([
                'category',
                'brand',
            ])


            ->when(
                $filters['search'] ?? null,
                function ($query, $search) {

                    $query->where(function ($query) use ($search) {

                        $query->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'sku',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhereHas(
                            'category',
                            function ($query) use ($search) {

                                $query->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        )

                        ->orWhereHas(
                            'brand',
                            function ($query) use ($search) {

                                $query->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );
                    });
                }
            )

            ->when(
                $filters['category_id'] ?? null,
                function ($query, $categoryId) {

                    $query->where(
                        'category_id',
                        $categoryId
                    );
                }
            )


            ->when(
                $filters['brand_id'] ?? null,
                function ($query, $brandId) {

                    $query->where(
                        'brand_id',
                        $brandId
                    );
                }
            )

            ->when(
                isset($filters['status']),
                function ($query) use ($filters) {

                    $query->where(
                        'status',
                        $filters['status']
                    );
                }
            )


            ->orderBy(
                $filters['sort_by'] ?? 'id',
                $filters['sort_direction'] ?? 'desc'
            )

            ->paginate(10)

            ->withQueryString();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($product,array $data)
    {
        $product->update($data);

        return $product;
    }

}