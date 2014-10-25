<?php

namespace Tlmalp\QrcodePhotoAssociateBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tlmalp\QrcodePhotoAssociateBundle\Entity\QRCodeAssociation;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:index.html.twig');
    }

    /**
     * @Route("/ouaissuper.pdf", name="_tlmalpToto")
     * @Template()
     */
    public function totoAction()
    {
        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => 'cest genial', 'qrcode' => 'trop bien', 'photo' => 'ouasis'));
    }

    /**
     * @Route("/yourphoto/{action}/{qrcode}", name="_show_photo")
     * @Template()
     */
    public function showPhotoAction($action, $qrcode)
    {
        $qrcodeassociation = $this->findAssociationByCode($action, $qrcode);

        if (!$qrcodeassociation){
            $this->get('session')->getFlashBag()->add(
                'error',
                'QRCODE : ' . $qrcode . ' for action : ' . $action . ' was not found!'
            );
            return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:show_photo.html.twig');
        }else{
            return $this->redirect($this->getUrlBase() . $action . '/' . $qrcodeassociation->getPhotoFileName());
        }


    }

    /**
     * @Route("/associate/{action}/{qrcode}/{photo}", name="_show_association", methods={"GET"})
     * @Template()
     */
    public function showAssociationAction($action, $qrcode, $photo)
    {

        $foundAssociation = $this->findAssociationByCode($action, $qrcode);

        if ($foundAssociation){
            $this->get('session')->getFlashBag()->add('error', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' exists already!');
        }else{
            $this->get('session')->getFlashBag()->add('success', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' does not exist');
        }

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate_result.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
    }

    /**
     * @Route("/associate/{action}/{qrcode}/{photo}", name="_create_association", methods={"PUT"})
     * @Template()
     */
    public function createAssociationAction($action, $qrcode, $photo)
    {

        $foundAssociation = $this->findAssociationByCode($action, $qrcode);

        if ($foundAssociation){
            $this->get('session')->getFlashBag()->add('error', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' exists already!');
        }else{
            $association = new QRCodeAssociation();
            $association->setAction($action);
            $association->setQrcode($qrcode);
            $association->setPhotoFileName($photo);

            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' was saved!');
        }

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate_result.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
    }

    /**
     * @Route("/associate/{action}/{qrcode}/{photo}", name="_override_association", methods={"POST"})
     * @Template()
     */
    public function overrideAction($action, $qrcode, $photo)
    {

        $foundAssociation = $this->findAssociationByCode($action, $qrcode);

        if (!$foundAssociation){
            $this->get('session')->getFlashBag()->add('error', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' was not found!');
        }else{
            $foundAssociation->setPhotoFileName($photo);
            $foundAssociation->setPhotoFileName($photo);

            $em = $this->getDoctrine()->getManager();
            $em->merge($foundAssociation);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'QRCODE : ' . $qrcode . ' for action : ' . $action . ' and photo ' . $photo . 'was saved!');
        }

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate_result.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
    }

    /**
     * @param $action
     * @param $qrcode
     * @return object
     */
    public function findAssociationByCode($action, $qrcode)
    {
        $qrcodeassociation = $this->getDoctrine()
            ->getRepository('Tlmalp\QrcodePhotoAssociateBundle\Entity\QRCodeAssociation')
            ->findOneBy(array('qrcode' => $qrcode, 'action' => $action));
        return $qrcodeassociation;
    }

    /**
     * @return mixed
     */
    public function getUrlBase()
    {
        return 'http://localhost/';
    }
}
