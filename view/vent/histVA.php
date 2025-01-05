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
    <?php require_once 'header.php' ;?>
  <main>
  <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
    <section class="container p-5">
        <h2 class="titre">HISTORIQUE VENTE D UNE ANNEE</h2>
        <form action="index.php?action=histVA" method="post" class="form form-controller">
            <input type="text" name="cab" placeholder="cab" required>
            <input type="submit" value="valider">
        </form>
        <?php 
        if (!empty($error)) { ?> <p class="alert alert-info"> <?php
            echo htmlspecialchars($error);
        } ?> </p> <?php
        if (!empty($Q_T)) {  //si med existe au vente annuelle
            ?>
        <div class="alert alert-success">
             <p class="alert alert-info"><?php echo htmlspecialchars($Q_T).' pieces '
             .htmlspecialchars($E_V['nom_m']).' vendu cette année à '.$D.' dinars'; 
             unset($h); ?></p>
        </div> <?php }; ?>
        <a href="index.php?action=histV" class="btn btn-primary">histrique d un mois</a>
        <a href="index.php?action=ventM" class="btn btn-primary">vente</a>
            <div class="chil">
                <a href="index.php?action=accueil" class="btn btn-primary">acceuil</a>            
            </div>
    </section>
  </main>
    <?php include_once 'footer.php'; ?>
</body>
</html>