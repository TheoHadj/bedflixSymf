<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    
    private $categorieNames = ["Action","Animation","Aventure","Biographie","Comédie","Documentaire","Drame","Famille","Fantastique","Guerre","Historique","Horreur","Musical","Mystère","Policier","Romance","Science-Fiction","Sport","Thriller","Western"];      
    public const CATEGORIE_REFERENCE_TAG = 'CATEGORIE-';
    public const NB_CATEGORIE = 20;


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $i =0;
        foreach($this->categorieNames as $categorieName){
            $categorie = new Categorie();
            $categorie->setName($categorieName);
            $manager->persist($categorie);
            $this->addReference(self::CATEGORIE_REFERENCE_TAG . $i, $categorie);
            $i++;
        }
        
        


        $manager->flush();
    }
}
