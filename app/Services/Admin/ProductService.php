<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;

use App\Repositories\Admin\ProductRepository;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository) {

    }

    public function getProducts(array $filters = [])
    {
        return $this->productRepository->getProducts($filters);
    }

    public function createProduct(array $data)
    {

        $data['slug'] = Str::slug(
            $data['name']
        );

        return $this->productRepository
            ->create($data);
    }

}
