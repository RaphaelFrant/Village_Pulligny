<?php

namespace App\Form;

use App\Entity\EvenementRecherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EvenementRechercheType extends AbstractType
{

    /**
     * Méthode permettant de créer le formulaire avec le nom des champs et les contraintes
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateMin', DateType::class, [
                'required' => false,
                'label' => 'Date minimale'
            ])
            ->add('dateMax', DateType::class, [
                'required' => false,
                'label' => 'Date maximale'
            ])
        ;
    }
    
    /**
     * Méthode permettant de gérer les options du formulaire
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EvenementRecherche::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }

}
