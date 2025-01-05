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
    <?php include_once 'header.php ' ; ?>
  <main>
    <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
    <section class="container">
        <h4 id="tit">CONSULTATION PAR CATEGORIE</h4>
        <form action="index.php?action=voirC" method="post" class="form form-control">
            <input type="search" name="recherche" placeholder="categorie de medicament" required>
            <input type="submit" value="consulter">
        </form>
        <?php if (isset($error)) {
            echo htmlspecialchars($error);
        } ?>
           <table class="table">
           <?php  if(isset ($C)){ ?>
           <thead><th>code a bar</th><th>nom medicament</th><th>categorie</th><th>stock</th><th>prix</th></thead>
           <tbody>
         <?php foreach ($C as $CA) { ?>
            <tr><td><?php echo htmlspecialchars($CA['cab']); ?></td><td> <?php echo htmlspecialchars($CA['nom']);
            ?></td><td><?php echo htmlspecialchars($CA['categorie']); ?></td><td><?php 
            echo htmlspecialchars($CA['quantite']); ?></td><td><?php 
            echo htmlspecialchars($CA['prix']);?></tr> <?php } }?>
        </tbody>  </table>
        <a href="index.php?action=voirM" class="btn btn-primary">consulter par medicament</a>
        <div class="chil">
        <a href="index.php?action=ajoutM" class="btn btn-success m-3">MENU STOCK</a></div>
    </section>    
  </main>
  <?php include_once 'footer.php'; ?>
</body>
</html>