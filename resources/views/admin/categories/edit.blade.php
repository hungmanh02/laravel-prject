@extends('admin.layouts.app')
@section('title','Edit Category')
@section('content')
    <div class="card">
        <h1>Edit category</h1> 
        <div>
            <form action="{{ route('categories.update',$category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group input-group input-group-static mb-4">
                    <label >Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') ?? $category->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($category->childrens->count() < 1)
                <div class="input-group input-group-static">
                    <label  class="ms-0">Parent Category</label>
                    <select  class="form-control" name="parent_id" >
                        <option value="">Select Parent Category</option>
                        @foreach ($parentCategory as $item)
                        <option value="{{ $item->id }}" {{ (old('parent_id') ?? $category->parent_id)==$item->id ? 'selected':''}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>  
                @endif
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>

            </form>
        </div>   
    </div>
    
@endsection