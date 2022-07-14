@extends('admin.layouts.app')
@section('title','Show Product')
@section('content')
    <div class="card">
        <h1>Show product</h1> 
        <div>
          
                <div class="row">
                    <div class="col-md-12">   
                        <div class="row">
                           
                            <div class=" input-group-static mb-4 col-md-6">
                                <img src="{{ $product->images->count() >0 ? asset('upload/'.$product->images->first()->url):'' }}" alt="" width="150px" height="150px">
                            </div>
                            <div class="col-md-6">               
                                <div class="input-group  input-group-static mb-4">
                                    <label >Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name')?? $product->name }}" readonly>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Sale</label>
                        <input type="number" name="sale" class="form-control" value="{{ old('sale')?? $product->sale }}" readonly>
                        @error('sale')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group  input-group-static mb-4">
                        <label >Price</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price')?? $product->price }}" readonly>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Discription</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" readonly>
                            {{ old('description')?? $product->description }}
                        </textarea>
                        @error('discription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
        </div>   
    </div>
    
@endsection

@section('script')

   
@endsection