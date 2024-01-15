<?php

// Class User

class User
{ 
    private $id;
    private $login;
    private $passwd;
    private $isAdmin;

    public function __construct($id, $login, $passwd, $isAdmin){
        $this->id = $id;
        $this->login = $login;
        $this->passwd = $passwd;
        $this->isAdmin = $isAdmin;
    }

    // -- Méthodes : accès aux propriétés --

    public function getId()
    { 
        return $this->id;
    }

    public function getLogin()
    { 
        return $this->login;
    }

    public function getPasswd()
    { 
        return $this->passwd;
    }

    public function getisAdmin()
    { 
        return $this->isAdmin;
    }


    // -- Méthodes : fonctions pour interagir avec l'user --
    

    // 1) Inscription d'un user
    public function Inscription($login, $passwd)
    {
        $sql = "SELECT * FROM User WHERE login = '" . $login . "'";
        $result = $GLOBALS["pdo"]->query($sql);

        if ($result && $result->rowCount() > 0) {
            return "Un utilisateur avec le même login existe déjà.";
        }

        $sql = "INSERT INTO User (login, passwd) VALUES ('$login', '$passwd')";

        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            return true; 
        } else {
            return "Erreur lors de l'inscription.";
        }
    }


    // 2) Autorisation pour que l'user accès au site + vérification s'il est Admin ou pas
    public function Autorisation($login, $passwd)
    {
        $sql = "SELECT * FROM User WHERE login = '" . $login . "'";
        $result = $GLOBALS["pdo"]->query($sql);

        if ($result && $result->rowCount() > 0) {
            // L'user existe, vérifie mdp
            $sql = "SELECT * FROM User WHERE login = '" . $login . "' AND passwd = '" . $passwd . "'";
            $result = $GLOBALS["pdo"]->query($sql);

            if ($result && $result->rowCount() > 0) {
                $userData = $result->fetch(PDO::FETCH_ASSOC);

                // Stocker le nom d'user dans la session
                $_SESSION['id_user'] = $userData['login'];

                // User = Admin ? 
                if ($userData['isAdmin'] == 1) {
                    $_SESSION['isAdmin'] = 1;
                } else {
                    $_SESSION['isAdmin'] = 0;
                }
                return true;
            }
        }
        return false; 
    }


    // 3) Modifier un user
    public function ModifierUser($login, $nouveauLogin, $nouveauPasswd)
    {
        $sql = "UPDATE User SET login = '$nouveauLogin', passwd = '$nouveauPasswd' WHERE login = '$login'";
        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            // echo '<script>setTimeout(function(){ window.location = "admin.php"; }, 2000);</script>'; // à mettre en commentaire pour test unitaire
            return true; 
        } else {
            return "Erreur lors de la modification de l'utilisateur.";
        }
    }


    // 4) Supprimer un user
    public function SupprimerUser($login)
    {
        $sql = "DELETE FROM User WHERE login = '$login'";
        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            // echo '<script>setTimeout(function(){ window.location = "admin.php"; }, 2000);</script>'; // à mettre en commentaire pour test unitaire
            session_unset();
            session_destroy();
            header('location: ../index.php');
            return true; 
        } else {
            return "Erreur lors de la suppression de l'utilisateur.";
        }
    }

    // 5) Supprimer un user via le panneau admin
    public function SupprimerUserAdmin($login)
    {
        $sql = "DELETE FROM User WHERE login = '$login'";
        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            // echo '<script>setTimeout(function(){ window.location = "admin.php"; }, 2000);</script>'; // à mettre en commentaire pour test unitaire
            return true; 
        } else {
            return "Erreur lors de la suppression de l'utilisateur.";
        }
    }

    // 6) Déconnecter l'user
    public function Deconnexion()
    {
        session_unset();
        session_destroy();
        return true; 

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
    }


    // 7) Afficher tous les users dans un tableau sur la page admin
    public function AfficherTableauUtilisateurs()
    {
        $sql = "SELECT login, passwd FROM User"; 
        $result = $GLOBALS["pdo"]->query($sql);

        // Tableau d'affichage
        if ($result && $result->rowCount() > 0) { ?>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
            <th>Login</th>
            <th>Password</th>
            <th></th> 
            <th></th> 
            </tr>
            </thead>
            <tfoot>
            <tr>
            </tr>
            </tfoot>
            <tbody>

            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                <td><?php echo $row['login'] ?></td>
                <td><?php echo $row['passwd'] ?></td>
                <td><button class="btn btn-primary" data-toggle="modal" data-target="#modifierModal" data-login=" <?php echo $row['login'] ?> ">Modifier</button></td>
                <td><button class="btn btn-danger" data-toggle="modal" data-target="#supprimerModal" data-login=" <?php echo $row['login'] ?> ">Supprimer</button></td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'Aucun utilisateur trouvé.';
        }
    }


    // 8) Afficher juste son user dans les paramètres
    public function AfficherSingleUser()
    {
        $login = $_SESSION['id_utilisateur']; // On récupère le login de l'user connecté

        $sql = "SELECT login, passwd FROM User WHERE login = '$login'"; 
        $result = $GLOBALS["pdo"]->query($sql);

        // Tableau d'affichage
        ?>
        <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
        <tr>
        <th>Login</th> 
        <th>Password</th>
        </tr>
        </thead>
        <tbody>

        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
            <td><?php echo $row['login'] ?></td>
            <td><?php echo $row['passwd'] ?></td>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#modifierModal" data-login=" <?php echo $row['login'] ?> ">Modifier</button></td>
            <td><button class="btn btn-danger" data-toggle="modal" data-target="#supprimerModal" data-login=" <?php echo $row['login'] ?> ">Supprimer</button></td>
            </tr>
            <?php
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
}