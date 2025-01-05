
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmacie</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="jscript/script.js" defer></script>
</head>
<body>
<?php require_once 'header.php'; ?>
<main>
<section class="container p-5">   
<?php if (isset($error)) {echo htmlspecialchars($error);} 
    $csrf_token = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : ''; ?>
    <form action="index.php?action=login" method="post" class="form-control">
        <input type="text" name="matricule" id="matricule" placeholder="matricule" oninput="valide()" required>
        <input type="password" name="pwd" id="pwd" placeholder="mot de passe" oninput="valide()" required>
        <select name="role" id="role">
            <option value="admin">administrateur</option>
            <option value="employe">employe</option>
        </select>
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
        <input type="submit" value="connecter">
    </form>
    <p id="msg"></p>
    <p id="msg1"></p>
</section>
</main>
<?php require_once 'footer.php'; ?>

  
</body>
</html>