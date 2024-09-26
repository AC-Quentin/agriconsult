<?php

namespace App\Form;

use App\Entity\DemandeCommerciale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCommercialeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
            ])
            ->add('TYPE_DEMANDE', TextType::class, [
                'label' => 'Type DC',
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'commentaire',
                'required' => false,
            ]);

        // Ajouter dynamiquement un sous-formulaire en fonction du type de demande
        if ('secheuse' === $options['type_demande']) {
            $builder
                ->add('secheuse', SecheuseFormType::class, [
                    'label' => false,
                    'required' => false,
                ])
                ->add('client', ClientFormType::class, [
                    'label' => false,
                    'required' => false,
                ]);
        } elseif ('stockage' === $options['type_demande']) {
            $builder
                ->add('client', ClientFormType::class, [
                    'label' => false,
                    'required' => false,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeCommerciale::class,
            'type_demande' => null,
        ]);
    }
}
