<?php 
namespace App\Traits;

use Intervention\Image\Facades\Image;
// use Nette\Utils\Image;
trait HandleUploadImageTrait
{
    
    protected $path='upload/';
    public function veryfy($request){
        return $request->has('image');
    }
    public function saveImage($request){
        if($this->veryfy($request)){
            $image=$request->file('image');
            $name=time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save($this->path.$name);
            return $name;
        }
    } 
    public function updateImage($request,$curentImage){
        if($this->veryfy($request)){
            $this->deleteImage($curentImage);
            return $this->saveImage($request);
        }
        return $curentImage;
    }
    public function deleteImage($imageName){
        if($imageName &&file_exists($this->path.$imageName)){
            unlink($this->path.$imageName);
        }
    }
}