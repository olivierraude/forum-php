<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <div class = "container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <a class="navbar-brand" href="<?php if(isset($_SESSION["usager"]))
                        {
                            echo "index.php?Posts&action=afficheListePosts";
                        }
                        else
                        echo"#";
                        ?>">Le Forum</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    <?php
                    if(isset($_SESSION["usager"]))
                        {
                            echo "<a class='nav-item nav-link' href='index.php?User&action=Logout'>Logout</a>";
                        }
                        if(isset($_SESSION["admin"])&&$_SESSION["admin"]==1)
                        {
                            echo "<a class='nav-item nav-link' href='index.php?User&action=liste'>ListeDesUsagers</a>";
                        }
                        ?>
                    <!--
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    -->
                    </div>
                </div>
            </nav>