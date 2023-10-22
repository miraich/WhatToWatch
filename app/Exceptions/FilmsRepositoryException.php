<?php

namespace app\Exceptions;

class FilmsRepositoryException extends \Exception
{
    public function getStatusCode()
    {
        return 500;
    }
}
