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
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('show.html.twig', array(
            'items' => $result->getData()['resources'],
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showImageAction(Request $request, $id)
    {
        $result = $this->get('cloudinary_storage_service')->getImage($id);

        return $this->render('show_item.html.twig', array(
            'item' => $result->getData(),
        ));
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
