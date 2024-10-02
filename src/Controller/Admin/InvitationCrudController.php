<?php

namespace App\Controller\Admin;

use App\Entity\Invitation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class InvitationCrudController extends AbstractCrudController
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getEntityFqcn(): string
    {
        return Invitation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            AssociationField::new('role')
                ->setCrudController(RolesCrudController::class),
            TextField::new('uuid')
                ->hideWhenCreating(),
            AssociationField::new('member')
                ->hideWhenCreating(),
        ];
    }

    // Utilisation de `mixed` pour respecter à la fois PHP et l'analyseur statique
    public function persistEntity(EntityManagerInterface $entityManager, mixed $entityInstance): void
    {
        if (!$entityInstance instanceof Invitation) {
            throw new \InvalidArgumentException('Expected instance of Invitation');
        }

        // Persister l'entité
        parent::persistEntity($entityManager, $entityInstance);

        // Envoyer un email
        $email = (new Email())
            ->from('q.latour@agriconsult.fr')
            ->to($entityInstance->getEmail())
            ->subject('Finalisez la création de votre compte Agriconsult')
            ->html('Vous avez reçu une nouvelle invitation ! <br> Finaliser la création du compte : '.
                   '<a href="https://GGSPC003:8000/invitation/'.$entityInstance->getUuid().'">Cliquez ici</a>');

        $this->mailer->send($email);
    }
}
