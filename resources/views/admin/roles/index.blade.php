@extends('admin.layouts.app')
@section('title','Roles')
@section('content')
    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>Role list</h1>
        <div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Display Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $key=> $role)
                    <tr>
                      <th scope="row">{{ $key+=1 }}</th>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->display_name }}</td>
                      <td style="display: flex;">

                        <a href="{{ route('roles.show',$role->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                        <form action="{{ route('roles.destroy',$role->id) }}" id="form-delete{{ $role->id }}" method="POST" style="width:0px">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="btn btn-delete btn-danger" data-id="{{$role->id}}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
            {{ $roles->links() }}
        </div>
    </div>
@endsection
@section('script')
@endsection