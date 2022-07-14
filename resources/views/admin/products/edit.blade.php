@extends('admin.layouts.app')
@section('title','Edit Product')
@section('content')
    <div class="card">
        <h1>Edit product</h1> 
        <div>
            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">   
                        <div class="row">
                            <div class=" input-group-static mb-4 col-5">
                                <label >Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" input-group-static mb-4 col-5">
                                <img src="{{ $product->images->count() >0 ? asset('upload/'.$product->images->first()->url):'' }}" alt="" width="150px" height="150px">
                            </div>
                        </div>   
                    </div>
                </div>
            <div class="row">
                <div class="col-md-6">               
                    <div class="input-group  input-group-static mb-4">
                        <label >Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name')?? $product->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Sale</label>
                        <input type="number" name="sale" class="form-control" value="{{ old('sale')?? $product->sale }}">
                        @error('sale')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group  input-group-static mb-4">
                        <label >Price</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price')?? $product->price }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static">
                        <label  class="ms-0">Category</label>
                        <select  class="form-control" name="category_id">
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{ $product->categories->contains('id',$item->id) ? 'selected':"" }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Discription</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                            {{ old('description')?? $product->description }}
                        </textarea>
                        @error('discription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>    
        </div>   
    </div>
    
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });



        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/assets/plugin/ckeditor5-build-classic/ckeditor.js') }}"></script>
    <script>
        let sizes = [{
            id: Date.now(),
            size: 'M',
            quantity: 1
        }];
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    {{-- <script src="{{ asset('admin/assets/js/product/product.js') }}"></script> --}}
@endsection