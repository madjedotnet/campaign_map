<?php

namespace App\Controller\Admin;

use App\Entity\MapsStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MapsStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MapsStatus::class;
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
