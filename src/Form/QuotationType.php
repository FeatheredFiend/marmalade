<?php

namespace App\Form;

use App\Entity\VehicleRegistration;
use App\Entity\AgeRating;
use App\Entity\PostcodeRating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class QuotationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('age', TextType::class,['label' => 'Age'])
            ->add('postcode', TextType::class,['label' => 'Postcode Area'])
            ->add('vehicleregistration', TextType::class,['label' => 'Vehicle Registration'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
