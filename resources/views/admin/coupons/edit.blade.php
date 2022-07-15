@extends('admin.layouts.app')
@section('title','Edit Coupon')
@section('content')
    <div class="card">
        <h1>Edit coupon</h1> 
        <div>
            <form action="{{ route('coupons.update',$coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group input-group input-group-static mb-4">
                    <label >Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') ?? $coupon->name }}" style="text-transform: uppercase">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group input-group-static mb-4">
                    <label >Value</label>
                    <input type="number" name="value" class="form-control" value="{{ old('value') ?? $coupon->value }}">
                    @error('value')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static">
                    <label  class="ms-0">Type</label>
                    <select  class="form-control" name="type">
                        <option >Select Type</option>
                        <option value="money" {{ old('type') ?? $coupon->type == 'money' ? 'selected' :""}}>Money</option>
                        
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group input-group-static mb-4">
                    <label >Expery Date</label>
                    <input type="date" name="expery_date" class="form-control" value="{{ old('expery_date') ?? $coupon->expery_date }}">
                    @error('expery_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>    
        </div>   
    </div>
    
@endsection