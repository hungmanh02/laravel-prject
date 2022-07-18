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
    public function getAllRoles($filters =[],$keywords=null,$sortByArr=null){
        $roles=DB::table($this->table);
        $orderBy='id';
        $orderType='desc';
        if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy=trim($sortByArr['sortBy']);
                $orderType=trim($sortByArr['sortType']);
            }
        }

        $roles=$this->orderBy($orderBy,$orderType);

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
