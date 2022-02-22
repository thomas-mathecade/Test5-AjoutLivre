<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav mr-auto justify-content-center">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=accueil&id=<?php echo $_SESSION["token"] ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=ajoutLivre&id=<?php echo $_SESSION["token"] ?>">Ajouter un livre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=allLivre&id=<?php echo $_SESSION["token"] ?>">Liste des livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=gestionLivre&id=<?php echo $_SESSION["token"] ?>">Gestion des livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=moncompte&id=<?php echo $_SESSION["token"] ?>">Mon Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="index.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
</div>