<?php

namespace App\Models;

use App\Traits\HandleUploadImageTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    use HandleUploadImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
    public function getAllUsers($filters =[],$keywords=null,$sortByArr=null)
    {
        $users=DB::table($this->table);
        $orderBy='id';
        $orderType='desc';
        if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy=trim($sortByArr['sortBy']);
                $orderType=trim($sortByArr['sortType']);
            }
        }

        $users=$this->orderBy($orderBy,$orderType);

        if(!empty($filters)){
            $users=$this->where($filters);
        }
        if(!empty($keywords)){
            $users=$this->where(function($query) use($keywords){
                $query->orWhere('name','like','%'.$keywords.'%');
                $query->orWhere('gender','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
                $query->orWhere('phone','like','%'.$keywords.'%');
            });
        }

        $users=$users->paginate(5)->withQueryString();
        return $users;
    }
}
