<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Atelier;
use App\Entity\Theme;

use App\Repository\ThemeRepository;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', Type\TextType::class)
            ->add('nbPlacesMaxi', Type\IntegerType::class)
            ->add('lesthemes', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'libelle',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function(ThemeRepository $repo) {
                    $lesThemes = $repo->getThemesTrieSurNom();
                    return $lesThemes;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
