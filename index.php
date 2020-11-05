<?php

    require_once 'f3il/f3il.php';
    require_once 'f3il/Database.php';
    //require_once "vendor/autoload.php";
    f3il\Configuration::setConfigurationFile('Application/Configuration.ini');

    define('APP_FOLDER', 'Application');
    define('TEMPLATE_FOLDER', APP_FOLDER.'/Templates');
    define('VIEW_FOLDER', APP_FOLDER.'/Views');
    define('APP_NAMESPACE','app');

    //require_once "f3il/Database.php";

   // Configuration:: setConfigurationFile('Application/Configuration.ini');
    
    //$conf = Configuration :: getInstance();
   // $db = Database :: getInstance();
    //print_r($db);
    ///echo  $conf->db_host;




    $app = \f3il\Application::getInstance();
    $app->setDefaultControllerName('Materiels');
    $app->run();




    //$controller = new app\controllers\MaterielsController();
    //$controller->execute('');




    //ajoutons l'insertion
//  app\models\MaterielsModels::insert(array(
//         "descriptions"=>"test insert",
//         "ip" => "O.O.O.O"
//     ));
//     echo '<pre>';
//     print_r (app\models\MaterielsModels::getAll()); 

//le read du crud
$db = f3il\Database::getInstance();
$page = \f3il\Page::getInstance();
$page->setTemplate('simple')
     ->setView('test');
$page->materiels = \app\models\MaterielsModels::getAll();
$page->render();
    
?>
