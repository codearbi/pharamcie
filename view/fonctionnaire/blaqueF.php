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
    <h2 class="titre">blocage fonctionnaire</h2>
    <div class="centre">
    <form action="index.php?action=bloqF" method="POST" class="form form-control">
    <input type="text" name="matricule" placeholder="matricule" required>
    <input type="submit" value="bloquer">
    </form>

    <?php 
    if (isset($_SESSION['msg'])) { ?>
        <p class="alert alert-success"><?php echo htmlspecialchars($_SESSION['msg']);?></p>
        <?php   unset($_SESSION['msg']);
     }
    if(isset($error)){ ?>
      <p class="alert alert-danger"><?php  echo htmlspecialchars($error); ?></p>
     <?php }
    require_once 'footer.php' ; ?>
    <div class="chil"><p><a href="index.php?action=accueil" class="btn btn-success m-3">RETOUR MENU</a></p>
    </div>
    </div>
    </section>
  </main>
  <?php require_once 'footer.php' ?>
</body>
</html>