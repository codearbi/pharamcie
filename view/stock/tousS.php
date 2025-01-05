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
    <?php include_once 'header.php'; 
    if($_GET['action']=='TM'){ //tri par quantite
        ?> 
    <main>
    <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
        <section class="container">
            <h1 class="titre">TOUS LES MEDICAMENTS</h1>
            <h5>affichage par qantite</h5>
            <?php if(isset($T) && !empty($T)){ ?> 
                <table class="table"> 
                    <head><th>code a bar</th><th>nom</th><th>categorie</th><th>quantite</th><th>prix</th></head>
                    <tbody> <?php
                foreach($T as $tm){
                    echo '<tr><td>'.htmlspecialchars($tm['cab']).'</td><td>'.htmlspecialchars($tm['nom'])
                    .'</td><td>'.htmlspecialchars($tm['categorie']).'</td><td>'.
                    htmlspecialchars($tm['quantite']).'</td><td>'.htmlspecialchars($tm['prix']).'</td></tr>';
                }
            } ?>
                    </tbody>
                </table>
            <a href="index.php?action=TMN" class="btn btn-primary">tri  par nom</a>     
        </section>
        <a href="index.php?action=ajoutM" class="btn btn-primary">menu stock</a>
    </main>
    <?php }else //tri par nom
    { ?> 
        <main>
        <?php  echo 'bienvenu '.htmlspecialchars($_SESSION['nom']);?>
        <section class="container">
            <h1 class="titre">TOUS LES MEDICAMENTS</h1>
            <h5>affichage par nom</h5>
            <?php if(isset($T) && !empty($T)){ ?>
                <table class="table"> 
                    <head><th>code a bar</th><th>nom</th><th>categorie</th><th>quantite</th>
                    <th>prix</th></head>
                    <tbody> <?php
                foreach($T as $tm){
                    echo '<tr><td>'.htmlspecialchars($tm['cab']).'</td><td>'.htmlspecialchars($tm['nom'])
                    .'</td><td>'.htmlspecialchars($tm['categorie']).'</td><td>'.
                    htmlspecialchars($tm['quantite']).'</td><td>'.htmlspecialchars($tm['prix']).'</td><td></tr>';
                }
            } ?>
                    </tbody>
                </table>
            <a href="index.php?action=TM" class="btn btn-primary">tri par quantite</a>     
        </section>
        <a href="index.php?action=ajoutM" class="btn btn-primary">menu stock</a>
    </main>
    <?php } include_once 'footer.php'; ?>
</body>
</html>