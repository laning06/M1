<?php
namespace f3il;

class Error extends \Exception{
    
    protected $renderFile;

    public function __construct($message){
        parent::__construct($message);
        $this->renderFile = 'html/error.html.php';
    }

    public function render(){
        $app = Application::getInstance();
        $logger = $app->getLogger();
        $logger-> addError($this->message,array(
            'file'=>$this->getFile(),
            'line'=>$this->getLine()
        ));
        switch($app->getRunMode())
        {
            case Application::DEBUG_MODE:
                $this->debugModeRender();
            break;
            default:
                $this->productionModeRender();
            break;
        }
    }

    private function productionModeRender(){
       Application::redirect('?controller=error');
    }
    private function debugModeRender(){
       $trace = $this->getTrace();
       $file=$this->getFile();
       $line=$this->getLine();
       $function = $trace[0]['function'].'()';
       include $this->renderFile;
       die();

    }
}