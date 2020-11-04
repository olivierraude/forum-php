<h3>Ajout d'un post</h3>

<form action='index.php?Posts' method="post">
    Titre : <input class="form-control" type="text" name="titre"><br/>
    <input class="form-control" type="hidden" name="auteur" value="<?php echo $_SESSION["id"]; ?>" >
    Message : <textarea class="form-control" rows=10 name="content"></textarea><br/>
    
    <input type="hidden" name="action" value="inserePost"/>
    <input type="submit" value="Publier"/>
</form>
<?php
    if(isset($data["erreurs"]))
        echo "<p>{$data["erreurs"]}</p>";
?>
<a href='index.php?Posts&action=afficheListePosts'>Afficher la liste des posts</a>
   