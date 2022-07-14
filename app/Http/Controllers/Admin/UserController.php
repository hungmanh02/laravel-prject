<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;
    public function __construct(User $user,Role $role)
    {
        $this->user=$user;
        $this->role=$role; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=$this->user->latest('id')->paginate(5);
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $roles=$this->role->all()->groupBy('group');
        return view('admin.users.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate=$request->all();
        $dataCreate['password']=Hash::make($request->password);
        $dataCreate['image']=$this->user->saveImage($request);
        // dd($dataCreate['image']);
        $user=$this->user->create($dataCreate);
        $user->images()->create(['url'=>$dataCreate['image']]);
        $user->roles()->attach($dataCreate['role_ids']);
        return redirect()->route('users.index')->with(['message'=>'create success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user=$this->user->findOrFail($id)->load('roles');//theo id vào load ra roles
        $roles=$this->role->all()->groupBy('group');
        return view('admin.users.edit',['user'=>$user,'roles'=>$roles]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user=$this->user->findORFail($id)->load('roles');
        $dataUpdate=$request->except('password');
        if($request->password){
            $dataUpdate['password']=Hash::make($request->password);
        }
        $curentImage=$user->images->count() >0  ? $user->images->first()->url:'';
        $dataUpdate['image']=$this->user->updateImage($request,$curentImage);
        // dd($dataUpdate['image']);
        $user->update($dataUpdate);
        $user->images()->delete();
        $user->images()->updateOrCreate(['url'=>$dataUpdate['image']]);
        $user->roles()->sync($dataUpdate['role_ids'] ?? []);
        return redirect()->route('users.index')->with(['message'=>'update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=$this->user->findORFail($id)->load('roles');
        $user->images()->delete();
        $imageName= $user->images->count() >0  ? $user->images->first()->url:'';
        $this->user->deleteImage($imageName);
        $user->delete();
        return redirect()->route('users.index')->with(['message'=>'delete success']);

    }
}
