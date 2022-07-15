@extends('admin.layouts.app')
@section('title','Coupon')
@section('content')
    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>Category list</h1>
        <div>
            <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Type</th>
                      <th scope="col">Value</th>
                      <th scope="col">Expery Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($coupons as $key=> $coupon)
                    <tr>
                      <th scope="row">{{ $key+=1 }}</th>
                      <td>{{ $coupon->name }}</td>
                      <td>{{ $coupon->type }}</td>
                      <td>{{ $coupon->value }}</td>
                      <td>{{ $coupon->expery_date }}</td>
                      <td style="display: flex;">

                        <a href="{{ route('coupons.show',$coupon->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('coupons.edit',$coupon->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                        <form action="{{ route('coupons.destroy',$coupon->id) }}" id="form-delete{{ $coupon->id }}" method="POST" style="width:0px">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="btn btn-delete btn-danger" data-id="{{ $coupon->id }}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
@section('script')
@endsection