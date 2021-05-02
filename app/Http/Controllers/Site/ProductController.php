<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductInterface;
use App\Repositories\Contracts\AttributeInterface;

class ProductController extends Controller
{
    protected $productRepository , $attributeRepository;

    public function __construct(ProductInterface $productRepository ,
                    AttributeInterface $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->$attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.product', compact('product', 'attributes'));
    }
    
    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->price, $request->qty, $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }

}