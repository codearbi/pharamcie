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
  <section class="container">
    <h2 class="titre">visionage stock</h2>
    <form action="index.php?action=voirN" method="post" class="form-control">
        <input type="text" name="nom" placeholder="rechercher par nom">
        <input type="submit" value="rechercher">
    </form>
    <?php if (isset($error)) { echo htmlspecialchars($error);}
    if (!empty($M)) { ?>
        <table class="table">
          <thead><th>code a bar</th><th>nom medicament</th><th>categorie</th><th>stock</th><th>prix</th></thead>
          <tbody><tr><td><?php echo htmlspecialchars($M['cab']); ?></td><td> <?php 
          echo htmlspecialchars($M['nom']); ?></td><td><?php 
          echo htmlspecialchars($M['categorie']); ?></td><td><?php echo htmlspecialchars($M['quantite']);
           ?></td><td><?php echo htmlspecialchars($M['prix']);?></td></tr></tbody>
        </table>
         <?php } ?>
         <br>
    <a href="index.php?action=voirC" class="btn btn-primary">recherche par categrie</a>
    <a href="index.php?action=voirM" class="btn btn-primary">recherche par cab</a>
    <div class="chil">
    <a href="index.php?action=ajoutM" class="btn btn-success m-3">MENU STOCK</a></div>
  </section>   
  </main> 
</body>
</html>