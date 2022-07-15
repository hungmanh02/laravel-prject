<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    protected $table="roles";
    protected $fillable=[
        'name',
        'display_name',
        'group',
        'guard_name'
    ];
    public function getAllRoles($filters =[],$keywords=null){
        $roles=DB::table($this->table)->orderBy('id','desc');
        if(!empty($filters)){
            $roles=$this->where($filters);
        }
        if(!empty($keywords)){
            $roles=$this->where(function($query) use($keywords){
                $query->orWhere('name','like','%'.$keywords.'%');
                $query->orWhere('display_name','like','%'.$keywords.'%');
            });
        }

        $roles=$roles->paginate(5)->withQueryString();
        return $roles;
    }
}
