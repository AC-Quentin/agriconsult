<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $email = EmailField::new('email');
        $username = TextField::new('username');
        $roles = ArrayField::new('roles');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$email, $username];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$email, $username, $roles];
        } else {
            return [$email];
        }

        /*
        return [
            EmailField::new('email'),
            TextField::new('username'),
        ];
        */
    }
}
