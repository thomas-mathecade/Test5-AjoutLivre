<?php
class validLivreController {

    public function __construct() {    
        session_start();
        error_reporting(0);

        require_once "controller/Controller.php";
        require_once "vue/vueAjoutLivre.php";
        require_once "metier/Livre.php";
        require_once "PDO/LivreDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";
        
        $titre = $_POST['nom']?? null;
        $edition = $_POST['edition']?? null;
        $information = $_POST['info']?? null;
        $auteur = $_POST['auteur']?? null;

        $operation = $_GET['operation']?? null;

		if($operation==null){
            $operation = $_POST['operation']?? null;
		}

        if(Controller::auth()){
            if ($operation=="insert") {
                try {
                    $accesBdd = new LivreDB($pdo);
                    $l = new Livre(99, $titre, $edition, $information, $auteur);
                    $accesBdd->ajout($l);
                }catch(Exception $e){
                    throw new Exception(Constantes::EXCEPTION_INSERT_DB_LIV);
                }
            }

            $v=new vueAjoutLivre();
            $v->affiche();

        } else {
            //erreur on renvoit à la page d'accueil
            header('Location: accueil.php?id='.$_SESSION["token"]);
        }
    }
}
