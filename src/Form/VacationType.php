<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Vacation;
use App\Entity\Atelier;

use App\Repository\AtelierRepository;

class VacationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateHeureDebut', Type\DateTimeType::class, [
                'date_widget' => 'single_text',
            ])
            ->add('dateHeureFin', Type\DateTimeType::class, [
                'date_widget' => 'single_text',
            ])
            ->add('atelier', EntityType::class, [
                'class' => Atelier::class,
                'choice_label' => 'libelle',
                'expanded' => true,
                'multiple' => false,
                'query_builder' => function(AtelierRepository $repo) {
                    $lesAteliers = $repo->getAteliersTrieSurNom();
                    return $lesAteliers;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}
