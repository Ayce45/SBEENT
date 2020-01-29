<?php

namespace App\DataFixtures;

use App\Entity\Annee;
use App\Entity\Classe;
use App\Entity\Enseignant;
use App\Entity\Filiere;
use App\Entity\Matiere;
use App\Entity\MatiereSemestre;
use App\Entity\Salle;
use App\Entity\Semestre;
use App\Entity\Type;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);

        /**
         * Utilisateur
         */
        $utilisateur = new Utilisateur();
        $utilisateur->setNom("admin")->setMdp('$2y$10$W/GDEE4nRsX6s9eV/dS71e2LIDe5kaTbxwiD8FlpZCZwe5K1m6GJ6');
        $manager->persist($utilisateur);

        /**
         * Annee
         */
        $year = date("Y");
        $i = $year -1;
        while ($i < $year +1) {
            $annee = new Annee();
            $annee->setCode($i);
            $manager->persist($annee);
            $i++;

            /**
             * Semestre
             */
            $semestre = new Semestre();
            if ($i == $year) {
                $code = 5;
            } else {
                $code = 6;
            }
            $semestre->setIdAnnee($annee)->setCode($code);
            $manager->persist($semestre);

        }

        /**
         * Filiere
         */
        $filiere = new Filiere();
        $filiere->setLibelle("L3 MIAGE");
        $manager->persist($filiere);

        /**
         * Classe
         */
        $classe = new Classe();
        $classe->setCode(1)->setIdFiliere($filiere);
        $manager->persist($classe);

        /**
         * Enseignant
         */
        for ($i = 0; $i < 10; $i++) {
            $enseignant = new Enseignant();
            $enseignant->setNom($faker->lastName)->setPrenom($faker->firstName);
            $manager->persist($enseignant);
        }
        $types = ['CM',
            'TD',
            'TP',
            'CT',
            'CC'];

        /**
         * Type
         */
        for ($i = 0; $i < 5; $i++) {
            $type = new Type();
            $type->setLibelle($types[$i]);
            $manager->persist($type);
        }

        /**
         * Matiere
         */
        $matieres = ['Réseaux',
            'Projet Personnel et Professionnel',
            'Anglais',
            'Framework web',
            'Programmation n-tiers',
            'Techniques de communication',
            'Projet',
            'Gestion comptable',
            'Statistiques',
            'Systèmes d’information'];

        for ($i = 0; $i < 10; $i++) {
            $matiere = new Matiere();
            $matiere->setLibelle($matieres[$i]);
            $manager->persist($matiere);

            /**
             * MatiereSemestre
             */
            $matiereSemestre = new MatiereSemestre();
            $matiereSemestre->setIdFiliere($filiere)->setHeure($faker->numberBetween(10,30));

        }

        /**
         * Salle
         */
        for ($i = 0; $i < 20; $i++) {
            $salle = new Salle();
            $salle->setCode("E" . $i)->setCapacite("30")->setPc($i % 2);
            $manager->persist($salle);
        }
        $salle = new Salle();
        $salle->setCode("H")->setCapacite(150)->setPc(false);
        $manager->persist($salle);

        $manager->flush();
    }
}
