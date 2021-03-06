<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut', DateTimeType::class, array(
                'required' => true,
                'widget'  => 'single_text',
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control input-inline datetimepicker',
                    'data-provide' => 'datetimepicker',
                ],
                'html5' => true,
            ))
            ->add('fin', DateTimeType::class, array(
                'required' => true,
                'widget' => 'single_text',
                'attr' => [
                    'type' => 'text',
                    'class' => 'form-control input-inline datetimepicker',
                    'data-provide' => 'datetimepicker',
                ],
                'html5' => true,
            ))
            ->add('idEnseignant')
            ->add('idGroupe')
            ->add('idMatiere')
            ->add('idSalle')
            ->add('idType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
