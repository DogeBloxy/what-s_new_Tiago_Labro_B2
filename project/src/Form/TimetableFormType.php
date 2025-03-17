<?php

namespace App\Form;

use App\Entity\Timetable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimetableFormType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre',
                ]
            )
            ->add(
                'day_timetable',
                DateType::class,
                [
                    'label' => 'Date',
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'subject_morning',
                TextType::class,
                [
                    'label' => 'Matière du matin',
                ]
            )
            ->add(
                'professor_morning',
                TextType::class,
                [
                    'label' => 'Professeur du matin',
                ]
            )
            ->add(
                'subject_afternoon',
                TextType::class,
                [
                    'label' => 'Matière de l\'après-midi',
                ]
            )
            ->add(
                'professor_afternoon',
                TextType::class,
                [
                    'label' => 'Professeur de l\'après-midi',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Timetable::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'timetable_item',
        ]);
    }
}
