<?php

namespace App\Controller\Admin;

use App\Entity\WarhammerSceneries;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WarhammerSceneriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WarhammerSceneries::class;
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
