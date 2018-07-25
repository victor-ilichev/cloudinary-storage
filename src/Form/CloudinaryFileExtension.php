<?php

namespace Victor\CloudinaryStorageBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Victor\CloudinaryStorageBundle\Cloudinary\Transformation\UriGenerator;
use Victor\CloudinaryStorageBundle\Model\CloudinaryData;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Victor\CloudinaryStorageBundle\Cloudinary\Cloudinary;
use Victor\CloudinaryStorageBundle\Form\Transformer\CloudinaryModelTransformer;
use Victor\CloudinaryStorageBundle\Form\Transformer\CloudinaryViewTransformer;

class CloudinaryFileExtension extends AbstractTypeExtension
{
    /**
     * @var Cloudinary
     */
    private $cloudinary;
    /**
     * @var UriGenerator
     */
    private $uriGenerator;

    public function __construct(Cloudinary $cloudinary, UriGenerator $uriGenerator)
    {
        $this->cloudinary = $cloudinary;
        $this->uriGenerator = $uriGenerator;
    }

    public function getExtendedType()
    {
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(array('image_property', 'transformations'));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->addModelTransformer(
                new CloudinaryModelTransformer(
                    $this->cloudinary,
                    $this->uriGenerator,
                    $options['transformations']
                )
            )
            ->addViewTransformer(new CloudinaryViewTransformer($this->cloudinary))
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $formData = $event->getForm()->getData();

                if (is_a($formData, CloudinaryData::class) && is_null($event->getData())) {
                    $event->setData($formData);
                }
            })
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['image_url'] = '';

        if (isset($options['image_property'])) {
            // this will be whatever class/entity is bound to your form (e.g. Media)
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['image_property']);
            }

            // sets an "image_url" variable that will be available when rendering this field
            if (is_a($imageUrl,CloudinaryData::class)) {
                $view->vars['image_url'] = $imageUrl->getUrl();
            }
        }
    }
}
