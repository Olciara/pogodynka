<?php

namespace App\Form;

use App\Entity\Weather;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('temperature', NumberType::class, [
                'attr' => [
                    'min' => -20,
                    'max' => 40,
                ],
                'html5' => true,
            ])
            ->add('humidity')
            ->add('wind')
            ->add('pressure')
            ->add('uv')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ])
            
            ->add('location',EntityType::class, [
                'class' => 'App\Entity\Location',
                'choice_label' => 'city',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
