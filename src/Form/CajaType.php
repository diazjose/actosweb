<?php

namespace App\Form;

use App\Entity\Caja;
use App\Entity\TipoCaja;
use App\Entity\TipoPago;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CajaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monto')
            ->add('concepto', EntityType::class, [
                'class' => TipoCaja::class,
                'choice_label' => 'nombre',
                'label' => 'Concepto',
                'required' => true,
             ])
            ->add('tipoPago', EntityType::class, [
                'class' => TipoPago::class,
                'choice_label' => 'nombre',
                'label' => 'Tipo de Pago',
                'required' => true,
             ]) 
            ->add('detalle', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caja::class,
        ]);
    }
}
