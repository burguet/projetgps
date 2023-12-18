<?php

// Inclure la classe User
include '../user.php';

// Créer une instance de la classe PDO pour la connexion à la base de données
$pdo = new PDO('mysql:host=your_host;dbname=your_database', 'your_username', 'your_password');

// Créer une instance de la classe User en passant la connexion PDO
$user = new User(null,"TEST","UNITAIRE",null);

// Test de la méthode Connexion
$resultConnexion = $user->Connexion('your_username', 'your_password', 'your_database');
echo "Test de Connexion : " . ($resultConnexion === true ? "Réussi" : $resultConnexion) . "\n";

// Test de la méthode Inscription
$resultInscription = $user->Inscription('new_user', 'new_password');
echo "Test d'Inscription : " . ($resultInscription === true ? "Réussi" : $resultInscription) . "\n";

// Test de la méthode Autorisation
$resultAutorisation = $user->Autorisation('new_user', 'new_password');
echo "Test d'Autorisation : " . ($resultAutorisation === true ? "Réussi" : "Échoué") . "\n";

// Test de la méthode ModifierUser
$resultModifierUser = $user->ModifierUser('new_user', 'modified_user', 'modified_password');
echo "Test de ModifierUser : " . ($resultModifierUser === true ? "Réussi" : $resultModifierUser) . "\n";

// Test de la méthode SupprimerUser
$resultSupprimerUser = $user->SupprimerUser('modified_user');
echo "Test de SupprimerUser : " . ($resultSupprimerUser === true ? "Réussi" : $resultSupprimerUser) . "\n";

// Test de la méthode Deconnexion
$resultDeconnexion = $user->Deconnexion();
echo "Test de Deconnexion : " . ($resultDeconnexion === true ? "Réussi" : "Échoué") . "\n";

// Test de la méthode AfficherTableauUtilisateurs
echo "Test d'AfficherTableauUtilisateurs : \n";
$user->AfficherTableauUtilisateurs();

// Test de la méthode AfficherSingleUser
echo "Test d'AfficherSingleUser : \n";
$user->AfficherSingleUser();

?>
