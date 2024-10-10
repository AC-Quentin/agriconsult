<?php

namespace App\Form;

use App\Entity\Secheuse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            '65' => '65',
            '100' => '100',
        ];

        $collection_type_module = [
            '15CV' => '15',
            '20CV' => '20',
            '25CV' => '25',
            '30CV' => '30',
        ];

        $collection_biomasse = [
            'GDS580' => 'GDS 580',
            'GDS720' => 'GDS 720',
            'GDS1100' => 'GDS 1100',
            'GDS1280' => 'GDS 1280',
        ];

        $collection_gaz = [
            'PROPANE' => 'PROPANE',
            'GAZ NATUREL' => 'GAZ NATUREL',
        ];

        $collection_oui_non = [
            'OUI' => 'OUI',
            'NON' => 'NON',
        ];

        $collection_prenettoyeur = [
            'SUR TV' => 'SUR TV',
            'SUR TOIT' => 'SUR TOIT',
            'SUR TV ET TOIT' => 'SUR TV ET TOIT',
        ];

        $collection_debit_vis = [
            '65' => '65T/h',
            '100' => '100T/h',
        ];

        $collection_vis_mobile = [
            'WRX841' => 'WRX841',
            'WRX851' => 'WRX851',
            'WRX871' => 'WRX871',
            'SA1060' => 'SA1060',
            'SA1070' => 'SA1070',
            'SA1080' => 'SA1080',
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
            ->add('GAZ', ChoiceType::class, [
                'choices' => $collection_gaz,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('BIOMASSE', ChoiceType::class, [
                'choices' => $collection_biomasse,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('VIS_BRASSAGE', ChoiceType::class, [
                'choices' => $collection_oui_non,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
            ])
            ->add('QUANTITE', IntegerType::class, [
                'label' => 'Quantité',
                'required' => true,
            ])
            ->add('PRENETTOYEUR', ChoiceType::class, [
                'choices' => $collection_prenettoyeur,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
            ])
            ->add('B2D', ChoiceType::class, [
                'choices' => $collection_oui_non,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
            ])
            ->add('DEBIT_VIS', ChoiceType::class, [
                'choices' => $collection_debit_vis,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
            ])
            ->add('VIS_MOBILE', ChoiceType::class, [
                'choices' => $collection_vis_mobile,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('SORTIE_ORIENTABLE', ChoiceType::class, [
                'choices' => $collection_oui_non,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
                'mapped' => false,
            ])
            ->add('BAC', ChoiceType::class, [
                'choices' => $collection_oui_non,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Choisissez une option',
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secheuse::class,
        ]);
    }
}
