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
  <main>
  <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
   <section>
    <h1 id="tit">AJOUTER MEDICAMENT</h1>
    <form action="index.php?action=ajoutM" method="post" class="form form-control">
        <input type="text" name="cab" placeholder="cod a bar" maxlength="8" required>
        <input type="text" name="nom" placeholder="libellé" maxlength="10" required>
        <input type="text" name="categ" placeholder="categorie" maxlength="10" required>
        <input type="text" name="quantite" placeholder="quantite" maxlength="3" required>
        <input type="test" name="prix" placeholder="prix unitaire" maxlength="4" required>
        <input type="submit" value="ajouter">
        <?php 
           if(!empty($msg)){?>
           <p class="alert alert-success"><?php echo htmlspecialchars($msg); ?></p>     
       <?php  unset($msg);}
          if(!empty( $error)){ ?>
          <p class="alert alert-danger">
        <?php echo htmlspecialchars($error);} unset($error);?> </p>
         
    </form>
    
    <a href="index.php?action=ajoutS" class="btn btn-success">AJOUTER STOCK</a>
    <a href="index.php?action=voirM" class="btn btn-primary">CONSULTER STOCK</a>
    <a href="index.php?action=alertS" class="btn btn-primary">verifier stock critique</a>
    <a href="index.php?action=TM" class="btn btn-success">VOIR TOUS MEDICAMENT</a>

    <div class="chil" >
    <a href="index.php?action=accueil" class="btn btn-primary m-3">accueil</a> </div>
    
   </section>
  </main>
   <?php include_once 'footer.php'; ?>    
</body>
</html>