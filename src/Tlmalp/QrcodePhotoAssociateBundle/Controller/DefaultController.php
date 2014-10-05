<?php

namespace Tlmalp\QrcodePhotoAssociateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:index.html.twig');
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
