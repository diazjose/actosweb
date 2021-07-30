<?php

namespace App\Form;

use App\Entity\Presupuesto;
use App\Entity\TipoActo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class PresupuestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acto', EntityType::class, [
                'class' => TipoActo::class,
                'placeholder' => '-- Seleccionar Tipo de Acto -- ',
                'choice_label' => 'nombre',
                'label' => 'Tipo de Acto',
                'required' => true,
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presupuesto::class,
        ]);
    }
}
