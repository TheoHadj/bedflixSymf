<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Films;
use Faker\Factory;


class FilmFixtures extends Fixture implements DependentFixtureInterface
{

    private $filmsNames=["dark_knight","endgame","inception","interstellar","matrix","parasite"];
    // private $categories;
    
    // function __construct(CategorieRepository $categorieRepository){
    //     $this->categories = $categorieRepository->findAll();
    // }

    public function load(ObjectManager $manager): void
    {


        $faker = Factory::create('fr_FR');

        foreach($this->filmsNames as $filmName ) {
            $film = new Films();
            $film->setName($this->prettierName($filmName));
            $film->setDuration($faker->numberBetween(80, 180)); 
            $film->setDescription($faker->text(200)); 
            $film->setAffiche($filmName . ".jpg");
            $film->setLien("/" . $filmName); 
            // $film->setCategorie($faker->randomElement($this->categories));
            $film->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_REFERENCE_TAG . rand(0, CategorieFixtures::class::NB_CATEGORIE-1), Categorie::class ));
            $manager->persist($film);

        }
        
        $manager->flush();
    }


    public function prettierName(string $name) : string {
        $tmp = str_replace('_', ' ', $name);
        $tmp = ucwords($tmp);
        return $tmp;
    }
    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class
        ];
    }

}