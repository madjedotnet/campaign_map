<?php

namespace App\Controller\Admin;

use App\Entity\Buildings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BuildingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Buildings::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
