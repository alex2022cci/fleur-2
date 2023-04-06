<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Product;
use App\Form\EasyAdmin\ImageFieldType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\Response;


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
            ->setDefaultSort(['id' => 'DESC'])
            ->addFormTheme('@FOSCKEditor/form/ckeditor_widget.html.twig')
            ->setPaginatorPageSize(10)
            ->setEntityPermission('ROLE_SUPER_ADMIN');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('CreatedAt', 'Date de création'))
            ->add(TextFilter::new('Title', 'Nom du produit'))
            ->add(EntityFilter::new('Category', 'Nom de la catégorie'));
    }
/*
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;
        // nous pourrions faire une condition pour vérifier que nous somme sur la page edit
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        // si le client ne met pas de date de publication, on met la date du jour
        if ($entityInstance->getPublishedAt() === null) {
            $entityInstance->setPublishedAt(new \DateTimeImmutable);
        }
        parent::persistEntity($em, $entityInstance);
    }
*/
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
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
            DateTimeField::new('CreatedAt')->onlyOnIndex(),
            DateTimeField::new('UpdatedAt')->onlyOnIndex(),
            DateTimeField::new('PublishedAt')
                ->setFormat('dd/MM/yyyy')
            ->onlyOnForms(),
            TextEditorField::new('Summary')
                ->hideOnIndex()
                ->setFormType(CKEditorType::class),
            TextEditorField::new('Content')
                ->hideOnIndex()
                ->setFormType(CKEditorType::class),
            TextField::new('MetaTitle')
                ->hideOnIndex(),
            SlugField::new('Slug')
                ->setTargetFieldName('Title')
                ->hideOnIndex(),
        ];
    }

    /**
     * Je vais faire une fonction pour duplioquer un produit
     */
    public const ACTION_DUPLICATE = 'duplicate';
    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateProduct')
            ->setCssClass('btn btn-info');

        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate)
            ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }

    public function duplicateProduct(AdminContext $context, AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em): Response
    {
        /** @var Product $product */
        $product = $context->getEntity()->getInstance();

        $duplicatedProduct = clone $product;

        parent::persistEntity($em, $duplicatedProduct);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedProduct->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
}
