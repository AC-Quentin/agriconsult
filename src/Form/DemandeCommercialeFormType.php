<?php

namespace App\Form;

use App\Entity\DemandeCommerciale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCommercialeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $collection_delais = [
            'urgent' => 'Urgent',
            '5jrs' => '5jrs',
            '10jrs' => '10jrs',
            '15jrs' => '15jrs',
        ];

        $collection_etat_demande = [
            'Nouveau projet' => 'Nouveau projet',
            'Révision de projet' => 'Révision de projet',
        ];

        $collection_generale = [
            'Agricole' => 'Agricole',
            'Industrielle' => 'Industrielle',
        ];

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
            ])
            ->add('delais', ChoiceType::class, [
                'choices' => $collection_delais,
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ])
            ->add('etat_demande', ChoiceType::class, [
                'choices' => $collection_etat_demande,
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ])
            ->add('generale', ChoiceType::class, [
                'choices' => $collection_generale,
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ])
            ->add('infos', TextareaType::class, [
                'label' => 'Infos',
                'required' => false,
                'mapped' => false,
            ])
            ->add('file', FileType::class, [
                'label' => 'Fichier',
                'mapped' => false,
                'multiple' => true,
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
