<?php

namespace App\Form;

use App\Entity\Horarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class HorariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('horaInicio', TimeType::class)
            ->add('horaFinal',  TimeType::class)
            ->add('dia', ChoiceType::class, [
                'choices' => [
                    'lunes' => 1,
                    'martes' => 2,
                    'miercoles' => 3,
                    'jueves' => 4,
                    'viernes' => 5
                ]
            ])
            ->add('actividad')            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horarios::class,
        ]);
    }
}
