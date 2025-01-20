<?php

namespace App\Controller\Admin;

use App\Entity\Series;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;



class SeriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Series::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield TextField::new('duration');
        yield TextField::new('affiche');
        yield TextEditorField::new('description');
        yield TextField::new('lien');
        yield AssociationField::new('categorie')
                ->setQueryBuilder( 
                fn(ORMQueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Categorie::class)->findAll() 
                );
        yield IntegerField::new('nbEpisodes');

    }
}
