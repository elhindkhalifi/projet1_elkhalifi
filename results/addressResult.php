<a href="../">Accueil</a>
<?php
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
require_once("../functions/addressCrud.php");
require_once ('../functions/functions.php');
session_start();



// Todo : valider les données de mon form 
// si les données ne sont pas bonne : renvoyer vers le form d'enregistrement (redirect auto )
// attention on veut récupérer les données rentrées précédement : $_SESSION

// Validation des adresses
$streetIsValid = streetIsValid($_POST["street"]);
$zipCodeIsValid = zipCodeIsValid($_POST["zipcode"]);

if (!$streetIsValid["isValid"] || !$zipCodeIsValid["isValid"]){
    $allAddressesValid = false;
   
};

// Afficher toutes les adresses quand elles sont toutes valides
if ($allAddressesValid) {
    $newAddressData = [
        "street" => $_POST["street"],
        "street_nb" => $_POST["street_nb"],
        "type" => $_POST["type"],
        "city" => $_POST["city"],
        "zipcode" => $_POST["zipcode"],
    ];

    // Ajouter l'adresse dans la base de données
    createAddress($newAddressData);

    // Afficher le message de succès
    echo "<p class='success-message'>L'adresse  a été ajoutée avec succès.</p>";
}

?>

<?php if ($streetIsValid["isValid"] && $zipCodeIsValid["isValid"] && $addressIsValid["isValid"]) : ?>
<div class="buttons">
    <!-- Revenir a un formulaire pour modifier avec des champs préremplis -->
    <a href='../forms/form3.php'>
        <input type='button' id='modifier' name='modifier' value='Modifier'>
    </a>

    <!-- Ajouter les adresses a la base de données -->
    <a href='resultValidation.php'>
        <input type='button' id='valider' name='valider' value='Valider'>
    </a>
</div>
<?php endif; ?>
</div>

</body>
</html>

