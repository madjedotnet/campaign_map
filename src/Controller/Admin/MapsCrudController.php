<?php

namespace App\Controller\Admin;

use App\Entity\Maps;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MapsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maps::class;
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
