<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IdenticalTo;

class UpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nouveauMotPasse', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Confirmation erronée',
                'required' => false,
                'mapped'=>false,
                'first_options'  => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmation du nouveau mot de passe'],
            ])
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('pseudo')
            ->add('campus', EntityType::class, [
                'label'=>'Campus',
                'class' => Campus::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
