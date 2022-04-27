<?php

namespace App\Form;

use App\Model\Calculator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number1', NumberType::class)
            ->add('number2', NumberType::class)
            ->add('operator', ChoiceType::class, [
                'invalid_message' => '+,-,*,/ are the only allowed operators',
                'choices' => [
                    '+' => '+',
                    '-' => '-',
                    '*' => '*',
                    '/' => '/',
                ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calculator::class,
        ]);
    }
}
