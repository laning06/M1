<?php

namespace f3il;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Application {
    public static $DEBUG_MODE = 'debug';
    public static $PRODUCTION_MODE = 'production';

    private static $_instance = null;

    private $defaultControllerName = null;
    private $runMode = 'production';
    private $logger = null;

    private function __contruct()
    {
        $this->startLogger();
        $this->setRunMode();
    }

    public function startLogger()
    {
        $this->logger = new Logger('f3il');
        $this->logger->pushHandler(new StreamHandler(APP_FOLDER . '/../log/app.log', Logger::DEBUG));
        $this->logger->info('App started');
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function setRunMode()
    {
        $conf = Configuration::getInstance();
        if (isset($conf->run_mode) && $conf->run_mode === self::DEBUG_MODE) {
            $this->runMode = self::DEBUG_MODE;
            \error_reporting(E_ALL);
        } else {
            \error_reporting(E_ALL);
        }
    }

    public function getRunMode()
    {
        return $this->runMode;
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Application();
            self::$_instance->startLogger();
        }
        return self::$_instance;
    }

    public static function getControllerClass($controllerName)
    {
        if ($controllerName == 'error') {
            return 'f3il\\ErrorController';
        }
        $controllerClass = APP_NAMESPACE . '\controllers\\' . $controllerName . 'Controller';
        if (!class_exists($controllerClass)) {
            self::Error('Application : controleur introuvable' . $controllerClass);
        }
        return $controllerClass;
    }

    public static function Error($message) {
        self::$_instance->logger->error($message);
    }

    public function setDefaultControllerName($controllerName)
    {
        $this->defaultControllerName = $controllerName;
    }

    public function run()
    {
        try {
            //recuperation dans GET du parametre controller
            $controllerName = filter_input(INPUT_GET, 'controller');
            if (is_null($controllerName)) {
                if (is_null($this->defaultControllerName)) {
                    throw new Error('Application : aucun controleur renseigné');
                } else {
                    $controllerName = $this->defaultControllerName;
                }
            }

            //generation du nom de la classe
            $controllerClass = $this->getControllerClass($controllerName);

            //contruction de l'objet
            $controller = new $controllerClass();

            //recuperation de l'action à excécuter
            $actionName = filter_input(INPUT_GET, 'action');
            if (is_null($actionName)) {
                $actionName = $controller->getDefaultActionName();
                //die('Application : aucune action renseignée');

            }
            //Exécution de l'action demandée
            $controller->execute($actionName);


            //rendu de la page
            Page::getInstance()->render();
        } catch (Error $exp) {
            $exp->render();
        } catch (\Exception $exp) {
            $this->logger->addError($exp->getMessage());
            if ($this->runMode == self::DEBUG_MODE) {
                throw $exp;
            } else {
                self::redirect('?controller=error');
            }
        }
        // $controllerName ="materiels";
        //echo $this->getControllerClass($controllerName);
    }

    //function de redirection
    public function redirect($url)
    {
        if (!headers_sent()) {
            header("HTTP/1.1 303 see Other");
            header("Location: " . $url);
            die();
        } else {
            ?>
            <script>
                Window.Location = '<?php echo $url; ?>';
            </script>
            <?php
        }
    }
}