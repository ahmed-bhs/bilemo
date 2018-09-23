<?php

namespace AppBundle\Form\User;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\EventListener\AntiSqlInjectionFormListener;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCreateType extends AbstractType
{
    /**
     * Build the form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $option
     */
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        // Using $option to avoid Codacy error "Unused Code"
        $option = null;

        // The entity fields are added to our form.
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new Length(['max' => 4096]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9]{6,}$/',
                        'message' => 'Le mot de passe doit comporter au moins 6 caractères,
                        minuscule, majuscule et numérique.',
                    ]),
                    new NotBlank(),
                ],
            ])
            ->addEventSubscriber(new AntiSqlInjectionFormListener());
    }

    /**
     * {@inheritdoc}
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
