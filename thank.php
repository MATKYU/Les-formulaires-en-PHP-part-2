

<!-- // message de succes :   -->

<?php

echo 'Merci' . ' ' .  $_POST['firstname'] . ' ' . $_POST['lastname'] . ' de nous avoir contacté à propos de ' .  '“' . $_POST['choix'] . '”.';

echo ' Un de nos conseiller vous contactera soit à l’adresse ' . ' ' .  $_POST['email'] . ' ou par téléphone au ' . ' ' .  $_POST['phoneNumber'] . ' dans les plus brefs délais pour traiter votre demande : ';

echo $_POST['message'];

?>