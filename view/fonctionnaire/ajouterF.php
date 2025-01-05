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
<?php require_once 'header.php';?>
  <main>
    <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']); ?>
    <section class="container">
        <h2 class="titre">AJOUTER FONCTIONNAIRE</h2>
    <?php if (isset($error)) { echo htmlspecialchars($error);}
          if (isset($_SESSION['msg'])) {
             echo htmlspecialchars($_SESSION['msg']);
             unset ($_SESSION['msg']);
           }
           $csrf_token = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '';
           ?>
        <form action="index.php?action=ajoutF" method="POST" class="form form-control">
            <input type="text" name="nom" placeholder="nom prenom" required>
            <input type="password" name="pwd" placeholder="mot de passe" required>
            <input type="password" name="pwd1" placeholder="resaisir mot de passe" required>
            <select name="role" id="role">
                <option value="employe">employe</option>
                <option value="admin">administrateur</option>
            </select>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']);?>">
            <input type="submit" value="ajouter">
        </form>
        <div class="paren">
            <a href="index.php?action=bloqF" class="btn btn-info">bloquer fonctionnaire</a>
            <a href="index.php?action=supF" class="btn btn-danger">supprimer fonctionnaire</a>
            <a href="index.php?action=affiF" class="btn btn-primary">afficher fonctionnaires</a>
            <div class="chil">
            <a href="index.php?action=accueil" class="btn btn-success m-3">MENU PRINCIPALE</a>
            </div>
        </div>
    </section>
  </main>
    <?php require_once 'footer.php' ?>
</body>
</html>