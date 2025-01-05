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
    <?php require_once'header.php'; ?>
  <main>
  <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
  <h1 class=titre>ESPACE VENTE</h1>
    <section class="container">
    <h5 class="tit">VOIR PRIX </h5>
    <form action="index.php?action=ventM" method="post" class="form form-control">
        <input type="number" name="cab" placeholder="code a bar" required>
        <input type="text" name="nom" placeholder="nom medicament" required>
        <input type="number" name="qte" placeholder="quantite"required>
        <input type="submit" name="prevu" value="voir prix">
    </form>  
    <?php if (isset($error)) { ?>
          <p class="alert alert-danger"><?php  echo htmlspecialchars($error); ?> </p>
         <?php  } 
          if(isset($prevu)){ ?>
        <div class="preview_detail">
            <p><strong>medicament : </strong><?php echo htmlspecialchars($prevu['nom']); ?></p>
            <p><strong>quantite : </strong><?php echo htmlspecialchars($prevu['qte']); ?></p>
            <p><strong>prix : </strong><?php echo htmlspecialchars($prevu['prix_T']).' dinars'; ?></p>
        </div>
        <form action="index.php?action=ventM" method="post" class="mb-5" >
            <input type="hidden" name="cab" value="<?php echo htmlspecialchars($prevu['cab']); ?>">
            <input type="hidden" name="nom" value="<?php echo htmlspecialchars($prevu['nom']);?>">
            <input type="hidden" name="qte" value="<?php echo htmlspecialchars($prevu['qte']);?>">
            <input type="submit" name="confirmer" value="confirmer">
        </form>
        <?php unset($prevu); } 
        
        if(isset($_SESSION['vente'])){ ?>
          <p class="alert alert-success"><?php   echo htmlspecialchars($_SESSION['vente']); ?></p>
          <?php unset($_SESSION['vente']);
      } ?>
       <a href="index.php?action=PV" class="btn btn-primary">plus vendu</a>
       <a href="index.php?action=histV" class="btn btn-primary">historique vente</a>
       <a href="index.php?action=histVA" class="btn btn-primary">historique vente annuelle</a>
       <a href="index.php?action=venteP" class="btn btn-primary">vente par periode</a>
       <div class="chil">
            <a href="index.php?action=accueil" class="btn btn-primary">menu principal</a>
       </div>
    </section >
  </main> 
    <?php require_once 'footer.php'; ?>
</body>
</html> 