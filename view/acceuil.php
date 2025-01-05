
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
<?php require_once 'header.php'; 
echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
  <main>
    <section class="p-5">
        <div class="container col-6">
            <?php if($_SESSION['role']=='admin'){ ?>
                <a href="index.php?action=ajoutF" class="btn btn-primary">MENU FONCTIONNAIRE</a>
                <a href="index.php?action=ca" class="btn btn-primary">CHIFFRE DE JOUR</a>
                <?php } ?>
            <a href="index.php?action=ajoutM" class="btn btn-primary">MENU STOCK</a>
            <a href="index.php?action=ventM" class="btn btn-primary">MENU VENTE</a>
            <a href="index.php?action=out" class="btn btn-danger mt-5">deconnexion</a>
        </div>
    </section>
  </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>
