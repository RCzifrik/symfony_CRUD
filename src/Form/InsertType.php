<?php

namespace App\Form;

use App\Entity\Autos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('type')
            ->add('kleur', ChoiceType::class, [
                'choices' => [
                    'Zwart' => "Zwart",
                    'Wit' => "Wit",
                    'Zilver' => "Zilver",
                    'Blauw' => "Blauw",
                    'Rood' => "Rood",
                    'Groen' => "Groen",
                    'Geel' => "Geel",
                ]
            ])
            ->add('massa', IntegerType::class)
            ->add('prijs', MoneyType::class)
            ->add('voorraad', IntegerType::class)
            ->add('toevoegen', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autos::class,
        ]);
    }
}
