@extends('admin.layouts.app')
@section('title','Users')
@section('content')
    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>User list</h1>
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key=> $user)
                    <tr>
                      <th scope="row">{{ $key+=1 }}</th>
                      <td><img src="{{ $user->images->count() >0 ? asset('upload/'.$user->images->first()->url):'' }}" width="55px" height="55px" alt=""></td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}</td>
                      <td style="display: flex;">

                        <a href="{{ route('users.show',$user->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST" id="form-delete{{ $user->id }}">
                          @csrf 
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $user->id }}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection