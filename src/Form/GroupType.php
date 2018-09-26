<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 26/09/2018
 * Time: 17:52
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use App\Entity\Group;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Group::class,
        ));
    }
}