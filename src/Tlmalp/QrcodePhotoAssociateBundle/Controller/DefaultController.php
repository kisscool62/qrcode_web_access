<?php

namespace Tlmalp\QrcodePhotoAssociateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tlmalp\QrcodePhotoAssociateBundle\Entity\QRCodeAssociation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
     * @Route("/yourphoto.png", name="_tlmalpQrcodePhoto")
     * @Template()
     */
    public function photoAction()
    {
        $action = 'toto';
        $qrcode = 'tata';
        $qrcodeassociation = $this->getDoctrine()
            ->getRepository('Tlmalp\QrcodePhotoAssociateBundle\Entity\QRCodeAssociation')
            ->findOneBy(array('qrcode' => $qrcode, 'action' => $action));

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => 'pas trouve', 'qrcode' => $qrcode, 'photo' => 'pas trouve'));

        if (!$qrcodeassociation){
            throw $this->createNotFoundException('QRCODE : ' & $qrcode & ' for action : ' & $action & ' was not found');
        }

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $qrcodeassociation->getPhoto()));

    }

    /**
     * @Route("/associate/{action}/{qrcode}/{photo}", name="_tlmalpQrcode_photo_associate")
     * @Template()
     */
    public function associateAction($action, $qrcode, $photo)
    {
        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
    }
}
