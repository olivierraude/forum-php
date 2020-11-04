<h3>Affichage de tous les posts</h3>
    <table class="table text-secondary bg-light">
      <thead>
        <tr>
          <!--<th scope="col">#</th> -->
          <th scope="col">Titre</th>
          <th scope="col">Auteur</th>
          <th scope="col">Date Dernier commentaire</th>
          <th scope="col">Nombre Commentaire</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $count = 0;
        foreach($data["posts"] as $post){
            echo "<tr>";
                //echo "<th scope='row'>" . $post->idPost . "</th>";
                echo "<td><a href='index.php?Posts&action=affiche&id=" . $post->getID() . "'>" . $post->getTitre() . "</a></td>";
                echo "<td>" . $data["auteur"][$count] . "</td>";
                echo "<td>" . $post->getLastCommentDate() . "</td>";
                echo "<td>" . $post->getCommentCount() . "</td>";
            echo "</tr>";
            $count++;
        }
      ?>
      </tbody>
    </table>
    <a href='index.php?Posts&action=formAjoutPost'>Ajouter un post</a><br>