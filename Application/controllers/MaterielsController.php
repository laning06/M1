<?php

namespace app\controllers;

use app\models\MaterielsModels;

class MaterielsController extends \f3il\Controller
{


    public function getDefaultActionName()
    {
        return 'lister';
    }

    public function ListerAction()
    {
        $page = \f3il\Page::getInstance();
        $page->init('simple', 'test');
        $page->materiels = MaterielsModels::getAll();
    }

    public function ajouterAction()
    {
        //reglage de base
        $page = \f3il\Page::getInstance();
        $page->init('simple', 'Materiels-form');

        //preparation des données
        $page->descriptions = "";
        $page->ip = "";

        //si le formulaire n'est pas envoyé
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        //recuperation des données
        $page->descriptions = filter_input(INPUT_POST, 'descriptions');
        if (trim($page->descriptions === "")) {
            $page->formMessage = "Erreur: veuillez fournir une description";
            return;
        }

        $page->ip = filter_input(INPUT_POST, 'ip');
        if (!filter_var($page->ip, FILTER_VALIDATE_IP)) {
            $page->formMessage = "Erreur : veuillez fournir une adresse IP valide";
            return;
        }

        //enregistrement
        MaterielsModels::insert([
            'descriptions' => $page->descriptions,
            'ip' => $page->ip
        ]);

        \f3il\Messenger::setMessage("le Materiel a bien été crée.");

        \f3il\Application::redirect('?controller=materiels&action=lister');

        // die("Formulaire OK");
    }

    public function test()
    {
        echo __METHOD__;
    }
    // public function runModeAction(){
    //     $db= \f3il\Database::getInstance();
    //     $req= $db->prepare("SELECT * FROM materiels WHER id=:id");
    //     $req->bindValue(':id',7);
    //     try{
    //         $req->execute();
    //     }catch(PDOException $ex)
    //     {
    //         //die("runmode".\f3il\Application::getInstance()->getRunMode());
    //     throw new \app\errors\sqlError($ex->getMessage(), $req);
    //     // throw new InvalidArgumentException("Demo de l'erreur");
    //     }

    //}

}


?>