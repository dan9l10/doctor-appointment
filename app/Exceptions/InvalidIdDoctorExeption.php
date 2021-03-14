<?php

namespace App\Exceptions;

use Exception;
use phpDocumentor\Reflection\Types\AbstractList;

class InvalidIdDoctorExeption extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function render($request)
    {
        return abort(404);
    }
}
