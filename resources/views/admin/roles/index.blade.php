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
          <form action="" method="GET">
            <div class="row">
              
              <div class="col-5">
                <select class="form-control" name="group" id="">
                  <option value="0">Select Group</option>
                  <option value="system" {{ request()->group=='system' ? "selected" : false }}>System</option>
                  <option value="user" {{ request()->group=='user' ? "selected" : false }}>User</option>
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
                    <th scope="col" class="sort">
                      #
                      <a href="?sort-by=id&sort-type={{ $sortType }}" >
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">
                      Name
                      <a href="?sort-by=name&sort-type={{ $sortType }}">
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">
                      Display Name
                      <a href="?sort-by=display_name&sort-type={{ $sortType }}">
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col" class="sort">
                      Group
                      <a href="?sort-by=group&sort-type={{ $sortType }}">
                        <i class="fa fa-fw fa-sort"></i>
                      </a>
                    </th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $key=> $role)
                  <tr>
                    <th scope="row">{{ $key+=1 }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->group }}</td>
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
          </div>
            <div>

              {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection