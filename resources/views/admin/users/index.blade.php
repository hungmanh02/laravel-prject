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
          <form action="" method="GET">
            <div class="row">
              
              <div class="col-5">
                <select class="form-control" name="gender" id="">
                  <option value="0">Select Gender</option>
                  <option value="male" {{ request()->gender=='male' ? "selected" : false }}>Male</option>
                  <option value="fe-male" {{ request()->gender=='fe-male' ? "selected" : false }}>FeMale</option>
                </select>
              </div>
              <div class="col-5">
                <input type="search" class="form-control" placeholder="Từ khóa tìm kiếm ..." name="keywords" value="{{ request()->keywords }}">
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
              </div>
            </div>
          </form>
          <div class="row" style="margin: 0 3px">
            <table class="table table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sort" style="width: 10px">#
                      <a href="?sort-by=id&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">Image</th>
                    <th scope="col" class="sort">Name
                      <a href="?sort-by=name&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">Email
                      <a href="?sort-by=email&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">Phone
                      <a href="?sort-by=phone&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th class="sort" style="width: 15px">Gender
                      <a href="?sort-by=gender&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $key=> $user)
                  <tr>
                    <th scope="row">{{ $key+=1 }}</th>
                    <td><img src="{{ $user->images->count() >0 ? asset('upload/'.$user->images->first()->url):'' }}" width="55px" height="50px" alt=""></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->gender=='male'? "Male":"FeMale" }}</td>
                    <td style="display: flex;">
                      <a href="{{ route('users.show',$user->id) }}" class="btn btn-info">View</a>
                      <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning" style="margin-left: 4px;margin-right: 4px">Edit</a>
                      <form action="{{ route('users.destroy',$user->id) }}" id="form-delete{{ $user->id }}" method="POST" style="width:0px">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-danger" data-id="{{$user->id}}">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
          <div>
            {{ $users->links() }}
          </div>

        </div>
    </div>
@endsection