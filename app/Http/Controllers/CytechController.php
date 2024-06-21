<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Companies;

class CytechController extends Controller
{
    public function index(Request $request)
    {
        $product_model = new Products();
        $products = $product_model -> getProductList($request);
        $companies = $product_model -> companySelect();

        return view ('product_list', ['products' => $products, 'companies' => $companies]);
    }

    public function create()
    {
        $product_model = new Products();
        $companies = $product_model -> companySelect();
        return view ('product_register', ['companies' => $companies]);
    }


    public function post (ProductRequest $request)
    {
        $image = $request -> file ('img_path');
        if ($image){
            $file_name = $image -> getClientOriginalName();
            $image -> storeAs ('public/images', $file_name);
            $img_path =  "images/$file_name";
        } else{
            $img_path = null;
        }
 
        $product = new Products();

        DB::beginTransaction();
        
        try{
            $product -> registProduct($request, $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect() -> route('product.create');
    }


    public function edit($id)
    {
        $product_model = new Products();
        $products = $product_model -> productIdShow($id);
        $companies = $product_model -> companySelect();
  
        return view ('product_edit',['product' => $products, 'companies' => $companies]);
    }


    public function show ($id)
    {
        $product_model = new Products();
        $products = $product_model -> productIdShow($id);
 
        return view ('product_information',['product' => $products]);
        
    }


    public function update (Products $product, ProductRequest $request)
    {
        $image = $request -> file ('img_path');
        if ($image){
            $file_name = $image -> getClientOriginalName();
            $image -> storeAs ('public/images', $file_name);
            $img_path =  "images/$file_name"; 
        }  else{
            $img_path = null;
        }

        DB::beginTransaction();
        
        try{
            $model = new  Products();
            $model -> productEdit($product, $request, $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        
        return redirect() -> route('product.edit', $product -> id); 
    }

    
    public function delete (Products $product)
    {
        DB::beginTransaction();
        
        try{
            $model = new  Products();
            $model -> productDelete($product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect() -> route('product.list');
    }
}
