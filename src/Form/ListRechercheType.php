<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\ListRecherche;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie',
                'required' => false,
            ])
            ->add('campus', EntityType::class, [
                'label' => 'Campus',
                'class' => Campus::class,
                'choice_label' => 'nom',
                'required' => false,
            ])
            ->add('dateDebut', DateType::class, [
                'label' => 'Entre  ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Et  ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('sortiePassee', CheckboxType::class, [
                'label' => 'Sorties passées',
                'required' => false
            ])
            ->add('sortieOrganisateur', CheckboxType::class, [
                'label' => 'Sortie dont je suis l organisateur/trice ',
                'required' => false
            ])
            ->add('sortieInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e ',
                'required' => false
            ])
            ->add('sortieNonInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e ',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListRecherche::class,
        ]);
    }
}
