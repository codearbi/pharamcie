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
    <?php include_once('header.php'); ?>
  <main>
    <?php     echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
    <h1 id="tit">AFFICHAGE FONCTIONNAIRE</h1>
    <section class="container">
        <table class="table">
            <thead> <th>matricule</th><th>nom</th><th>fonction</th><th>status</th></thead>
                <tbody>
                    <?php foreach($f as $fo){ ?>
                        <tr><td><?php echo htmlspecialchars($fo['matricule']); ?></td><td><?php 
                        echo htmlspecialchars($fo['n_prenom']); ?></td><td>
                        <?php echo htmlspecialchars($fo['role']); ?></td><td> 
                        <?php if(empty($fo['password'])){ echo '<p class="alert alert-danger">';}
                        else{echo '<p class="alert alert-success">';}?><?php if(!empty($fo['password']))
                        {echo 'actif';}else{echo 'bloqué';} ?></p></td></tr>
                   <?php  } ?>
                </tbody>
        </table>
        <a href="index.php?action=ajoutF" class="btn btn-success">MENU FONCTIONNAIRE</a>
    </section>
  </main>
    <?php require_once('footer.php'); ?>
</body>
</html