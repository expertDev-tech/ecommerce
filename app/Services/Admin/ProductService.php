<?php

namespace App\Services\Admin;

use App\Repositories\Admin\ProductRepository;
use App\Services\Admin\Common\SlugService;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected SlugService $slugService
    ) {

    }

    public function getProducts(array $filters = [])
    {
        return $this->productRepository->getProducts($filters);
    }

    public function createProduct(array $data)
    {

        $data['slug'] = $this->slugService
        ->generateUniqueSlug(
            $data['name'],
            \App\Models\Product::class
        );

        return $this->productRepository
            ->create($data);
    }

    public function updateProduct($product,array $data)
    {

        if ($product->exists) {
            unset(
                $data['brand_id'],
                $data['category_id']
            );
        }

        if ($product->name !== $data['name']) {

            $data['slug'] = $this->slugService
                ->generateUniqueSlug(
                    $data['name'],
                    \App\Models\Product::class,
                    $product->id
                );
        }

        return $this->productRepository
            ->update(
                $product,
                $data
            );
    }

}
