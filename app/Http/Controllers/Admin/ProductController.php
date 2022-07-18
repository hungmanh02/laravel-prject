<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $category;
    public function __construct(Product $product,Category $category)
    {
        $this->product=$product;
        $this->category=$category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products=$this->product->latest('id')->paginate(5);
        $products=$this->product->getAllProducts();
        return view('admin.products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=$this->category->get(['id','name']);//lấy id và name của category
        return view('admin.products.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $dataCreate=$request->all();
        $product=$this->product->create($dataCreate);
        $dataCreate['image']=$this->product->saveImage($request);
        $product->images()->create(['url'=>$dataCreate['image']]);
        $product->categories()->attach($dataCreate['category_id']);
        // dd($product);
        return redirect()->route('products.index')->with(['message'=>'create success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=$this->product->with(['categories'])->findOrFail($id);
        return view('admin.products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=$this->category->get(['id','name']);//lấy id và name của category
        $product=$this->product->with(['categories'])->findOrFail($id);
        return view('admin.products.edit',['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
       
        $product=$this->product->findOrFail($id);
    
        $curentImage=$product->images->count() >0  ? $product->images->first()->url:'';
        $dataUpdate['image']=$this->product->updateImage($request,$curentImage);
        // dd($dataUpdate['image']);
        $product->update($dataUpdate);
        $product->images()->delete();
        $product->images()->updateOrCreate(['url'=>$dataUpdate['image']]);
        $product->categories()->sync($dataUpdate['category_id']??[]);
        return redirect()->route('products.index')->with(['message'=>'update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=$this->product->findORFail($id)->load('categories');
        $product->images()->delete();
        $imageName= $product->images->count() >0  ? $product->images->first()->url:'';
        $this->product->deleteImage($imageName);
        $product->delete();
        return redirect()->route('products.index')->with(['message'=>'delete success']);
    }
}
