<?php
    class Controleur_Posts extends BaseControleur
    {
        public function traite(array $params)
        {            
            //assigner une action par défaut
            $action = "afficheListePosts";
                        
            if(isset($params["action"]))
            {
                 $action = $params["action"]; 
            }
            //structure de controle qui détermine quelles actions poser en fonction du paramètre action
            switch($action)
            {
                case "afficheListePosts":
                    $this->afficheVue("Header");
                    $this->afficheListePosts();
                    $this->afficheVue("Footer");
                    break;

                case "affiche":
                    if(isset($params["erreurs"]))
                        $donnees["erreurs"] = $params["erreurs"];
                    if(isset($params["id"]))
                    {
                        $modeleUser = $this->getDAO("Users");
                        $modelePosts = $this->getDAO("Posts");
                        $donnees["posts"] = $modelePosts->obtenir_par_id($params["id"]);
                        $modeleComments = $this->getDAO("Comments");
                        $donnees["posts"]->setListeCommentaire($modeleComments->obtenir_par_idPost($params["id"]));
                        foreach($donnees["posts"]->getListeCommentaire() as $comment){
                            $donnees["auteur"][] = $modeleUser->obtenir_username_par_id($comment->getAuteurId());
                        }

                        $this->afficheVue("Header");
                        $this->afficheVue("ForumSingle", $donnees);
                        $this->afficheVue("Footer");
                    }
                    else
                        trigger_error("Il n'y a pas de commentaire.");
                    break;

                case "formAjoutPost":
                    //afficher le formulaire d'ajout d'un post'
                    $this->afficheVue("Header");
                    $this->afficheFormAjoutPost();
                    $this->afficheVue("Footer");
                    break;
                    
                case "inserePost":

                    if(isset($params["content"], $params["auteur"],$params["titre"]))
                    {
                        //valider le formulaire d'ajout 'un post
                        $messageErreur = $this->valideFormAjoutPost($params["titre"],$params["content"]);

                        //valider le formulaire d'ajout 'un commentaire
                        //$messageErreur = $this->valideFormAjoutComment($params["auteur"], $params["content"]);
                        
                        if($messageErreur == "")
                        {
                            //insérer le post dans la BD
                            $monPost = new Post(0, $params["titre"]);
                            $modelePosts = $this->getDAO("Posts");
                            $modelePosts->sauvegarde($monPost, $params["auteur"],$params["content"]);
                            
                            /*
                            $this->afficheVue("Header");
                            $this->afficheListePosts();
                            $this->afficheVue("Footer");
                            */
                        }
                        else
                        {
                            $this->afficheVue("Header");
                            $this->afficheFormAjoutPost($messageErreur);
                            $this->afficheVue("Footer");
                        }
                    }
                }         
            }
                             
        public function valideFormAjoutPost($titre, $content)
        {
            $erreurs = "";
            
            $titre = trim($titre);
            
            if($titre == "")
                $erreurs .= "Le titre ne peut être vide.<br>";
            
            if(strlen($titre) > 250)
                $erreurs .= "Le titre ne peut pas dépasser 250 caractères.<br>";
            
            if($content == "")
                $erreurs .= "La description ne peut être vide.";
            
            return $erreurs;
        }
        
        public function afficheFormAjoutPost($messageErreur = "")
        {
            $modelePosts = $this->getDAO("Posts");
            $donnees["Posts"] = $modelePosts->obtenir_tous(); 
            $donnees["erreurs"] = $messageErreur;
            $vue = "formCreationPost";
            $this->afficheVue($vue, $donnees);
        }
        
        // Afficher la liste des posts 
        public function afficheListePosts()
        {
            $modeleUser = $this->getDAO("Users");
            $modelePosts = $this->getDAO("Posts");
            $modeleComments = $this->getDAO("Comments");
            $donnees["posts"] = $modelePosts->obtenir_tous();
            foreach($donnees["posts"] as $p)
            {
                $p->setListeCommentaire($modeleComments->obtenir_par_idPost($p->getId()));
               
            }
            //mettre en ordre de date
            usort($donnees["posts"],array("Post","trierPostParDate"));
            //fait en 2 boucle pour faire le sort avant d'assigner les auteurs
            foreach($donnees["posts"] as $p)
            {
                $donnees["auteur"][] = $modeleUser->obtenir_username_par_id($p->getAuteur());
            }
 
            $vue = "ForumHome";
            $this->afficheVue($vue, $donnees);
        }

   }
?>