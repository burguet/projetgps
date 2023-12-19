<?php
include '../user.php';

// Fichier de tests unitaires pour la classe User


$pdo = new PDO('mysql:host=192.168.64.213; dbname=BASE_ProjetDMX', 'root', 'root');

$user = new User(null,"TEST","UNITAIRE",null);

$resultInscription = $user->Inscription('new_user', 'new_password');
echo "Test d'Inscription : " . ($resultInscription === true ? "Réussi" : $resultInscription);
?> <br> <?php

$resultAutorisation = $user->Autorisation('new_user', 'new_password');
echo "Test d'Autorisation : " . ($resultAutorisation === true ? "Réussi" : "Échoué") . "\n";
?> <br> <?php

$resultModifierUser = $user->ModifierUser('new_user', 'modified_user', 'modified_password');
echo "Test de ModifierUser : " . ($resultModifierUser === true ? "Réussi" : $resultModifierUser);
?> <br> <?php

$resultSupprimerUser = $user->SupprimerUser('modified_user');
echo "Test de SupprimerUser : " . ($resultSupprimerUser === true ? "Réussi" : $resultSupprimerUser);
?> <br> <?php

$resultDeconnexion = $user->Deconnexion();
echo "Test de Deconnexion : " . ($resultDeconnexion === true ? "Réussi" : "Échoué");
?> <br> <?php


// Test pour afficher les tableaux mais c'est plus pour l'esthétique.

/*
// Test de la méthode AfficherTableauUtilisateurs
echo "Test d'AfficherTableauUtilisateurs : \n";
$user->AfficherTableauUtilisateurs();
?> <br> <?php

// Test de la méthode AfficherSingleUser
echo "Test d'AfficherSingleUser : \n";
$user->AfficherSingleUser();
*/

?>