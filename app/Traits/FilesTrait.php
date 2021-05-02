<?php

namespace App\Http\Traits;
//use App\Models\Product;
use Illuminate\Support\Facades\File;


trait FilesTrait
{
        /*string s : in case of site_logo==>> $s='_1_',
          and in case of favicon ==>>$s='_2_'
          that because these 2 photos often will have same name
          (same user, same time) */
        //File could be an Image
    public function uploadImage($file,$path,$s='_'){

        $file_extension=$file->getClientOriginalExtension();
        $file_name=auth()->user()->id.$s.time().'.'.$file_extension;
        $file->move($path,$file_name);
        return $file_name;
    }
    public function deleteFile($path,$file_name){
    	$file_path=$path.$file_name;
    	File::delete($file_path);
    }
    public function updateFile($file,$path,$file_name,$s='_'){
        $this->deleteFile($path,$file_name);
        return $this->uploadImage($file,$path,$s);
    }

}
