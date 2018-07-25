<?php

/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12.01.16
 * Time: 13:14
 */

namespace Victor\FileStorageBundle\TestApp\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Victor\FileStorageBundle\Model\CloudinaryData;
use Victor\FileStorageBundle\TestApp\Entity\BlogPost;

/**
 * Class TestController
 * @package Victor\FileStorageBundle\TestApp\Controller
 * @Route()
 */
class TestController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $result = $this->get('cloudinary_storage_service')->get($request);

        if ($result->isSuccess()) {
            $blogPost = new BlogPost();
            $blogPost->setImage(new CloudinaryData());

            $form = $this->createFormBuilder($blogPost)
                ->add('title', TextType::class)
                ->add('description', TextType::class)
                ->add('image', FileType::class, [
                    'image_property' => 'image',
                    'transformations' => [
                        'scale' => [
                            'height' => 300,
                        ],
                    ],
                ])
                ->add('save', SubmitType::class, array('label' => 'Create Blog Post'))
                ->getForm()
            ;

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $submitedBlogPost = $form->getData();

                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                // $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($task);
                // $entityManager->flush();

                return $this->render('blogpost.html.twig', [
                    'blogPost' => $submitedBlogPost,
                ]);
            }

            return $this->render('show.html.twig', array(
                'items' => $result->getData()['resources'],
                'form' => $form->createView(),
            ));
        }

        return $this->render('error.html.twig', [
            'message' => $result->getMessage(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showImageAction(Request $request, $id)
    {
        $result = $this->get('cloudinary_storage_service')->getImage($id);

        if ($result->isSuccess()) {
            return $this->render('show_item.html.twig', array(
                'item' => $result->getData(),
            ));
        }

        return $this->render('error.html.twig', [
            'message' => $result->getMessage(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request)
    {
        $file = $request->files->get($this->getParameter('uploaded_file_name'));
        $this->get('cloudinary_storage_service')->upload($file);

        return $this->redirectToRoute('show');
    }
}
