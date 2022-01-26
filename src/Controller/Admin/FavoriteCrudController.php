<?php

namespace App\Controller\Admin;

use App\Entity\Favorite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FavoriteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Favorite::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('url'),
            TextEditorField::new('description')
        ];
    }
}
