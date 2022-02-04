<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('type'),
            TextField::new('title'),
            TextEditorField::new('summary')
                ->setFormType(CKEditorType::class)
                ->hideOnIndex(),
            TextareaField::new('content')
                ->setFormType(CKEditorType::class)
                ->hideOnIndex(),
            TextField::new('slug')
                ->hideOnIndex(),
            AssociationField::new('tags')
                ->setFormTypeOptions(['by_reference' => false,])
                ->autocomplete(),
            DateTimeField::new('updated_at'),
            DateTimeField::new('created_at'),
        ];
    }
}
