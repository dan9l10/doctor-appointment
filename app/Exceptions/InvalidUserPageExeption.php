<?php

namespace App\Exceptions;

use Exception;

class InvalidUserPageExeption extends Exception
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
