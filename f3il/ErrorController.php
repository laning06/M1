<?php
namespace f3il;
class ErrorController extends Controller{
    
    public function getDefaultActionName()
    {
        return 'error';
    }
    public function errorAction()
    {
        header('HTTP/1.1 500 Internal Server Error', true,500);
        die();
    }
}


?>