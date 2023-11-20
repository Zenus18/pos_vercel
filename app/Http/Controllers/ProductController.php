<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Notes:
    // 1. is_discount_active = true === show <> false
    // 2. jika ada value null === ubah ke bentuk string "tidak tersedia/kosong"
    /**
     * Display a listing of the resource.
     */
    public function index() #is_qty_active = true = show / false = hide
    {
        try {
            $products = Product::with(
                'category:id,name',
                'unit:id,name',
                'discount:id,is_discount_active,is_discount_percentage,discount'
                )
                ->get([
                'id',
                'category_id',
                'unit_id',
                'discount_id',
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
            } else if ($th ) { #Tidak bisa diakses (auth error)
                return response()->json([
                    'error'=> [
                        'status'=> 400,
                        'description'=> 'Tidak bisa diakses',
                    ]
                ], 400);
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

    public function detail($id)
    {
        $product = Product::with('discount:id,is_discount_active,is_discount_percentage,discount')
        ->where('id',$id)
        ->get([
            'id',
            'discount_id',
            'image',
            'name',
            'selling_price',
            'qty_available',
            'description',
        ])
        ;
        return response()->json([
            'status'=> 200,
            'message' => 'Detail berhasil ditampilkan',
            'data' => $product,
        ], 200);
    }

    public function productQuery($name=null, $category=null)
    {
        $products = Product::get();

        if ($name != null && $name != "") {
            $products->where('name', 'like', '%' . $name . '%');
        }

        if ($category != null && $category != "") {
            $products->whereHas('category', function ($query) use ($category) {
                $query->where('category.name', $category);
            });
        }

        return response()->json($products, 200);
    }
    // public function productSearch($input)
    // {
    //     $product = Product::with('discounts:product_id,is_discount_percentage,discount')
    //     ->where('name', 'like',"%".$input."%")
    //     ->orWhere('barcode', 'like',"%".$input."%")
    //     ->orWhere('sku', 'like',"%".$input."%")
    //     ->get([
    //         'id',
    //         'image',
    //         'name',
    //         'selling_price',
    //         'qty_available',
    //         'description',
    //     ]);
    //     return response()->json([
    //         'status'=> 'OK',
    //         'message' => 'Detail berhasil ditampilkan',
    //         'data' => $product,
    //     ], 200);
    // }
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
