@extends('admin.layouts.app')
@section('title','Category')
@section('content')
    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>Category list</h1>
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Parent Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $key=> $category)
                    <tr>
                      <th scope="row">{{ $key+=1 }}</th>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->parent_name }}</td>
                      <td style="display: flex;">

                        <a href="{{ route('categories.show',$category->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                        <form action="{{ route('categories.destroy',$category->id) }}" id="form-delete{{ $category->id }}" method="POST" style="width:0px">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="btn btn-delete btn-danger" data-id="{{ $category->id }}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
@section('script')
@endsection