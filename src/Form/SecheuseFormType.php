<?php

namespace App\Form;

use App\Entity\Secheuse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecheuseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $collection_type_secheuse = [
            '18' => '18',
            '21' => '21',
            '24' => '24',
            '27' => '27',
            '30' => '30',
            '33' => '33',
            '36' => '36',
            '42' => '42',
            '48' => '48',
        ];

        $collection_type_plancher = [
            'CEREALES' => 'CEREALES',
            'COLZA' => 'COLZA',
        ];

        $collection_type_reprise = [
            'VERTICALE' => 'VERTICALE',
            'INCLINE' => 'INCLINE',
            'HORIZONTALE' => 'HORIZONTALE',
        ];

        $collection_debit_reprise = [
            '60' => '60',
            '100' => '100',
        ];

        $collection_type_module = [
            '15CV' => '15',
            '20CV' => '20',
            '25CV' => '25',
            '30CV' => '30',
        ];

        $builder
            ->add('TYPE_SECHEUSE', ChoiceType::class, [
                'choices' => $collection_type_secheuse,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('TYPE_PLANCHER', ChoiceType::class, [
                'choices' => $collection_type_plancher,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('TYPE_REPRISE', ChoiceType::class, [
                'choices' => $collection_type_reprise,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('DEBIT_REPRISE', ChoiceType::class, [
                'choices' => $collection_debit_reprise,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('TYPE_MODULE', ChoiceType::class, [
                'choices' => $collection_type_module,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('GAZ', TextType::class, [
                'label' => 'Gaz',
                'required' => false,
            ])
            ->add('BIOMASSE', TextType::class, [
                'label' => 'Type Biomasse',
                'required' => false,
            ])
            ->add('VIS_BRASSAGE', TextType::class, [
                'label' => 'Vis brassage',
                'required' => false,
            ])
            ->add('QUANTITE', IntegerType::class, [
                'label' => 'Quantité',
                'required' => true,
            ])
            ->add('PRENETTOYEUR', TextType::class, [
                'label' => 'Prenettoyeur',
                'required' => false,
            ])
            ->add('B2D', TextType::class, [
                'label' => 'B2D',
                'required' => false,
            ])
            ->add('DEBIT_VIS', TextType::class, [
                'label' => 'Débit Vis',
                'required' => false,
            ])
            ->add('VIS_MOBILE', TextType::class, [
                'label' => 'Vis Mobile',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secheuse::class,
        ]);
    }
}
