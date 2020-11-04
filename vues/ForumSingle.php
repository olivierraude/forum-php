<h3>Détails du post</h3>
        <h4>Titre : <strong><?= $data["posts"]->titre ?></strong></h4><br>
        Auteur : <?=$data["auteur"][0]?> <br>
        Date : <?=$data["posts"]->getFirstCommentDate()?><br>
        <br/>
        <table class="table text-secondary bg-light">
            <thead>
                <tr>
                <th scope="col">Auteur</th>
                <th scope="col">Commentaire</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $count = 0;
                foreach($data["posts"]->getListeCommentaire() as $comment){
                echo "<tr>";
                    echo "<th scope='row'>" . $data["auteur"][$count] . "</th>";
                    echo "<td>" . $comment->getContent() . "</td>";
                echo "</tr>";
                $count++;
                }
            ?>
            </tbody>
        </table>

        <h5>Ajout d'un commentaire</h5>
        
            <form action='index.php?Comments' method="POST">
            
                <input type="hidden" name="auteur" value="<?=$_SESSION["id"]?>" ><br/>
                <input type="hidden" name="idPost" value="<?=$data["posts"]->getId()?>" ><br/>
                Message : <textarea class="form-control" rows=5 name="content"></textarea><br/>
                
                <input type="hidden" name="action" value="insereComment"/>
                <input type="submit" value="Publier"/>
            </form>
            <?php
                if(isset($data["erreurs"]))
                    echo "<p>{$data["erreurs"]}</p>";
            ?>
    <a href='index.php?Posts&action=afficheListePosts'>Retourner à la liste des posts</a>  