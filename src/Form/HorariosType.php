<?php

namespace App\Form;

use App\Entity\Horarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horaInicio')
            ->add('horaFinal')
            ->add('dia')
            ->add('actividad')
            ->add('idAlumno')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horarios::class,
        ]);
    }
}
