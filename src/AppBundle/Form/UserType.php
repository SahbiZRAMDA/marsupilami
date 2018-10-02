<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;

class UserType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }

}
