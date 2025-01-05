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
    <?php include_once 'header.php' ;?>
  <main>
  <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
    <section class="container mt-5">
        <h3 class="titre">SUPPRESSION FONCTIONNAIRE</h3>
        <?php if (isset($_SESSION['message'])) {
        echo htmlspecialchars($_SESSION['message']); 
        unset($_SESSION['message']);
        }
         if(isset($error)){echo '<br>'.htmlspecialchars($error) ;} 
         $csrf_token = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '';
         ?>
        <form action="index.php?action=supF" method="POST" class="form form-control">
            <input type="text" name="matricule" placeholder="matricule" required>
            <input type="submit" value="supprimer">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>"> 
        </form>
    </section>
    <div class="chil">
    <a href="index.php?action=accueil" class="btn btn-success m-3">ACCEUIL</a></div>
  </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>