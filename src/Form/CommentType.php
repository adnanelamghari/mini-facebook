<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 23/09/2018
 * Time: 03:21
 */

namespace App\Form;


class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('content', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comment::class,
        ));
    }
}