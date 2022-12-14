# Site de réservation de salle

## Fonctionnalités : 

### Un système de connexion avec utilisateurs, avec modification de profil

### Une page permettant de voir le planning de la salle (planning.php) 

Sur cette page on voit le planning de la semaine avec l’ensemble des réservations
effectuées. Le planning se présente sous la forme d’un tableau avec les jours de la
semaine en cours.

Dans ce tableau, il y a en colonne les jours et les horaires en ligne.
Sur chaque réservation, il est écrit le nom de la personne ayant réservé la salle ainsi que
le titre. Exemple :

### Une page permettant de voir une réservation (reservation.php?id=)
Cette page affiche le nom du créateur, le titre de l’événement, la description, l’heure de
début et de fin.
Pour savoir quel évènement afficher, l’id de l’événement est récupéré en
utilisant la méthode get. (ex : http://localhost/reservationsalles/reservation.php?id=1)
Seuls les utilisateurs connectés peuvent accéder aux événements.

### Un formulaire de réservation de salle (reservation-form.php)

Ce formulaire permet de créer une réservation. Contient les informations suivantes :
titre, description, date de début, date de fin.