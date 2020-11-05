<?php
namespace app\errors;
use \f3il\Error;

class sqlError extends Error{
    protected $querry;
    public function __contruct($message, $querry)
    {
        parent::__contruct($message);
        $this->renderFile= __DIR__.'/html/sqlerror.html.php';
        $this->querry=$querry;
    }
}


?>