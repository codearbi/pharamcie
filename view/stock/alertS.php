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
        <h2 class="titre">STOCK BESOIN VOTRE INTENTION</h2>
        <table class="table"> 
            <thead> 
                <th>cod a bar</th><th>nom</th><th>quantite restante</th> </thead>
            <tbody> 
        <?php 
        if (isset($info)){
            foreach($info as $i){
                echo '<tr><td>'.htmlspecialchars($i['cab']).'</td><td>'.htmlspecialchars($i['nom']).
                '</td><td> reste '.htmlspecialchars($i['quantite']).' piece(s)</td>';
            }
        } ?> 
            </tbody></table>
         <div class="chil">
    <a href="index.php?action=accueil" class="btn btn-primary m-3">accueil</a></div>
    </section>
  </main>
    <?php include_once 'footer.php'; ?>
</body>
</html>