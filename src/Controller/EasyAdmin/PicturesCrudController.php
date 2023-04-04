<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Pictures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PicturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pictures::class;
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
