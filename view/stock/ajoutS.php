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
    <?php require_once 'header.php';  ?>
  <main>
  <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
    <section class="container">
        <h4 id="tit">AJOUTER STOCK</h4>
        <form action="index.php?action=ajoutS" method="post">
            <input type="text" name="cab" placeholder="cod a bar" maxlength="8" required>
            <input type="text" name="nom" placeholder="libellé" maxlength="10" required>
            <input type="text" name="categ" placeholder="categorie" maxlength="10" required>
            <input type="text" name="quantite" placeholder="quantite" maxlength="3" required>
            <input type="submit" value="ajouter">
        </form>
        <?php if (isset($_SESSION['msg'])){ ?>
            <p class="alert alert-success">
            <?php echo htmlspecialchars($_SESSION['msg']); 
             unset($_SESSION['msg']);}
             if (isset($error)) {
                echo htmlspecialchars($error);
             }
             ?> </p>
        <br>
        <a href="index.php?action=ajoutM" class="btn btn-success">AJOUT MEDICAMENT</a>
        <a href="index.php?action=voirM" class="btn btn-primary">CONSULTER STOCK</a>
        <a href="index.php?action=alertS" class="btn btn-primary">verifier stock critique</a>
        <a href="index.php?action=TM" class="btn btn-success">VOIR TOUS MEDICAMENT</a>
        <div class="chil">
        <A href="index.php?action=accueil" class="btn btn-primary m-3">accueil</A> </div>
    </section>
  </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>