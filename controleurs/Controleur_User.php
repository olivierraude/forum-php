<?php

    class Controleur_User extends BaseControleur
    {
        public function traite(array $params)
        {            
            //assigner une action par défaut
            $action = "Login";
                        
            if(isset($params["action"]))
            {
                 $action = $params["action"]; 
            }
            //structure de controle qui détermine quelles actions poser en fonction du paramètre action
            switch($action)
            {
                case "Login":
                    //aller à la page d'accueil
                    $this->afficheVue("Header");
                    $this->afficheVue("Login");
                    $this->afficheVue("Footer");
                    break;
            
                case "Verifier":
                    //vérifier la combinaison username/password
                    if(isset($params["username"]) && isset($params["password"]))
                    {
                        $modeleUser = $this->getDAO("Users");
                        $donnees = $modeleUser->Authentification($params["username"], $params["password"]);
                        if($donnees == false)
                        {
                            $donnees["erreurs"] = "Combinaison username/password invalide.";

                            $this->afficheVue("Header");
                            $this->afficheVue("Login", $donnees);
                            $this->afficheVue("Footer");
                        }
                        else
                        {
                            if(isset($params["banni"])){
                                $donnees["erreurs"] = "Vous avez été banni.";
                            }
                            else{
                                $_SESSION["usager"] = $params["username"];
                                $_SESSION["id"] = $donnees["id"];
                                $_SESSION["admin"] = $donnees["admin"];
                            
                                $controleurPosts = new Controleur_Posts();
                                $controleurPosts->traite(array());
                            }
                                            
                        }
                    }
                    else
                    {
                        header("Location: index.php");
                    }
                    break;

                case "Logout" :
                    //supprimer la session en vidant le tableau $_SESSION
                    $_SESSION = array();
                    //supprimer le cookie de session
                    if(isset($_COOKIE[session_name()])){
                        setcookie(session_name(), '', time() - 3600);                
                    }
                    //détruire la session
                    session_destroy();
                    header("Location: index.php");
                    break;
                case "Bannir":
                if(isset($params["id"]) && $_SESSION["admin"] == 1)
                {
                    $modeleUser = $this->getDAO("Users");
                    $leUser = $modeleUser->obtenir_par_id($params["id"]);
                    $resultat = $modeleUser->sauvegarde($leUser);
                    
                    $donnees["usagers"] = $modeleUser->obtenir_tous();
                    $this->afficheVue("Header");
                    $this->afficheVue("ListeMembre",$donnees);
                    $this->afficheVue("Footer");
                   
                }
                else{
                    $this->afficheVue("Header");
                    $this->afficheVue("Login");
                    $this->afficheVue("Footer");
                }
                break;
                case "liste":
                if($_SESSION["admin"] == 1)
                {

                    $modeleUser = $this->getDAO("Users");
                    $donnees["usagers"] = $modeleUser->obtenir_tous();
                    $this->afficheVue("Header");
                    $this->afficheVue("ListeMembre",$donnees);
                    $this->afficheVue("Footer");
                   
                }
                else{
                    $this->afficheVue("Header");
                    $this->afficheVue("Login");
                    $this->afficheVue("Footer");
                }
                break;
                
            }
        }
   }
?>