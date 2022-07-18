@extends('admin.layouts.app')
@section('title','Products')
@section('content')
    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>Product list</h1>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
          <div class="row">
            <table class="table table-hover table-bordered">
                <thead style="text-align: center">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Sale</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $key=> $product)
                    <tr>
                      <th style="text-align: center;" scope="row">{{ $key+=1 }}</th>
                      <td style="text-align: center;"><img src="{{ $product->image_url ? asset('upload/'.$product->image_url):'' }}" width="55px" height="50px" alt=""></td>
                      <td>{{ $product->name }}</td>
                      <td style="text-align: center;">{{ $product->price }}</td>
                      <td style="text-align: center;">{{ $product->sale }}</td>
                      <td style="display: flex;justify-content: center">

                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('products.edit',$product->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST" id="form-delete{{ $product->id }}">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $product->id }}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
          </div>
          <div>
            {{ $products->links() }}
          </div>
        </div>
    </div>
@endsection