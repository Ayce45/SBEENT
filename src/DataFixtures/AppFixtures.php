<?php

namespace App\DataFixtures;

use App\Entity\Annee;
use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Entity\Filiere;
use App\Entity\Groupe;
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
        $array_enseignants = [];
        for ($i = 0; $i < 10; $i++) {
            $enseignant = new Enseignant();
            $enseignant->setNom($faker->lastName)->setPrenom($faker->firstName);
            array_push($array_enseignants, $enseignant);
            $manager->persist($enseignant);
        }

        $types = ['CM',
            'TD',
            'TP',
            'CT',
            'CC'];

        $array_types = [];

        /**
         * Type
         */
        for ($i = 0; $i < 5; $i++) {
            $type = new Type();
            $type->setLibelle($types[$i]);
            array_push($array_types, $type);
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

        $array_matiere = [];
        for ($i = 0; $i < 10; $i++) {
            $matiere = new Matiere();
            $matiere->setLibelle($matieres[$i]);
            array_push($array_matiere, $matiere);
            $manager->persist($matiere);
            /**
             * MatiereSemestre
             */
            $matiereSemestre = new MatiereSemestre();
            $matiereSemestre->setIdFiliere($filiere)
                ->setHeure($faker->numberBetween(10,20))
                ->setIdMatiere($matiere)
                ->setIdSemestre($semestre)
                ->setIdType($array_types[0]);
            $manager->persist($matiereSemestre);

            if ($i % 2) {
                $matiereSemestre = new MatiereSemestre();
                $matiereSemestre->setIdFiliere($filiere)
                    ->setHeure($faker->numberBetween(10,30))
                    ->setIdMatiere($matiere)
                    ->setIdSemestre($semestre)
                    ->setIdType($array_types[1]);
                $manager->persist($matiereSemestre);
            } else if ($i % 5 == 0) {
                $matiereSemestre = new MatiereSemestre();
                $matiereSemestre->setIdFiliere($filiere)
                    ->setHeure($faker->numberBetween(10,30))
                    ->setIdMatiere($matiere)
                    ->setIdSemestre($semestre)
                    ->setIdType($array_types[1]);
                $manager->persist($matiereSemestre);

                $matiereSemestre = new MatiereSemestre();
                $matiereSemestre->setIdFiliere($filiere)
                    ->setHeure($faker->numberBetween(10,30))
                    ->setIdMatiere($matiere)
                    ->setIdSemestre($semestre)
                    ->setIdType($array_types[2]);
                $manager->persist($matiereSemestre);
            } else {
                $matiereSemestre = new MatiereSemestre();
                $matiereSemestre->setIdFiliere($filiere)
                    ->setHeure($faker->numberBetween(10,30))
                    ->setIdMatiere($matiere)
                    ->setIdSemestre($semestre)
                    ->setIdType($array_types[2]);
                $manager->persist($matiereSemestre);
            }

            $matiereSemestre = new MatiereSemestre();
            $matiereSemestre->setIdFiliere($filiere)
                ->setHeure($faker->numberBetween(2,4))
                ->setIdMatiere($matiere)
                ->setIdSemestre($semestre)
                ->setIdType($array_types[4]);
            $manager->persist($matiereSemestre);
        }

        $array_salles = [];
        /**
         * Salle
         */
        for ($i = 0; $i < 20; $i++) {
            $salle = new Salle();
            $salle->setCode("E" . $i)->setCapacite("30")->setPc($i % 4 == 0);
            array_push($array_salles, $salle);
            $manager->persist($salle);
        }
        $salle = new Salle();
        $salle->setCode("H")->setCapacite(150)->setPc(false);
        array_push($array_salles, $salle);
        $manager->persist($salle);

        /**
         * Groupe
         */
        $array_groupe = [];
        $groupe = new Groupe();
        $groupe->setCode('1')->setCapacite('15')->setIdClasse($classe);
        array_push($array_groupe, $groupe);
        $manager->persist($groupe);

        $groupe = new Groupe();
        $groupe->setCode('2')->setCapacite('15')->setIdClasse($classe);
        array_push($array_groupe, $groupe);
        $manager->persist($groupe);

        $groupe = new Groupe();
        $groupe->setCode('1, 2')->setCapacite('30')->setIdClasse($classe);
        array_push($array_groupe, $groupe);
        $manager->persist($groupe);

        /**
         * Cours
         */

        $weeks = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $times = [[8,10], [10,12], [13,15], [15,17], [17,19]];

        foreach($weeks as $key => $week) {
            foreach ($times as $key => $time) {
                if ($faker->numberBetween(0,100) > 25) {
                    if ($faker->numberBetween(0, 2) == 0) {
                        $groupe = $array_groupe[2];
                        $cours = new Cours();
                        $debut = new \DateTime();
                        $fin = new \DateTime();
                        date_timestamp_set($debut, strtotime("$week this week $time[0] hours"));
                        date_timestamp_set($fin, strtotime("$week this week $time[1] hours"));
                        $cours->setDebut($debut)
                            ->setFin($fin)
                            ->setIdType($array_types[0])
                            ->setIdMatiere($array_matiere[$faker->numberBetween(0, 9)])
                            ->setIdEnseignant($array_enseignants[$faker->numberBetween(0, 9)])
                            ->setIdGroupe($groupe)
                            ->setIdSalle($array_salles[$faker->numberBetween(0, 20)]);
                        $manager->persist($cours);
                    } else {
                        $type = $array_types[$faker->numberBetween(1, 2)];
                        $matiere = $array_matiere[$faker->numberBetween(0, 9)];
                        $groupe = $array_groupe[0];
                        $cours = new Cours();
                        $debut = new \DateTime();
                        $fin = new \DateTime();
                        date_timestamp_set($debut, strtotime("$week this week $time[0] hours"));
                        date_timestamp_set($fin, strtotime("$week this week $time[1] hours"));
                        $cours->setDebut($debut)
                            ->setFin($fin)
                            ->setIdType($type)
                            ->setIdMatiere($matiere)
                            ->setIdEnseignant($array_enseignants[$faker->numberBetween(0, 9)])
                            ->setIdGroupe($groupe)
                            ->setIdSalle($array_salles[$faker->numberBetween(0, 20)]);
                        $manager->persist($cours);

                        $groupe = $array_groupe[1];
                        $cours = new Cours();
                        $debut = new \DateTime();
                        $fin = new \DateTime();
                        date_timestamp_set($debut, strtotime("$week this week $time[0] hours"));
                        date_timestamp_set($fin, strtotime("$week this week $time[1] hours"));
                        $cours->setDebut($debut)
                            ->setFin($fin)
                            ->setIdType($type)
                            ->setIdMatiere($matiere)
                            ->setIdEnseignant($array_enseignants[$faker->numberBetween(0, 9)])
                            ->setIdGroupe($groupe)
                            ->setIdSalle($array_salles[$faker->numberBetween(0, 20)]);
                        $manager->persist($cours);
                    }
                }
            }
        }

        $manager->flush();
    }
}
