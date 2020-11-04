<?php

    class Comment
    {
        public $idComment;
        public $idPost;
        public $idAuteur;
        public $content;
        public $dateCreation;
        
        public function __construct($id = 0, $idP = 0, $idA = 0, $c = "",$d = "")
        {
            $this->idComment = $id;
            $this->idPost = $idP;
            $this->idAuteur = $idA;
            $this->content = $c;
            $this->setDate($d);
        }
        
        public function getId()
        {
            return $this->idComment;
        }
        public function getPostId()
        {
            return $this->idPost;
        }
        
        public function getAuteurId()
        {
            return $this->idAuteur;
        }
        
        public function getContent()
        {
            return $this->content;
        }

        public function getDate()
        {
            return $this->dateCreation;
        }
        public function setDate($date = "")
        {
            $format = 'Y-m-d H:i:s';
            if($date == ""){
                $this->dateCreation = date($format);
            }
            else{
                //valide si le format de la date est correcte si ok on affecte sinon erreur
                $d = DateTime::createFromFormat($format, $date);
                if($d && $d->format($format) == $date){
                    $this->dateCreation = $date;
                }
                else
                {
                    trigger_error("la date doit respecter le format Y-m-d H:i:s qui est == YYYY-MM-DD HH:mm:SS", E_USER_ERROR);
                }

            }
        }


    }
?>