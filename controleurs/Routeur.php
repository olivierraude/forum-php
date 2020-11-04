<?php
    class Routeur
    {
        //méthode statique qui détermine quel contrôleur sera appelé
        public static function route()
        {
            //obtenir la chaine de la requete (ex: Films&action=liste)
            $queryString = $_SERVER["QUERY_STRING"];
            $posEperluette = strpos($queryString, "&");
            
            //si il y a quelque chose dans la query string, s'en servir pour déterminer le contrôleur
            if($queryString != "")
            {
                if($posEperluette === false)
                    $controleur = $queryString;
                else
                    $controleur = substr($queryString, 0, $posEperluette);
            }
            else
            {
                //mettre le contrôleur par défaut dans cette variable
                $controleur = "User";
            }
            
            $classe = "Controleur_" . $controleur;
            
            //si la classe existe, créer une instance de cette classe et en appeler la méthode traite
            if(class_exists($classe))
            {
                $objetControleur = new $classe;
                if($objetControleur instanceof BaseControleur)
                {
                    $objetControleur->traite($_REQUEST);
                }
                else
                    trigger_error("Contrôleur invalide.");    
            }
            else
            {
                trigger_error("Contrôleur indéfini, la classe $classe n'existe pas.");
            }
        }
    }
?>