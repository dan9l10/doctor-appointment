<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public function upload($file){
        $currentUser = auth()->user();
        $save_path = storage_path('app/public/files/user/'.$currentUser->id.'/');
        $filename = date('d-m-y').'.'.$currentUser->id.'.'.uniqid().'.'.$file->getClientOriginalExtension();
        $result = $file->move($save_path,$filename);
        //Storage::put('app/public/files/user/'.$currentUser->id.'/','')
        $publicPath = '/files/user/'.$currentUser->id.'/'.$filename;
        return $publicPath;
    }
}
