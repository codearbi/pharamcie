<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>pharmacie</title>
</head>
<body>
    <main>
        <?php require_once 'header.php'; ?>
        <section>
           <?php echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
           <h3 class="titre">chiffre d affaire par periode</h3>
              <section class="container">
                <?php if(!empty($error)){?>
                     <h3 class="alert alert-danger"><?php echo htmlspecialchars($error); ?></h3><?php } 
                if(isset($msg)){?>
                     <h3 class="alert alert-success"><?php echo htmlspecialchars($msg);unset($msg);?></h3>
                  <?php } ?>
                <form action="index.php?action=venteP" method="POST" class="form form-control">
                     <label for="dateD">date debut : </label>
                     <input type="date" name="date" required>
                     <label for="dateF">date fin</label>
                     <input type="date" name="dateF" required>
                     <input type="submit" value="valider">
                </form>

        </section>
    </main>
</body>
</html>