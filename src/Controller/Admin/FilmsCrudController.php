<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use App\Entity\Categorie;


class FilmsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Films::class;
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
    }
    
}
