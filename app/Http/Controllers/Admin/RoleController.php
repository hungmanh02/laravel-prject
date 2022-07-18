<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roles;
    public function __construct()
    {
        $this->roles=new Role();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters=[];
        $keywords=null;
        if(!empty($request->group)){
            $group=$request->group;
            $filters[]=['group','=',$group];
        }
        if(!empty($request->keywords)){
            // search thì có Orwhere
            $keywords=$request->keywords;
        }
        // xử lý logic sắp xếp
        $sortBy=$request->input('sort-by');
        $allowSort=['asc','desc'];
        $sortType=$request->input('sort-type');
        // áp dụng trong trường hợp có du liệu sorttype và không được sửa trên url
        // chỉ sự dung trong 2 p. tử trong mảng allowSort
        if(!empty($sortType) && in_array($sortType,$allowSort)){
            if($sortType=='desc'){
                $sortType='asc';
            }else{
                $sortType='desc';
            }
        }else{
            $sortType='asc';
        }
        $sortArr=[
            'sortBy'=>$sortBy,
            'sortType'=>$sortType,
        ];
        
        $roles=$this->roles->getAllRoles($filters,$keywords,$sortArr);
        return view('admin.roles.index',['roles'=>$roles,'sortType'=>$sortType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // group các quyền lại 
        $permissions=Permission::all()->groupBy('group');
        return view('admin.roles.create',['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $dataCreate=$request->all();//tất cả request của form
        $dataCreate['guard_name']='web';// mặc định
        //tạo role
        $role=Role::create($dataCreate);
        $role->permissions()->attach($dataCreate['permission_ids']);
        return redirect()->route('roles.index')->with(['message'=>'create success']);
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
        // sự dung with ở đây để tránh câu query N+1
        $role=Role::with('permissions')->findOrFail($id);
        // lấy tất cả các quyền
        $permissions=Permission::all()->groupBy('group');
        return view('admin.roles.edit',['role'=>$role,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        //Tìm id của role
        $role=Role::findOrFail($id);
        $dataUpdate=$request->all();
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permission_ids']);
        return redirect()->route('roles.index')->with('message','update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index')->with('message','delete success');
    }
}
