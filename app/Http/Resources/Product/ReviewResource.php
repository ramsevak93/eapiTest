<?php
use App\Model\Product;
use App\Model\Review;
namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
		return[
		    
			'Customer' => $this->customer,
			'Body' => $this->review,
			'Rating' => $this->star
		];
    }
}
