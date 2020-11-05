<?php
namespace f3il;
class Page{
    private static $_instance =null;
    protected $viewFile = null;
    protected $templateFile = null;
    protected $data = [];

    private function __contruct(){

    }
    //constructeur
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new page();
        }
        return self::$_instance;
    }

    //Setteur pour la page view
    public function setView($view){
        $viewFile = VIEW_FOLDER.'/'.$view.'.view.php';
        if(!is_readable($viewFile)){
            throw new Error('Page : fichier de vue introuvable'.$viewFile);
        }
        $this->viewFile = $viewFile;
        return $this;
    }

    //Setteur pour la page template
    public function setTemplate($template){
        $templateFile = TEMPLATE_FOLDER.'/'.$template.'.template.php';
        if(!is_readable($templateFile)){
            throw new Error('Page : fichier de vue introuvable'.$templateFile);
        }
        $this->templateFile = $templateFile;
        return $this;
    }

    //setteur pour faire la vue et le template
    public function init($template, $view)
    {
        $this->setTemplate($template);
        $this->setView($view);
    }
    //function render() pour s'assurer que nos setteurs s'excécutent bien
    public function render(){
        if(is_null($this->templateFile)){
            throw new Error("page : aucun template renseigné");
        }
        require $this->templateFile;
    }
    //function pour inserer la vue
    public function insertView()
    {
        if(\is_null($this->viewFile)){
            throw new Error("page : aucune vue renseigné");
        }
        require $this->viewFile; //$this represente l'objet page
    }

    //isertion de la function module
    public static function insertModule($module)
    {
        $moduleClass = APP_NAMESPACE.'\\Modules\\'.$module;
        if(!class_exists($moduleClass)){
            throw new Error('Page : aucune classe ne correspond au module'.$module);
        }

        $interfaces=\class_implements($moduleClass);
        if(!isset($interfaces['f3il\Module'])){
            throw new Error('Page: la classe '.$module.'ne respecte pas l\'interface');        
    }
    $objModule = new $moduleClass();
    $objModule->render();

    }
}







?>