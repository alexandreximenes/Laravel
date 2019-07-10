<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Seller $seller
     * @return void
     */
    public function index(Seller $seller)
    {
        $products = $seller->products();

        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
         $rules = [
             'name' => 'required',
             'description' => 'required',
             'quantity' => 'required|integer|min:1',
             'image' => 'required|image',
         ];

         $data = $request->all();

         $data['status'] = Product::UNAVAILABLE_PRODUTO;
         $data['image'] = '1.jpg';
         $data['seller_id'] = $seller->id;

        $this->validate($request, $rules);

        $product = Product::create($data);

        return $this->showOne($product);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Seller $seller
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::UNAVAILABLE_PRODUTO . ',' . Product::UNAVAILABLE_PRODUTO,
            'image' => 'image'
        ];

        $this->validate($request, $rules);

        $this->checkSeller($seller, $product);

        $product->fill($request->intersect([
            'name',
            'description',
            'quantity'
        ]));

        if($request->has('status')){
            $product->status = $request->status;
            if($product->isAvailable() && $product->categories()->count() === 0){
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if($product->isClean()){
            return $this->errorResponse('you need to specify a different value to update', 422);
        }

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Seller $seller
     * @param Product $product
     * @return void
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);

        $product->delete();

        return $this->showOne($product);

    }

    private function checkSeller(Seller $seller, Product $product)
    {
        if($seller->id !== $product->seller_id){
            throw new HttpException(422, 'The specified seller is not the actual seller of the product');
        }
    }
}
