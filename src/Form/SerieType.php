<?php

namespace App\Form;

use App\Entity\Series;
use Proxies\__CG__\App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la série',
            ])
            ->add('duration', TextType::class, [
                'label' => 'Durée moyenne par épisode (ex: 45m)',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('affiche', TextType::class, [
                'label' => 'Affiche (chemin ou URL)',
            ])
            ->add('lien', TextType::class, [
                'label' => 'Lien (chemin ou URL)',
            ])
            ->add('nb_episodes', IntegerType::class, [
                'label' => 'Nombre d’épisodes',
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Choisissez une catégorie',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter la série',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Series::class,
        ]);
    }
}
