<?php
    class Modele_Posts extends BaseDAO
    {
        public function getTableName()
        {
            return "Posts";
        }
        
        public function obtenir_tous(){
            $resultats = $this->lireTous();
            //lesPosts sera un tableau d'instances de la classe Post
            $lesPosts = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Post");
            return $lesPosts;
        }
        public function obtenir_par_id($id){
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Post");
            //$lePost sera une instance de la classe Post
            $lePost = $resultat->fetch();
            return $lePost;
        }
        
        public function sauvegarde(Post $lePost, $auteur, $content)
        {
            //si le post existe déjà, il aura un id différent de zéro
            if($lePost->getId() != 0)
            {
                //TO DO mise à jour
            }
            else
            {
                //ajout d'un nouveau Post
                $query = "INSERT INTO Posts(titre) VALUES (?)";
                $donnees = array($lePost->getTitre());

                
                $resultat = $this->requete($query, $donnees);
                if($resultat){
                    $lastId = $this->db->lastInsertId();

                    $controleurComment = new Controleur_Comments();
                    $controleurComment->traite(array("action"=> "insereComment", "idPost"=>$lastId,"auteur"=>$auteur,"content"=>$content ));
                }
                
            }
        }
    }

?>