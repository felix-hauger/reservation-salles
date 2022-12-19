<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'elements/header.php'; ?>



    <h2>Formulaire de réservation</h2>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Titre de l'évènement">
        <label for="duration">Durée en heures</label>
        <select name="duration">
            <?php for ($i = 8; $i <= 18; $i++): ?>
                <option value="<?= $i ?>"><?= $i . 'h' ?></option>
            <?php endfor ?>
        </select>
        <h2>OU</h2>
        <label for="start">Début de la réservation</label>
        <input type="datetime-local" name="start" id="start" step="3600" min="<?php ?>">
        <label for="start">Fin de la réservation</label>
        <input type="datetime-local" name="end" id="end" step="3600">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </form>






    <?php require_once 'elements/footer.php'; ?>
</body>
</html>
