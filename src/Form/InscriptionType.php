<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Classe permettant de générer un formulaire pour l'inscription de personnes à un événement
 */
class InscriptionType extends AbstractType
{

    /**
     * Méthode permettant de créer le formulaire avec le nom des champs et les contraintes
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [   
                'label' => 'Nom',
                'label_format' => '%name%',])
            ->add('prenom', TextType::class, [   
                'label' => 'Prénom',
                'label_format' => '%name%',])
            ->add('email', EmailType::class, [   
                'label' => 'Email',
                'label_format' => '%name%',])
        ;
    }

    /**
     * Méthode permettant de gérer les options du formulaires
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}