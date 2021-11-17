<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Data Products';
        $items = Products::orderBy('name', 'ASC')
                            ->get();
        if( $request->ajax() ){
            return datatables()->of($items)
                                ->addColumn('action', function($data){
                                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-md edit-post"><i class="fa fa-edit"></i></a>';
                                    $button .= '&nbsp;&nbsp;';
                                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-md"><i class="fa fa-trash"></i></button>';     
                                    return $button;
                                })
                                ->rawColumns(['action'])
                                ->addIndexColumn()
                                ->make(true);
        }
        return view('admin.pages.products.index_products', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        if ($request->type == "tambah") {
            $validator = Validator::make( $request->all(), [
                'product_id' => 'required|max:50|unique:products,product_id',
                'name' => 'required|max:50',
                'price' => 'required|max:11',
                'descriptions' => 'nullable',
                'types' => 'required|in:MAKANAN,MINUMAN',
            ]);
        }
        elseif ($request->type == "edit") {
            $user_check = User::find($id);
            $validator = Validator::make( $request->all(), [
                'product_id' => 'required|max:50|unique:products,product_id,'.$user_check->product_id.',product_id',
                'name' => 'required|max:50',
                'price' => 'required|max:11',
                'descriptions' => 'nullable',
                'types' => 'required|in:MAKANAN,MINUMAN',
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $product = Products::updateOrCreate(['id' => $id],
                    [
                        'product_id' => $request->product_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'descriptions' => $request->descriptions,
                        'types' => $request->types,
                        'status' => $request->status,
                    ]); 
            return response()->json($product);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::where('id', $id)->firstOrFail();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::where('id', $id)->delete();
        return response()->json($product);
    }
}
