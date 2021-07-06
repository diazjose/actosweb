<?php

namespace App\Form;

use App\Entity\ReposicionHoja;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReposicionHojaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', null, [
                'required' => true,
            ])
            ->add('fecha', Type\DateType::class, [
                'label' => 'Fecha de Reposición',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => True,
                'years' => range(2021,2030),                
                'data' => new \DateTime(),   
                'label_attr' => array('style' => 'font-weight: bold;margin-top: 0px !important;margin-bottom: 0px !important;')        
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReposicionHoja::class,
        ]);
    }
}
