<?php
    class Controleur_Comments extends BaseControleur
    {
        public function traite(array $params)
        {            
            //assigner une action par défaut
            $action = "afficheListe";
                        
            if(isset($params["action"]))
            {
                 $action = $params["action"]; 
            }
            //structure de controle qui détermine quelles actions poser en fonction du paramètre action
            switch($action)
            {
                case "afficheListe":
                    $this->afficheVue("Header");
                    $this->afficheListeComments();
                    $this->afficheFormAjoutComment();
                    $this->afficheVue("Footer");
                    break;

                case "formAjoutComment":
                    //afficher le formulaire d'ajout d'un commentaire
                    $this->afficheVue("Header");
                    $this->afficheFormAjoutComment();
                    $this->afficheVue("Footer");
                    break;
                    
                case "insereComment":
                $messageErreur = "";
                
                if(isset($params["idPost"], $params["auteur"], $params["content"]))
                {
                    //valider le formulaire
                    $messageErreur = $this->valideFormAjoutComment($params["content"]);
                    
                    if($messageErreur == "")
                    {
                        //insérer le commmentaire dans la BD
                        $monComment = new Comment(0, $params["idPost"], $params["auteur"], $params["content"]);
                        $modeleComments = $this->getDAO("Comments");
                        $succes = $modeleComments->sauvegarde($monComment);
                        //afficher la liste des commentaires avec le nouveau commentaire dedans
                        
                        $controleurPosts = new Controleur_Posts();
                        $controleurPosts->traite(array("action"=>"affiche", "id"=>$params["idPost"]));
                    }
                    else
                    {
                        $controleurPosts = new Controleur_Posts();
                        $controleurPosts->traite(array("action"=>"affiche", "id"=>$params["idPost"], "erreurs"=>$messageErreur));
                    }
                }
                else
                {
                    //les paramètres sont invalides
                    $controleurPosts = new Controleur_Posts();
                    $controleurPosts->traite(array("action"=>"affiche", "id"=>$params["idPost"], "erreurs"=>$messageErreur));
                }
                break;

                default:
                        trigger_error("Action invalide.");
                }         
            }
              
          
        public function valideFormAjoutComment($content)
        {
            $messageErreur = "";

            $content = trim($content);
            
            if($content == "")
                $messageErreur .= "Le commentaire ne peut être vide.";
            
            return $messageErreur;
        }
        
    }
?>