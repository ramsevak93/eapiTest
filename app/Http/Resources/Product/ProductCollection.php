<?php
use App\Model\Product;
namespace App\Http\Resources\Product;
use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
	    return [
			'name' => $this->name,
			'TotalPrice' => round($this->price - ($this->price * $this->discount)/100,2),
			'Rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2):'No Rating Yet',
			'Discount' => $this->discount,
			'href' => [
			      'Link' => route('products.show',$this->id)
			]
		];
    }
}
