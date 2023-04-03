<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Product;
use App\Form\ImageFieldType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Liste des Produits')
            ->setEntityLabelInSingular('Product')
            ->setDefaultSort(['id' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('CreatedAt', 'Date de création'))
            ->add(TextFilter::new('Title', 'Nom du produit'))
            ->add(EntityFilter::new('Category', 'Nom de la catégorie'));
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
