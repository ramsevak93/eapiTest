<?php
namespace App\Http\Controllers;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use DB;


class ProductController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth:api')->except('index','show');
	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return ProductCollection::collection(Product::paginate(10));
    }

    
    public function create()
    {
        
    }

   
    public function store(ProductRequest $request)
    {
        $product = new Product();
		
		$product->name = $request->name;
		$product->detail = $request->description;
		$product->price = $request->price;
		$product->stock = $request->stock;
		$product->discount = $request->discount;
		$product->save();
		
		return response([
		
		   'data'=> new ProductResource($product)	
		   
		],201);
    }

    
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

   
    public function edit(Product $product)
    {
        
    }

    
    public function update(Request $request, Product $product)
    {
		
		$product->update($request->all());
		
	    return response([
		
		   'data'=> new ProductResource($product)	
		   
		],201);
    }

    
    public function destroy(Product $product)
    {
	    $product->delete();
		
		DB::table('reviews')->where('product_id', $product->id)->delete();
	
		
		return response(null,Response::HTTP_NO_CONTENT);
    }
}
