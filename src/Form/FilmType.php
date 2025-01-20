<?php

namespace App\Form;

use App\Entity\Films;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $categories = $this->entityManager->getRepository(Categorie::class)->findAll();

        // pas fan de ça
        $categorieChoices = [];
        foreach ($categories as $categorie) {
            $categorieChoices[$categorie->getName()] = $categorie->getId();
        }

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du film',
            ])
            ->add('duration', TextType::class, [
                'label' => 'Durée',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('affiche', TextType::class, [
                'label' => 'Affiche (chemin)',
            ])
            ->add('lien', TextType::class, [
                'label' => 'Lien (URL)',
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Choisissez une catégorie',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter le film',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Films::class,
        ]);
    }
}
