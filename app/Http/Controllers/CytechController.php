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
        $companies = Companies::all();

        $keyword = $request -> input ('search');
        $select = $request -> select;

        if (!empty($keyword)) {
            $query = Products::query();
            $query -> where ('product_name', 'LIKE', "%{$keyword}%");
            $products = $query -> paginate(5);
        } elseif (!empty($select)) {
            $query = Products::query();
            $query -> where ('company_id', 'LIKE', "%{$select}%");
            $products = $query -> paginate(5);
        } else {
        $products = Products::paginate(5);
        }
        return view ('product_list', ['products' => $products, 'keyword' => $keyword ])
        -> with ('companies', $companies);
    }

    public function create()
    {
        $companies = Companies::all();
        return view ('product_register')
        -> with ('companies', $companies);
    }

    public function post (ProductRequest $request)
    {

        $image = $request -> file ('img_path');
        if ($image){
            $file_name = $image -> getClientOriginalName();
            $image -> storeAs ('public/images', $file_name);
        }    
        
        $product = new Products;
        $product -> product_name = $request -> input(['product_name']);
        $product -> company_id = $request -> input(['company_id']);
        $product -> price = $request -> input(['price']);
        $product -> stock = $request -> input(['stock']);
        $product -> comment = $request -> input(['comment']);
       
       if ($image){
        $product -> img_path = "images/$file_name";
       } 
                 
        $product -> save();

        return redirect() -> route('product.show', $product->id);
    }

    public function edit($id)
    {
        $product = Products::find($id);
        $companies = Companies::all();
        return view ('product_edit',['product' => $product])
        -> with ('companies', $companies);
    }

    public function show ($id)
    {
        $product = Products::find($id); 
        $companies = Companies::all();
        return view ('product_information',['product' => $product])
        -> with ('companies', $companies);
        
    }

    public function update (Products $product, ProductRequest $request)
    {
        $image = $request -> file ('img_path');
        if ($image){
            $file_name = $image -> getClientOriginalName();
            $image -> storeAs ('public/images', $file_name);
        }  
        

        $product -> product_name = $request -> input(['product_name']);
        $product -> company_id = $request -> input(['company_id']);
        $product -> price = $request -> input(['price']);
        $product -> stock = $request -> input(['stock']);
        $product -> comment = $request -> input(['comment']);
        if ($image){
            $product -> img_path = "images/$file_name";
           } 
        $product -> save();

        return redirect() -> route ('product.show', $product->id); 
    }

    public function delete (Products $product)
    {
        $product->delete();
        return redirect() -> route('product.list');
    }
}
