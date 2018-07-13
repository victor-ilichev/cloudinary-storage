<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26.01.16
 * Time: 11:27
 */

namespace Victor\FileStorageBundle\TestApp\Admin;

use Pegas\EditorBundle\Testapp\Entity\Category;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogPostAdmin extends Admin
{
    protected $baseRouteName = 'BlogPostAdmin';
    protected $baseRoutePattern = 'BlogPostAdmin';

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title', TextareaType::class)
            ->add('category', 'entity', array(
                'class' => Category::class,
                'property' => 'title',
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('description');
    }
}
