<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;

class ProductAttributeController extends Controller
{

    public function store(Request $request,Product $product) {

        $attributes = Attribute::whereIn(
            'id',
            array_keys($request->values ?? [])
        )->get();

        foreach ($attributes as $attribute) {

            $value = $request->values[$attribute->id] ?? null;

            if ($attribute->is_required) {

                if ($value === null || $value === '' || $value === []) {

                    return back()->withErrors([

                        "values.{$attribute->id}" =>

                            "{$attribute->name} is required."

                    ]);

                }
            }
        }

        foreach ($request->values ?? [] as $attributeId => $value) {

            if ($value === null || $value === '' || $value === [] ) {

                continue;

            }

            if (is_array($value)) {

                $value = json_encode($value);

            }

            AttributeValue::updateOrCreate(

                [

                    'product_id' => $product->id,

                    'attribute_id' => $attributeId,

                ],

                [

                    'value' => $value,

                ]

            );

        }

        return back()->with(

            'success',

            'Attributes saved successfully.'

        );

    }

    public function destroy(AttributeValue $attributeValue) {

        $attributeValue->delete();

        return back()->with(
            'success',
            'Product attribute deleted successfully.'
        );
    }
}
