<?php

namespace App\Form;

use App\Entity\Acto;
use App\Entity\TipoActo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroHoja', null, [
                'label' => 'N° Hoja',
                'required' => true,
            ])
            ->add('tipoActo', EntityType::class, [
                'class' => TipoActo::class,
                'choice_label' => 'nombre',
                'label' => 'Tipo de Acto',
                'required' => true,
             ])
            ->add('folio', null, [
                'label' => 'Folio',
                'required' => false,
            ]) 
            ->add('numeroLibro', null, [
                'label' => 'N° Libro',
                'required' => false,
            ])
            ->add('numeroActa', null, [
                'label' => 'N° Acta',
                'required' => false,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acto::class,
        ]);
    }
}
