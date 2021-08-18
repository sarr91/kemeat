<?php

namespace App\Form;

use App\Entity\NosPlats;
use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NosPlats1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=> "nom"])
            ->add('description', TextareaType::class)
            ->add('price', NumberType::class)
            ->add('date',DateType::class,[
                'label' => 'Date de parution',
                'widget' => 'single_text'
                ] )
            ->add('img', FileType::class,["required"=>false,'mapped'=>false, 'help'=> 'png,jpeg - 2 Mo max', 'constraints'=>
            [new File(['maxSize'=>'2048k', 'mimeTypes'=>['image/png', 'image/jpg','image/jpeg']])]])
            ->add('restaurant', EntityType::class, ['label'=>'restaurant', 'class'=>Restaurant::class, 'choice_label'=>"name"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NosPlats::class,
        ]);
    }
}
