<header>
    <h1>Réservation Salle</h1>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="planning.php">Planning</a></li>
            <?php if (isset($_SESSION['is_logged'])): ?>
                <li><a href="booking.php">Liste des Réservations</a></li>
                <li><a href="booking-form.php">Réserver un Créneau</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="signout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="signup.php">Inscription</a></li>
                <li><a href="signin.php">Connexion</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>