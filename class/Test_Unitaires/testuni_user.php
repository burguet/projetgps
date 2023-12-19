<?php
include '../user.php';

// Créer une instance de la classe PDO pour la connexion à la base de données
$pdo = new PDO('mysql:host=192.168.64.213; dbname=BASE_ProjetDMX', 'root', 'root');

// Créer une instance de la classe User 
$user = new User(null,"TEST","UNITAIRE",null);

// Test de la méthode Inscription
$resultInscription = $user->Inscription('new_user', 'new_password');
echo "Test d'Inscription : " . ($resultInscription === true ? "Réussi" : $resultInscription ."\n" );
?> <br> <?php

// Test de la méthode Autorisation
$resultAutorisation = $user->Autorisation('new_user', 'new_password');
echo "Test d'Autorisation : " . ($resultAutorisation === true ? "Réussi" : "Échoué") . "\n";
?> <br> <?php

// Test de la méthode ModifierUser
$resultModifierUser = $user->ModifierUser('new_user', 'modified_user', 'modified_password');
echo "Test de ModifierUser : " . ($resultModifierUser === true ? "Réussi" : $resultModifierUser) . "\n";
?> <br> <?php

// Test de la méthode SupprimerUser
$resultSupprimerUser = $user->SupprimerUser('modified_user');
echo "Test de SupprimerUser : " . ($resultSupprimerUser === true ? "Réussi" : $resultSupprimerUser) . "\n";
?> <br> <?php

// Test de la méthode Deconnexion
$resultDeconnexion = $user->Deconnexion();
echo "Test de Deconnexion : " . ($resultDeconnexion === true ? "Réussi" : "Échoué") . "\n";
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