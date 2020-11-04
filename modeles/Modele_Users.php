<?php
    class Modele_Users extends BaseDAO
    {
        public function getTableName()
        {
            return "Users";
        }
        
        public function Authentification($username, $password)
        {
            $resultat = $this->lire($username, "username");
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
            //$leUser sera une instance de la classe User
            $leUser = $resultat->fetch();
            if ($leUser == false){
                return false;
            }
            else{
                $donnees["password"] = $leUser->getPassword();
                if($leUser->estBanni() != 0){
                    $donneesUser["banni"] = true;
                    return $donneesUser;
                }
                else if(password_verify($password, $donnees["password"]))
                {
                    $donneesUser["id"]= $leUser->getId();
                    $donneesUser["admin"]= $leUser->estAdmin();
                    return $donneesUser;
                }

                else
                    return false;
                
            }
        }

        public function obtenir_tous(){
            $resultats = $this->lireTous();
            //lesUsers sera un tableau d'instances de la classe User
            $lesUsers = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
            return $lesUsers;
        }
        public function obtenir_par_id($id){
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
            //$leUser sera une instance de la classe User
            $leUser = $resultat->fetch();
            return $leUser;
        }
        
        public function obtenir_username_par_id($id){
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
            //$leUser sera une instance de la classe User
            $leUser = $resultat->fetch();
            return $leUser->getUsername();
        }
        
        public function sauvegarde(User $leUser)
        {
            //si le user existe déjà, il aura un id différent de zéro
            if($leUser->getId() != 0)
            {
                if($leUser->estAdmin() != 1)
                {
                    if($leUser->estBanni() == 1)
                    {

                        $query = "UPDATE Users SET isBanned = 0 WHERE idUser = ?";
                        $donnees = array( $leUser->getId());
                        return $this->requete($query, $donnees);
                    }
                    else
                    {
                        $query = "UPDATE Users SET isBanned = 1 WHERE idUser = ?";
                        $donnees = array($leUser->getId());
                        return $this->requete($query, $donnees);
                    }
                }
                
            }
            else
            {
                //ajout d'un nouveau Users
                $query = "INSERT INTO Users(username, password, isAdmin) VALUES(?,?,?)";
                $donnees = array($leUser->getUsername(), $leUser->getPassword(), $leUser->estAdmin());
                return $this->requete($query, $donnees);
            }
        }
    }

?>