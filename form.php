<style>
    form {
        /* Uniquement centrer le formulaire sur la page */
        margin: 0 auto;
        width: 400px;
        /* Encadré pour voir les limites du formulaire */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
    }

    form div+div {
        margin-top: 1em;
    }

    label {
        /* Pour être sûrs que toutes les étiquettes ont même taille et sont correctement alignées */
        display: inline-block;
        width: 90px;
        text-align: right;
    }

    input,
    textarea {
        /* Pour s'assurer que tous les champs texte ont la même police.
     Par défaut, les textarea ont une police monospace */
        font: 1em sans-serif;

        /* Pour que tous les champs texte aient la même dimension */
        width: 300px;
        box-sizing: border-box;

        /* Pour harmoniser le look & feel des bordures des champs texte */
        border: 1px solid #999;
    }

    input:focus,
    textarea:focus {
        /* Pour souligner légèrement les éléments actifs */
        border-color: #000;
    }

    textarea {
        /* Pour aligner les champs texte multi‑ligne avec leur étiquette */
        vertical-align: top;

        /* Pour donner assez de place pour écrire du texte */
        height: 5em;
    }

    .button {
        /* Pour placer le bouton à la même position que les champs texte */
        padding-left: 90px;
        /* même taille que les étiquettes */
    }

    button {
        /* Cette marge supplémentaire représente grosso modo le même espace que celui
     entre les étiquettes et les champs texte */
        margin-left: .5em;
    }
</style>

<!-- Test pour la validation en php  -->

<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $contact = array_map('trim', $_POST);

    // first name 

    if (empty($contact['firstname'])) {
        $errors[] = 'Le prenom est obligatoire';
    }

    $firstnameMaxLength = 70;
    if (strlen($contact['firstname']) > $firstnameMaxLength) {
        $errors[] = 'Le prenom doit faire moins de ' . $firstnameMaxLength . ' caractères';
    }

    // Last name

    if (empty($contact['lastname'])) {
        $errors[] = 'Le nom est obligatoire';
    }

    $lastnameMaxLength = 70;
    if (strlen($contact['lastname']) > $lastnameMaxLength) {
        $errors[] = 'Le nom doit faire moins de ' . $lastnameMaxLength . ' caractères';
    }

    // Contact phoneNumber

    if (empty($contact['phoneNumber'])) {
        $errors[] = 'Le numéro de téléphone est obligatoire';
    }

    // Contact email
    
    if (empty($contact['email'])) {
        $errors[] = 'Le mail est obligatoire';
    }

    $emailMaxLength = 255;
    if (strlen($contact['email']) > $emailMaxLength) {
        $errors[] = 'Le mail doit faire moins de ' . $emailMaxLength . ' caractères';
    }  

    if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Mauvais format pour l\'email ' . htmlentities($contact['email']);
    }
    
    // Message

    if (empty($contact['message'])) {
        $errors[] = 'Le message est obligatoire';
    }

if (empty($errors)) {
    header('Location: /thank.php');
}

};

?>


<!-- début du HTML  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les formulaires PHP</title>
</head>

<body>

    <form action="thank.php" method="post">
        <!-- message d'erreur  -->
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" placeholder="Slawn" required value="<?= $contact['lastname'] ?? '' ?>">
        </div>
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" placeholder="Mark" required value="<?= $contact['firstname'] ?? '' ?>">
        </div>
        <div>
            <label for="email">Courriel :</label>
            <input type="email" id="email" name="email" placeholder="Mark.Slauwn@gmail.com" required>
        </div>
        <div>
            <label for="phoneNumber">Téléphone :</label>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="0622357861" required>
        </div>
        <div>
            <label for="message">Message :</label>
            <textarea id="message" name="message" cols="30" rows="10" required><?= $contact['message'] ?? '' ?></textarea>
        </div>
        <!-- Listes (Bouton ) -->
        <div>
            <select name="choix">
                <option value="1">choix 1</option>
                <option value="2">choix 2</option>
                <option value="3">choix 3</option>
            </select>
        </div>
        <div class="button">
            <button type="submit">Envoyer votre message</button>
        </div>
    </form>
</body>

</html>