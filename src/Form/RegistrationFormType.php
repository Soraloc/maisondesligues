<?php

namespace App\Form;

use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifiant')
            ->add('password', FormType\RepeatedType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'type' => FormType\PasswordType::class,
                    'invalid_message' => 'Les champs mot de passe doivent correspondre',
                    'first_options' => [
                        'label' => 'Mot de passe',
                        'attr' => ['class' => 'password-field', 'autocomplete' => 'new-password'],
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Entrer un mot de passe',
                                    ]),
                            new Length([
                                'min' => 8,
                                'minMessage' => "Le mot de passe doit être d'au moins {{ limit }} caractères",
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                                    ]),
                        ],
                    ],
                    'second_options' => [
                        'label' => 'Répétez le mot de passe',
                        'attr' => ['class' => 'password-field', 'autocomplete' => 'new-password'],
                    ],
                    'mapped' => false,
                        ],
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
