<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ajouter etudiant</title>
    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body>
    <div class="container text-center">
        <h1 class="text-primary">Ajouter etudiant</h1>
        <?php
        include 'etudiant.php';
        $etudiant = new etudiant();
        $etudiant->ajouter_etudiant();
        $etudiant->afficher_liste_etudiant();
        ?>
    </div>
</body>
</html>
