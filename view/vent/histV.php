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
        <section class="container p-5">
            <h2 class="titre">HISTORIQUE VENTE D UN MOIS</h2>
            <form action="index.php?action=histV" method="post">
                <input type="text" name="cab" placeholder="code a bar" required>
                <input type="submit" value="valider">
            </form>
            <?php if (isset($Q_T)&&!empty($Q_T)) { // si medic existe au vente mensuelle
                ?><h3 class="alert alert-success"> 
               <p class="alert alert-info"><?php echo htmlspecialchars($Q_T).' pieces '
               .htmlspecialchars($E_V['nom_m']).' vendu à '.htmlspecialchars($D).' dinars';
               
            } ?></p></h3> <?php if(!empty($error)){ ?> 
           <p class="alert alert-info"> <?php echo htmlspecialchars($error);} ?></p>
            <a href="index.php?action=histVA" class="btn btn-primary">histrique annuelle</a>
            <a href="index.php?action=ventM" class="btn btn-primary">vente</a>
            <div class="chil">
            <a href="index.php?action=accueil" class="btn btn-primary">acceuil</a>            
            </div>
        </section>
    </main>
    <?php include_once 'footer.php'; ?>
    
</body>
</html>