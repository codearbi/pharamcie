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
        <?php echo htmlspecialchars($_SESSION['nom']) ?>
        <h1 class="titre my-5">ARTICLES PLUS VENDU</h1>
        <section class="container">
            <table class="table">
                <thead>
                    <th>CAB MEDICAMENT</th><th>NOM MEDICAMENT</th><th>QUANTITE</th>
                </thead>
                <tbody> <?php foreach($plusvendu as $p){ ?>
                    <tr><td><?php echo htmlspecialchars($p['id_m']);?></td><td><?php 
                    echo htmlspecialchars($p['nom_m']);?></td><td>
                    <?php echo htmlspecialchars($p['total_vente']); ?></td></tr> <?php  } ?>
                </tbody>
            </table>
        </section>
        <a href="index.php?action=ventM" class="btn btn-primary m-5">MENU VENTE</a>
     </main>
    <?php include_once 'footer.php'; ?>
</body>
</html>