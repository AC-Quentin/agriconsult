<?php

namespace App\Controller\Admin;

use App\Entity\DemandeCommerciale;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class DemandeCommercialeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandeCommerciale::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('date'),
            AssociationField::new('client'),
            AssociationField::new('stockage'),
            AssociationField::new('secheuse'),
            AssociationField::new('manutention'),
            AssociationField::new('nettoyeur'),
            AssociationField::new('sechoir'),
        ];
    }
}
