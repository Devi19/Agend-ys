<?php

namespace App\Form;

use App\Entity\Calificaciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalificacionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nota')
            ->add('idMateria')
            ->add('idCiclo', ChoiceType::class, [
                'choices' => [
                    'Primer Trimestre' => 1,
                    'Segundo Trimestre' => 2,
                    'Tercer Trimestre' => 3,
                    'Primer Cuatrimestre' => 4,
                    'Segundo Cuatrimestre' => 5
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calificaciones::class,
        ]);
    }
}
