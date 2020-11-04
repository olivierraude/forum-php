<h3>Liste des Membre</h3>
    <table class="table text-secondary bg-light">
      <thead>
        <tr>
          <!--<th scope="col">#</th> -->
          <th scope="col">Username</th>
          <th scope="col">estBanni</th>
          <th scope="col">Bannir/Debannir</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach($data["usagers"] as $u){
            echo "<tr>";
                //echo "<th scope='row'>" . $post->idPost . "</th>";
                echo "<td>" . $u->getUsername() ."</td>";
                echo "<td>" . $u->estBanni() . "</td>";
                echo "<td><a href='index.php?User&action=Bannir&id=". $u->getId() ."'>Bannir/Debannir</a> </td>";
            echo "</tr>";
        }
      ?>
      </tbody>
    </table>