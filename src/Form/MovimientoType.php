<?php

namespace App\Form;

use App\Entity\Movimiento;
use App\Entity\EstadoActo;
use App\Entity\LugarActo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MovimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lugar', EntityType::class, [
                'class' => LugarActo::class,
                'choice_label' => 'nombre',
                'label' => 'Lugar',
                'required' => true,
             ])
             ->add('estado', EntityType::class, [
                'class' => EstadoActo::class,
                'choice_label' => 'nombre',
                'label' => 'Estado',
                'required' => true,
             ])
            ->add('fechaInicio', Type\DateType::class, [
                'label' => 'Fecha de Inicio',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => true,
                'years' => range(2010,2050), 
                'data' => new \DateTime(),
                'label_attr' => array('style' => 'font-weight: bold;margin-top: 0px !important;margin-bottom: 0px !important;')
             ])
            ->add('fechaFin', Type\DateType::class, [
                'label' => 'Fecha de Fin',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => false,
                'years' => range(2010,2050),
                'empty_data' => '',                        
                'by_reference' => true,  
                'label_attr' => array('style' => 'font-weight: bold;margin-top: 0px !important;margin-bottom: 0px !important;')
             ])
             ->add('observacion', TextareaType::class, [
                'label' => 'Observación',
                'required' => false,
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movimiento::class,
        ]);
    }
}
