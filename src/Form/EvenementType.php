<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


/**
 * Classe permettant de générer un formulaire pour la gestion des événements
 */
class EvenementType extends AbstractType
{

    /**
     * Méthode permettant de créer le formulaire avec le nom des champs et les contraintes
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('type', TextType::class)
            ->add('description', TextType::class)
            ->add('dateEvent', DateType::class, [
                'label' => 'Date de l\'événement'
            ])
            ->add('inscription')
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
            //->add('created_at', HiddenType::class)
        ;
    }

    /**
     * Méthode permettant de gérer les options du formulaires
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
