<?php
    class Modele_Comments extends BaseDAO
    {
        public function getTableName()
        {
            return "Comments";
        }
        
        public function obtenir_tous(){
            $resultats = $this->lireTous();
            //lesComments sera un tableau d'instances de la classe Comment
            $lesComments = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Comment");
            return $lesComments;
        }

        public function obtenir_par_idPost($idP){
            $resultats = $this->lire($idP,"idPost");
            //lesComments sera un tableau d'instances de la classe Comment
            $lesComments = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Comment");
            return $lesComments;
        }
        
        public function obtenir_par_id($id){
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Comment");
            //$leComment sera une instance de la classe Comment
            $leComment = $resultat->fetch();
            return $leComment;
        }
        
        public function sauvegarde(Comment $leComment)
        {
            //si le comment existe déjà, il aura un id différent de zéro
            if($leComment->getId() != 0)
            {
                $query ="UPDATE Comments SET content = ? WHERE idComment = ?";
                $donnees = array($leComment->getContent(), $leComment->getId());
                return $this->requete($query, $donnees);
            }
            else
            {
                //ajout d'un nouveau film
                
                $query = "INSERT INTO Comments(idPost, idAuteur, content, dateCreation) VALUES (?,?,?,?)";
                $donnees = array($leComment->getPostId(), $leComment->getAuteurId(), $leComment->getContent(), $leComment->getDate());
                return $this->requete($query, $donnees);
            }
        }
    }

?>