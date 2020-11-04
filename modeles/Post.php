<?php

    class Post
    {
        public $idPost;
        public $titre;
        public $listeComments;
        
        public function __construct($id = 0, $t = "",array $liste = array()) 
        {
            $this->setId($id);
            $this->setTitre($t);
            $this->setListeCommentaire($liste);
        }
        
        public function getId()
        {
            return $this->idPost;
        }
        public function getTitre()
        {
            return $this->titre;
        }
        
        public function getListeCommentaire()
        {
            return $this->listeComments;
        }
        public function setListeCommentaire(array $liste)
        {
            for($i = 0; $i < count($liste); $i++)
            {
                if(!($liste[$i] instanceof Comment))
                    trigger_error("Chaque Comment doit être une instance de la classe Comment.", E_USER_ERROR);
            }

            $this->listeComments = $liste;
           
        }
        
        public function setId($id){
            if(is_numeric($id)){
                $this->idPost = $id;
            }
            else
            trigger_error("le Id doit etre numerique.", E_USER_ERROR);
        }

        public function setTitre($t){
            $this->titre = $t;
        }

        public function getFirstCommentDate(){
        
            $premierCommentaire = $this->getListeCommentaire()[0];
            return $premierCommentaire->getDate();
        }

        public function getLastCommentDate(){
            $i = $this->getCommentCount()-1;
            $dernierCommentaire = $this->getListeCommentaire()[$i];
            return $dernierCommentaire->getDate();
        }

        public function getAuteur(){
            $commentaireAutheur = $this->getListeCommentaire()[0];
            return $commentaireAutheur->getAuteurId();
        }

        public function getCommentCount(){
            return count($this->getListeCommentaire()); 
        }

        static function trierPostParDate($post1, $post2)
        {
            if($post1->getLastCommentDate() === $post2->getLastCommentDate())
            {
                return 0;
            }
            return ($post1->getLastCommentDate() < $post2->getLastCommentDate()) ? 1 : -1; 
        }
    }
?>