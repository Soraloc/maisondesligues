<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;

class VacationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateHeureDebut', Type\DateTimeType::class)
            ->add('dateHeureFin', Type\DateTimeType::class)
            ->add('atelier', Type\DateTimeType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}
