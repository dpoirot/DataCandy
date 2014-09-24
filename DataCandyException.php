<?php

class DataCandyException extends Exception
{

    function __construct ($code)
    {
        switch ($code) {
            case 400:
                parent::__construct("The request is missing some parameters or
                 contains parameters that the server cannot understand or
                  process.", $code);
                break;
            case 401:
                parent::__construct("An authentication error occurred.", $code);
                break;
            case 403:
                parent::__construct("Access to the requested resource is
                forbidden with the current user/requester.", $code);
                break;
            case 404:
                parent::__construct("The requested resource cannot be found.",
                    $code);
                break;
            case 405:
                parent::__construct("The requested resource does not support
                the method that was used.", $code);
                break;
            case 406:
                parent::__construct("The client requested a response in an
                invalid format/type.", $code);
                break;
            case 500:
                parent::__construct("An internal error has occurred
                (database errors, PHP errors, etc.).", $code);
                break;
            default:
                parent::__construct("An internal error was catch.", $code);
                break;

        }
    }

    public function __toString()
    {
        return $this->message;
    }
}