<?php

namespace App\Form;

use App\Entity\Caja;
use App\Entity\TipoCaja;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CajaFiltroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaIni', DateType::class,[
                'label' => 'Desde',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => false,
            ])
            ->add('fechaFin', DateType::class,[
                'label' => 'Hasta',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => false,
            ])
            ->add('concepto', EntityType::class, [
                'class' => TipoCaja::class,
                'placeholder' => 'Ninguno',
                'choice_label' => 'nombre',
                'label' => 'Concepto',
                'required' => false,
             ])
        ;
    }

    public function getName()
    {
        return 'filtro';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
          'csrf_protection' => false,
      ));
    }
}
