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
use Symfony\Component\HttpFoundation\Response;

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
     * @Route(name=show, path="/")
     */
    public function showAction(Request $request)
    {
//        $form = $this->createForm(EditorType::class);
//
//        $editorPresenter = $this->get('widget.widget_presenter');
//        $widjetList = $editorPresenter->widgetToSelect();

        return $this->render('show.html.twig', array(
//            'form' => $form->createView(),
//            'widgetList' => $widjetList
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(name=upload, path="/upload")
     */
    public function uploadAction(Request $request)
    {
        $this->get('file_storage')->upload($request);

        return $this->redirectToRoute('show');
    }
}
