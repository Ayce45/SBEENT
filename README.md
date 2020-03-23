# Procédure d'installation :

1 - configuration du .env <br>
2 - composer install <br>
3 - php bin/console doctrine:database:create <br>
4 - php bin/console doctrine:migrations:migrate <br>
5 - php bin/console doctrine:fixtures:load <br>
6 - php -S localhost:8000 -t public <br>

# Présentation :

Le projet SBEENT est un agenda pour la L3 MIAGE.
Après la procédure d'installation, dans un navigateur web à l'adresse indiquée après la dernière commande, vous pouvez voir le front office qui est destiné aux étudiants.
Un agenda responsif pour ordinateur et mobile, simple, claire et précis.
Avec toutes les informations importantes au premier coup d'yeux.
Toutes les données sont générées avec des fixtures et donc chaque chargement de fixture est différent.

En ajoutant un `/admin` vous accéder a l'administration du site :
Cet accès est sécurisé avec un nom d'utilisateur et un mot de passe stocké en bcrypt (admin, admin)
L'espace d'administration a été généré automatiquement par easy admin sauf pour cours.
Il est possible d'ajouter, de modifier et de supprimer très facilement chaque donnée de l'application.
Pour les cours, cette partie a été réaliser à la main, il permet aussi d'ajouter de supprimer et de modifier des cours.
Les cours sont soumis à des contraintes, il est impossible de créer un cours si des ressources n'est pas disponible (prof, groupe, classe, salle)

Le projet utilise <a href="https://fullcalendar.io/">FullCalendar</a> pour l'affichage étudianats, cette librairie JavaScript est alimenté en ajax avec un service symfony.

# Capture d'écran

![image](https://user-images.githubusercontent.com/32338891/77081940-abe76d80-69fb-11ea-9a4e-e2883a2cb63e.png)
![image](https://user-images.githubusercontent.com/32338891/77081986-bf92d400-69fb-11ea-8f81-a49c162bfcff.png)
![image](https://user-images.githubusercontent.com/32338891/77082014-c9b4d280-69fb-11ea-874f-c60c3ef69d9e.png)
![image](https://user-images.githubusercontent.com/32338891/77082045-d6392b00-69fb-11ea-9dca-eeed1d818af4.png)
![image](https://user-images.githubusercontent.com/32338891/77082094-e51fdd80-69fb-11ea-8916-ef5cbfe65bbb.png)
![image](https://user-images.githubusercontent.com/32338891/77082122-f0730900-69fb-11ea-9058-35e529e1b5d7.png)
![image](https://user-images.githubusercontent.com/32338891/77082167-ff59bb80-69fb-11ea-892e-1eda5c5df56f.png)
![image](https://user-images.githubusercontent.com/32338891/77082323-329c4a80-69fc-11ea-963f-2c16b58343c9.png)

