<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $carts = Cart::whereNull('transaction_id')->orderBy("id","asc")->get();
        
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
            'qty' =>'required',
        ])->validate();
        $transaction_id = null;
        $creator_id = 1;
        $product_id = 1;
        $price = 15000;
        $qty = $request->input('qty'); 
        $sub_total = $price * $qty;
        $discount = 0;
        $total = $sub_total - $discount;

        $addToCart = Cart::create([
            'transaction_id' => $transaction_id,
            'creator_id'=> $creator_id,
            'product_id'=> $product_id,
            'qty'=> $qty,
            'sub_total'=> $sub_total,
            'discount'=> $discount,
            'total'=> $total,
        ]);

        return response()->json($addToCart, 200);
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