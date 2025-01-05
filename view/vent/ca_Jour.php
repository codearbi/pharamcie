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
    <?php include_once 'header.php' ?>
    <main>
        <?php echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
        <h1 class="titre m-3">CHIFFRE D AFFAIRE DE JOUR</h1>
        <section class="container">
            <?php if(!empty($error)){?>
                <h3 class="alert alert-danger"><?php echo htmlspecialchars($error); ?></h3><?php } 
            if(isset($msg)){?>
                <h3 class="alert alert-success"><?php echo htmlspecialchars($msg);unset($msg);?></h3>
           <?php } ?>
            <form action="index.php?action=ca_J" method="POST" class="form form-control">
                <label for="date">chiffre d affaire de jour : </label>
                <input type="date" name="date" required>
                <input type="submit" value="valider">
            </form>
        </section>
        <a href="index.php?action=accueil" class="btn btn-primary m-5">ACCEUIL</a>
      <?php include_once 'footer.php' ; ?>
    </main>
</body>
</html>