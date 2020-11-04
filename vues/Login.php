        
<h1>Veuillez vous authentifier</h1>
<form method="post">
    Nom d'usager : <input type="text" name="username"/><br>
    Mot de passe : <input type="password" name="password"/><br>
    <input type="hidden" name="action" value="Verifier"/><br>
    <input type="submit" value="Login"/>
</form>
<?php
    if($data["erreurs"] != "")
        echo "<p>" . $data["erreurs"] . "</p>";
?>
