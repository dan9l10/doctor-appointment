<?php

namespace App\Services;

class PathCreator
{
    public function splitPath($data){
        foreach ($data as $path){
            $array = explode('/',$path);
            $filename = array_pop($array);
            $explodedFilename = explode('.',$filename);
            $extension = strtolower(array_pop($explodedFilename));
            $pathsWithNameFile[] = [
                'path'=>$path,'filename'=>$filename,'extension'=>$extension,
            ];
        }
        return $pathsWithNameFile;
    }
}
