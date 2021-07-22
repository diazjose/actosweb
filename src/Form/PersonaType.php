<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Security;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellidos', null, [
                'label' => 'Apellidos',
                'required' => True,
            ])
            ->add('nombre', null, [
                'label' => 'Nombre',
                'required' => True,
            ])
            ->add('dni', null, [
                'label' => 'N° Documento',
                'required' => false,
            ])
            ->add('cuil',null, [
                "label" => "Cuil",
                'required' => false,
              ])
            ->add('fechaNac', Type\DateType::class, [
                'label' => 'Fecha de Nacimiento',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Día', 'month' => 'Mes', 'year' => 'Año',
                ],                
                'format' => 'dd-MM-yyyy',
                'required' => false,
                'years' => range(1930,2030), 
                'label_attr' => array('style' => 'font-weight: bold;margin-top: 0px !important;margin-bottom: 0px !important;')        
            ])
            ->add('domicilio',null, [
                "label" => "Domicilio",
                'required' => false,
              ])
            ->add('nacionalidad',null, [
                "label" => "Nacionalidad",
                'required' => false,
              ])
            ->add('estadoCivil', ChoiceType::class, [
                'choices'  => [
                    'Soltero/a' => 'Soltero/a',
                    'Casado/a' => 'Casado/a',
                    'Viudo/a' => 'Viudo/a',
                ],
                "label" => "Estado Civil",
            ])
            ->add('email',null, [
                "label" => "Correo Electrónico",
                'required' => false,
              ])
            ->add('telephone',null, [
                "label" => "Teléfono",
                'required' => false,
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
