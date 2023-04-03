<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Product;
use App\Form\ImageFieldType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            CollectionField::new('Pictures')
                ->setEntryIsComplex(true)
                ->setEntryType(ImageFieldType::class)
                ->setTemplatePath('EasyAdmin/pictures.html.twig'),
            TextField::new('Title'),
            MoneyField::new('Price')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),
            IntegerField::new('Quantity'),
            TextField::new('SKU'),
            AssociationField::new('Category'),
            DateField::new('CreatedAt')
                ->setFormat('dd/MM/yyyy'),
            DateField::new('PublishedAt')
                ->setFormat('dd/MM/yyyy'),
        ];
    }

}
