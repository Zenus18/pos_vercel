<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::orderBy('name','asc')
            ->get([
                'id',
                'name',
            ]);

            return response()->json([
                'status'=> 200,
                'description'=> 'Berhasil menerima data',
                'data'=> $categories
            ], 200);
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
