Exécution en local :

    Ces étapes vous permettront de déployer le site web sur votre environnement local. Le site comprendra par défaut un compte administrateur avec tous les privilèges, trois comptes employés et dix comptes utilisateurs. À l'étape 6, vous avez la possibilité de personnaliser les mots de passe et les adresses email de ces comptes. Les comptes "Employé" et "Utilisateur" sont spécifiquement destinés aux tests de fonctionnalités du site et pour représenter divers scénarios d'utilisation. Ils peuvent être supprimés facilement via l'espace d'administration.

        1.Téléchargez les fichiers Documentation et GarageSource sur votre ordinateur.

        2.Lancez une SGBD locale (de type mysqli MariaDB 10.4.28).

        3.Accédez à Documentation/Base de données/DBinit.sql.

        4.Remplacez '!NOM!' par le nom que vous souhaitez donner à votre nouvelle base de données, puis exécutez cette requête dans la console du SGBD.

        5.Dirigez-vous vers GarageSourceCode/src/DataFixtures/UserFixtures.php.

        6.Modifiez les 3 occurrences de '!!!MDP!!!' avec les mots de passe de votre choix pour chaque type d'utilisateur ('Utilisateur', 'Employé', 'Administrateur'). Vous pouvez également personnaliser leurs adresses e-mail.

        7.Ouvrez GarageSourceCode/.env.

        8.Configurez votre DATABASE_URL, APP_SECRET et MAILER_DSN. (Pour MAILER_DSN vous pouvez utiliser le service de test 'Mailtrap').

        9.Dans votre terminal, accédez au dossier GarageSourceCode et exécutez :

            symfony console doctrine:migrations:migrate
            symfony console doctrine:fixtures:load
        
        Cela migrera vos tables et vos données vers votre nouvelle base de données.

        En cas de problème, vous pouvez consulter Documentation/Base de données/VersionSql pour trouver toutes les requêtes SQL nécessaires pour créer les tables manuellement. Dans ce cas, le mot de passe pour tous les comptes créés sera '321321'. Si vous souhaitez le changer, vous devrez également mettre à jour les valeurs hachées. Vous pouvez utiliser (https://phppasswordhash.com) pour hacher facilement votre mot de passe.

        10.Ensuite, toujours dans votre terminal, exécutez :

            symfony server:start

        Votre site est désormais prêt à être exploré en local. Rendez-vous sur l'adresse IP locale http://127.0.0.1:8000.

A noter :

    Le compte administrateur par défaut est :
    Email : admin@main.com
    Mot de passe : !!!MDP!!!

    Pour créer un compte utilisateur, une vérification d'e-mail est nécessaire. Utilisez Mailtrap comme service SMTP pour créer des comptes de test.

    Après vous être authentifié en tant qu'administrateur, explorez votre Espace personnel, où vous trouverez la plupart des fonctionnalités. Ici, vous pouvez ajouter de nouveaux comptes avec le statut 'Employé'. L'e-mail peut être fictif, car il ne sera pas vérifié, vu que cette fonctionnalité réservée à l'administrateur.

    Si vous êtes authentifié en tant qu'administrateur, dirigez-vous vers 'voir tous' en bas du slider contenant des avis. C'est ici que vous pouvez les supprimer.

    Si vous êtes authentifié en tant qu'administrateur, le bouton Supprimer apparaîtra en bas des prestations dans l'onglet 'Prestations'.

    Si vous êtes authentifié en tant qu'administrateur, vous pouvez consulter toutes les demandes de contact réalisées à partir des formulaires sur le site. Elles contiendront un champ "Sujet" avec le lien, indiquant si cette demande a été envoyée depuis une annonce spécifique. Cela permettra de suivre plus facilement l'origine de chaque demande et de répondre de manière plus ciblée. N'hésitez pas à explorer cette fonctionnalité dans l'interface d'administration pour une gestion plus efficace des interactions avec les utilisateurs.

    Si vous êtes authentifié en tant qu'administrateur ou employé, vous verrez les boutons Supprimer et Modifier directement sur l'annonce sélectionnée.

    Chaque utilisateur peut laisser un avis composé d'une note et d'un petit message. Dès qu'un avis est laissé, la note est prise en compte, modifiant ainsi la note moyenne et le nombre total d'avis. Cependant, les avis ne sont affichés sur la page d'accueil qu'après la modération de l'administrateur dans son espace privé. Si le compte utilisateur est supprimé, son avis est automatiquement suspendu. Tous les avis doivent passer par la modération, même ceux rédigés par un employé ou un administrateur.