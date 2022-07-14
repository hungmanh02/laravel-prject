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
            <table class="table table-hover">
                <thead>
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
                      <th scope="row">{{ $key+=1 }}</th>
                      <td><img src="{{ $product->images->count() >0 ? asset('upload/'.$product->images->first()->url):'' }}" width="55px" height="55px" alt=""></td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->sale }}</td>
                      <td style="display: flex;">

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
            {{ $products->links() }}
        </div>
    </div>
@endsection