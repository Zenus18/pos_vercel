<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with(
                'category:id,name',
                'unit:id,name',
                'discounts:product_id,is_discount_active,is_discount_percentage,discount'
                )
                ->get([
                'id',
                'category_id',
                'unit_id',
                'name',
                'image',
                'selling_price',
                'qty_available',
            ]);

            return response()->json([
                'status' => 200,
                'description' => 'Berhasil ditampilkan',
                'data' => $products,
            ]);
        } catch (\Throwable $th) {
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'error'=> [
                        'status'=> 404,
                        'description'=> 'Data tidak ditemukan',
                    ]
                ], 404);
            } else if ($th ) {
                return response()->json([
                    'error'=> [
                        'status'=> 500,
                        'description'=> 'Terjadi kesalahan pada server',
                    ]
                ], 500);
            } else {
                return response()->json([
                    'error'=> [
                        'status'=> 500,
                        'description'=> 'Terjadi kesalahan pada server',
                    ]
                ], 500);
            }
        }
    }
    // public function productByCategorized($id)
    // {
    //     $category = Category::where('id', $id)->get();
    //     foreach ($category as $header) {
    //         $products = Product::with(
    //             'category:id,name',
    //             'unit:id,name',
    //             'discounts:product_id,is_discount_active,is_discount_percentage,discount'
    //             )
    //             ->where('category_id', $header->id)
    //             ->orderBy('name', 'asc')
    //             ->get([
    //             'id',
    //             'category_id',
    //             'unit_id',
    //             'name',
    //             'image',
    //             'selling_price',
    //             'qty_available',
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 'OK',
    //         'message' => 'Berhasil ditampilkan',
    //         'data' => $products,
    //     ], 200);
    // }
    public function productDetail($id)
    {
        $product = Product::with('discounts:id,is_discount_percentage,discount')
        ->where('id', $id)
        ->get([
            'id',
            'image',
            'name',
            'selling_price',
            'qty_available',
            'description',
        ]);
        return response()->json([
            'status'=> 'OK',
            'message' => 'Detail berhasil ditampilkan',
            'data' => $product,
        ], 200);
    }
    public function productQuery(Request $request)
    {
        $query = $request->query('query');
        $product = Product::with('category','unit','discounts')
        ->where('name', 'like','%'.$query.'%')
        ->get();

        return response()->json($product, 200);
    }
    public function productSearch($input)
    {
        $product = Product::with('discounts:product_id,is_discount_percentage,discount')
        ->where('name', 'like',"%".$input."%")
        ->orWhere('barcode', 'like',"%".$input."%")
        ->orWhere('sku', 'like',"%".$input."%")
        ->get([
            'id',
            'image',
            'name',
            'selling_price',
            'qty_available',
            'description',
        ]);
        return response()->json([
            'status'=> 'OK',
            'message' => 'Detail berhasil ditampilkan',
            'data' => $product,
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
