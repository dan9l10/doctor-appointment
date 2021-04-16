<?php

namespace App\Services;


class FileUpload
{
    public function upload($files){
        $currentUser = auth()->user();
        $save_path = storage_path('app/public/files/user/'.$currentUser->id.'/');
        foreach ($files as $file){
            $filename = date('d-m-y').'.'.uniqid().'file.'.$file->getClientOriginalExtension();
            $file->move($save_path,$filename);
        }
    }
}
