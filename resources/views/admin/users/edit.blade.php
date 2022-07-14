@extends('admin.layouts.app')
@section('title','Edit User ')
@section('content')
    <div class="card">
        <h1>Edit user {{ $user->name }}</h1> 
        <div>
            <form action="{{ route('users.update',[$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-md-6">  
                    <div class="row">
                        <div class=" input-group-static mb-4 col-md-8">
                            <label >Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <img src="{{ $user->images->count() > 0 ? asset('upload/'.$user->images->first()->url):'' }}" width="55px" height="55px"id="show-image" alt="">
                        </div>
                    </div>             
                </div>
                <div class="col-md-6">
                    <div class="input-group  input-group-static mb-4">
                        <label >Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email}}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                
            </div>
            <div class="row">
                <div class="col-md-6">               
                    <div class="input-group  input-group-static mb-4">
                        <label >Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name}}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Password</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') ?? $user->password }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group  input-group-static mb-4">
                        <label >Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') ??$user->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static">
                        <label  class="ms-0">Gender</label>
                        <select  class="form-control" name="gender">
                          <option value="male">Male</option>
                          <option value="fe-male">FeMale</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group input-group input-group-static mb-4">
                        <label >Address</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ old('address')?? $user->address }}</textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <label for=""><h2>Roles</h2></label>
                    <div class="row">
                        @foreach ($roles as $groupName =>$role)
                        <div class="col-4">
                            <h4>{{ $groupName }}</h4>
                            <div>
                                @foreach ($role as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" name="role_ids[]" type="checkbox" 
                                        {{ $user->roles->contains('id',$item->id) ?'checked' :'' }}
                                        value="{{ $item->id }}">
                                        <label class="custom-control-label" for="customCheck1">{{ $item->display_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-submit btn-primary">Update</button>
            </form>    
        </div>   
    </div>
    
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });



        });
    </script>
@endsection