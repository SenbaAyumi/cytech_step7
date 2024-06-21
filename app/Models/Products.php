<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB; 

class Products extends Model
{
    use HasFactory;



    public function getProductList($request) {
        $keyword = $request -> input ('search');
        $select = $request -> select;

        if (!empty($keyword)) {
            $products = DB::table('products') 
            -> where ('product_name', 'LIKE', "%{$keyword}%")
            -> join('companies', 'products.company_id', '=', 'companies.id')
            -> select('products.*', 'companies.id as comid', 'companies.company_name')
            -> paginate(5);
        } elseif (!empty($select)) {
            $products = DB::table('products')
            -> where ('company_id', 'LIKE', "%{$select}%")
            -> join('companies', 'products.company_id', '=', 'companies.id')
            -> select('products.*', 'companies.id as comid', 'companies.company_name')
            -> paginate(5);
        } else {
        $products = DB::table('products') 
        -> join('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'companies.id as comid', 'companies.company_name')
        -> paginate(5);
        }

        return $products;
    }


    public function registProduct($request, $img_path){

        DB::table('products') -> insert([
            'product_name' => $request -> product_name,
            'company_id' => $request -> company_id,
            'price' => $request -> price,
            'stock' => $request -> stock,
            'comment' => $request -> comment,
            'img_path' => $img_path,
        ]);

    }


    public function productIdShow($id){
        $products = DB::table('products') 
        -> join('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.*', 'companies.id as comid', 'companies.company_name')
        -> where('products.id', $id) 
        -> first();
        return $products;
    }


    public function productEdit($product, $request, $img_path){
        DB::table('products') -> where('id', $product -> id) -> update([
            'product_name' => $request -> product_name,
            'company_id' => $request -> company_id,
            'price' => $request -> price,
            'stock' => $request -> stock,
            'comment' => $request -> comment,
            'img_path' => $img_path, 
        ]);
    }


    public function productDelete($product){
        DB::table('products') -> where('id', $product -> id) ->delete();
    }

    
    public function companySelect(){
        $companies = DB::table('products')
        -> join('companies', 'products.company_id', '=', 'companies.id')
        -> select('products.company_id', 'companies.id as comid', 'companies.company_name')
        -> get();

        return $companies;

    }
    

}
