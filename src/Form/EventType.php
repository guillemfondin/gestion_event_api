<?php

namespace App\Form;

use App\Entity\Event;
use App\Service\ConfigurationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Sport;

class EventType extends ConfigurationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfig("Nom", "Nom de l'évènement"))
            ->add('date', DateType::class, $this->getConfig("Date", "Date de l'évènement", [
                'widget' => 'single_text',
            ]))
            ->add('location', TextType::class, $this->getConfig("Lieu", "Lieu de l'évènement"))
            ->add('nb_participants', IntegerType::class, $this->getConfig("Nombre de participants", "Nombre de participants maximum"))
            ->add('sport', EntityType::class, $this->getConfig("Sport", "", [
                'class' => Sport::class,
                'choice_label' => 'name'
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
