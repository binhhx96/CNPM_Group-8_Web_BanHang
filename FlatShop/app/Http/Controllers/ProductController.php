<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Product;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($_GET['id'])){
            $product = Product::find($_GET['id']);
            $product->isActive = 0;
        }else{
            if(isset($_GET['productID'])){
                $product = Product::find($_GET['productID']);
            }else{
                $product = new Product;
                $product->productID = "vvvvvvvv";
            }                    
            
            if($_FILES['pictures']['name']!= ''){            
                $file = $_FILES['pictures']['name'];                              
                $product->pictures = 'images/'.$file;

                if ( ! File::copy($_FILES['pictures']['tmp_name'],'images/'.$file))
                {
                    die("Couldn't copy file");
                }
            }                         

            $product->productname = Input::get('prdname');
            $product->desciption = Input::get('desciption');
            $product->price = Input::get('price');        
            if(Input::get('saleprice') != null)
                $product->saleprice = Input::get('saleprice');
            $product->quantuminstock = Input::get('quantuminstock');            
            $product->categoryID = Input::get('category');
            $product->ownerID = Input::get('owner');        
            $product->dateofbirth  = Carbon::now()->toDateTimeString();
            $product->dateofend  = Carbon::now()->toDateTimeString();
            $product->isActive = 1;    
        }

        if($product->save()){            
            return redirect('list-product');            
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}