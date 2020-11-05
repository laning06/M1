<?php
    namespace f3il;
    abstract class Controller{

        public function getDefaultActionName(){
            throw new Error("controlleur : aucune action par defaut n'a été definie pour
             la classe".get_class($this));

        }


        public function execute($actionName){
            $actionMethod = $actionName.'Action';
            if(!\method_exists($this,$actionMethod)){
                throw new Error("Controller : action non diponible ".$actionName.
                "  pour le controlleur  ".\get_class($this));
            }
            $this->$actionMethod();
        }
    }




?>