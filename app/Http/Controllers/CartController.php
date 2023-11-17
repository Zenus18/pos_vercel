<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
        $carts = Cart::with(
            'product:id,discount_id,name,image,selling_price',
            'product.discount:id,is_discount_active,is_discount_percentage,discount'
            )
            ->whereNull('transaction_id')
            ->orderBy("id","asc")
            ->get();

        $sub_total = 0;
        $discount = 0;
        $total = 0;

        foreach ($carts as $calculate) {
            $total +=  $calculate->total;
            $sub_total +=  $calculate->sub_total;
        }

        $discount = $sub_total - $total;

        $to_be_paid = [
            "sub_total"=> $sub_total,
            "discount"=> $discount,
            "total"=> $total,
        ];

        return response()->json([
                'status' => 200,
                'description' => 'Berhasil ditampilkan',
                'to_be_paid' => $to_be_paid,
                'data' => $carts,
            ], 200);
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
        Validator::make($request->all(), [
            'qty' => 'required',
            'product_id' => 'required',
        ])->validate();

        $creator_id = 1;
        $qty = $request->input('qty');
        $product_id = $request->input('product_id');

        $product = Product::findOrFail($product_id);
        $price = $product->selling_price;
        $sub_total = $price * $qty;
        $discount_id = $product->discount_id;
        $discount = 0;

        try {
            if ($discount_id != null) {
                $discData = Discount::findOrFail($discount_id);

                if ($discData->is_discount_active === 1) {
                    if ($discData->is_discount_percentage === 1) {
                        $discount = ($price * ($discData->discount / 100)) * $qty;
                    } else {
                        $discount = $discData->discount * $qty;
                    }
                } else {
                    $discount = 0;
                }
            } else {
            $discount = 0;
            }

            $total = $sub_total - $discount;

            $createCart = Cart::create([
                'transaction_id' => null,
                'creator_id'=> $creator_id,
                'product_id'=> $product_id,
                'qty'=> $qty,
                'sub_total'=> $sub_total,
                'discount'=> $discount,
                'total'=> $total,
            ]);

            return response()->json([
                'status' => 201,
                'description' => 'Berhasil mengirim data',
                'data' => $createCart,
            ], 201);
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

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
