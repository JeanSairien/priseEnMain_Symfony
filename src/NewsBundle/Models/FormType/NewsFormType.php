<?php

namespace NewsBundle\Models\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsFormType
 *
 * On va definir un type de formulaire correspondant a nos objets
 * 
 * @author Formateur BeWeb
 */
class NewsFormType extends AbstractType {

    /**
     * On va fabriquer le formulaire grace A l'interface formbuilder
     * on implémente donc la methode buildForm heritée de AbstractType
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("date", TextType::class)
                ->add("titre", TextType::class)
                ->add("sujet", TextareaType::class)
                ->add("auteur", TextType::class)
                ->add("save", SubmitType::class);
    }

}
