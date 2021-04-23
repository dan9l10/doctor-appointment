<?php

namespace App\Services;

class PathCreator
{
    public function splitPath($data){
        foreach ($data as $path){
            $array = explode('/',$path);
            $filename = array_pop($array);
            $pathsWithNameFile[] = [
                'path'=>$path,'filename'=>$filename
            ];
        }
        return $pathsWithNameFile;
    }
}
