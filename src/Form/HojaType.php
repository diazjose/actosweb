<?php

namespace App\Form;

use App\Entity\Hoja;
use App\Entity\TipoActo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class HojaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', null, [
                'label' => 'Stock',
                'required' => True,
            ])
            ->add('alarma', null, [
                'label' => 'Cant. Alarma',
                'required' => True,
            ])
            ->add('tipoActo', EntityType::class, [
                'class' => TipoActo::class,
                'choice_label' => 'nombre',
                'label' => 'Tipo de Acto',
                'required' => true,
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hoja::class,
        ]);
    }
}
