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
        $response = $this->get('cloudinary_storage_service')->get($request);

        return $this->render('show.html.twig', array(
            'items' => $response['resources'],
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showImageAction(Request $request, $id)
    {
        $response = $this->get('cloudinary_storage_service')->getImage($id);

        return $this->render('show_item.html.twig', array(
            'item' => $response,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request)
    {
        $this->get('cloudinary_storage_service')->upload($request);

        return $this->redirectToRoute('show');
    }
}
