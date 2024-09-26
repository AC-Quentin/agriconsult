<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_client', TextType::class, [
                'label' => 'id_client',
                'required' => false,
            ])
            ->add('raison_sociale', TextType::class, [
                'label' => 'raison_sociale',
                'required' => false,
            ])
            /*
            ->add('adresse', TextType::class, [
                'label' => 'adresse',
                'required' => false,
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'code_postal',
                'required' => false,
            ])
            ->add('ville', TextType::class, [
                'label' => 'ville',
                'required' => false,
            ])
            ->add('telephone', TextType::class, [
                'label' => 'telephone',
                'required' => false,
            ])
            ->add('mobile', TextType::class, [
                'label' => 'mobile',
                'required' => false,
            ])
            ->add('email', TextType::class, [
                'label' => 'email',
                'required' => false,
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
