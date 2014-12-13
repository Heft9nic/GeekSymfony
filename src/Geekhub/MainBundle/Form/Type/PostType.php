<?php

namespace Geekhub\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', ['label' => 'Title'])
        ->add('content', 'textarea', ['label' => 'Content']);
        /*->add('tagList', 'choice', [
                'choices'=> ['News' => 'News', 'World of Tanks' => 'World of Tanks'],
                'label' => 'Tags',
                'multiple' => true,
                'expanded' => false,
            ]);*/
        $builder->add('tags', 'entity', array(
                'label' => 'Tags',
                'class' => 'GeekhubMainBundle:Tag',
                'property' => 'tagName',
                'empty_value' => 'Choose a tag',
                'multiple' => true,
                'expanded' => false,
                /*'query_builder' => function (EntityRepository $em) use ($profileId) {
                        return $em->createQueryBuilder('c')
//                                ->where('c.profile =:profileId')
                            ->join('c.profile', 'p')
                            ->where('p.id = :profileId')
                            ->setParameter('profileId', $profileId);
                    }*/
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Geekhub\MainBundle\Entity\Post',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'post';
    }
} 