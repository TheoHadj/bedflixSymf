<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Series;
use Faker\Factory;



class SerieFixtures extends Fixture implements DependentFixtureInterface
{
    // private $categories;
    private $serieNames=["breaking_bad","chernobyl","game_of_thrones","mandalorian","stranger_things","witcher"];
    // function __construct(CategorieRepository $categorieRepository){
    //     $this->categories = $categorieRepository->findAll();
    // }
    
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        foreach($this->serieNames as $serieName ) {
            $serie = new Series();
            $serie->setName($this->prettierName($serieName));
            $serie->setDuration($faker->numberBetween(40, 80)); 
            $serie->setDescription($faker->text(200)); 
            $serie->setAffiche($serieName . ".jpg");
            $serie->setLien("/" . $serieName); 
            $serie->setNbEpisodes($faker->numberBetween(8,52));
            // $serie->setCategorie($faker->randomElement($this->categories));
            $serie->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_REFERENCE_TAG . rand(0, CategorieFixtures::class::NB_CATEGORIE-1), Categorie::class ));

            $manager->persist($serie);

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
