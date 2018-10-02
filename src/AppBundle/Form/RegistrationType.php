<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Type;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', Type\TextType::class);
        $builder->add('breed', Type\TextType::class);
        $builder->add('age', Type\IntegerType::class);
        $builder->add('family', Type\TextType::class);
        $builder->add('food', Type\ChoiceType::class, [
            'choices' => ['Fishes' => 'Poissons', 'Ants' => 'Fourmis', 'Chocolates' => 'Chocolats', 'HARIBO' => 'HARIBO'],
            'multiple' => true
        ]);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}