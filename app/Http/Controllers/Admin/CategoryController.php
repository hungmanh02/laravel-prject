<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category=$category;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=$this->category->latest('id')->paginate(5);
        return view('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory=$this->category->getParents();
        return view('admin.categories.create',['parentCategory'=>$parentCategory]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $dataCreate=$request->all();
        $category=$this->category->create($dataCreate);
        return redirect()->route('categories.index')->with(["message"=>"create new category: ".$category->name." success"]);
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
        $category=$this->category->with('childrens')->findOrFail($id);
        $parentCategory=$this->category->getParents();
        return view('admin.categories.edit',['category'=>$category,'parentCategory'=>$parentCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $dataUpdate=$request->all();
        $category=$this->category->findOrFail($id);
        $category->update($dataUpdate);
        return redirect()->route('categories.index')->with(['message'=>'update  success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=$this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with(['message'=>'delete  success']);

    }
}
