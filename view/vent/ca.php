<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmacie</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include_once 'header.php'; ?>
    <main class="back">
        <?php echo 'BIENVENU '.htmlspecialchars($_SESSION['nom']); ?>
        <section class="container">
            <h3 class="titre p-5">CHIFFRE D AFFAIRE PAR MATRICULE</h3>
            <?php
            if (isset($caD)) { ?>
                <h5 class="alert alert-success"><?php echo 'matricule : '.htmlspecialchars($this->modV->matricule)
                .'<br> TOTAL CHIFFRE DE '.htmlspecialchars(date('d-m-Y')).' : '.htmlspecialchars($caD).' dinars'; ?></h5>
                <?php unset($ca);}
            if (!empty($error)) { ?>
                <h5 class="alert alert-danger"> <?php echo htmlspecialchars($error);?></h5>
               <?php } unset ($error);?>
            <form action="index.php?action=ca" method="post" class="form form-control">
                <input type="number" name="matricule" placeholder="matricule" required>
                <input type="submit" value="valider">
             </form>
             <a href="index.php?action=ca_J" class="btn btn-primary">chiffre de jour</a>
             <a href="index.php?action=accueil" class="btn btn-primary my-5">acceuil</a>
        </section>
    </main>
    <?php include_once 'footer.php' ?>
</body>
</html>