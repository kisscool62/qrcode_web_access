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
     * @Route("/yourphoto/{action}/{qrcode}", name="_tlmalpQrcodePhoto")
     * @Template()
     */
    public function photoAction($action, $qrcode)
    {
        $qrcodeassociation = $this->findAssociationByCode($action, $qrcode);

        if (!$qrcodeassociation){
            $this->get('session')->getFlashBag()->add(
                'error',
                'QRCODE : ' . $qrcode . ' for action : ' . $action . ' was not found!'
            );
            return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig');
        }else{
            return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $qrcodeassociation->getPhoto()));
        }


    }

    /**
     * @Route("/associate/{action}/{qrcode}/{photo}", name="_tlmalpQrcode_photo_associate", methods={"PUT"})
     * @Template()
     */
    public function associateAction($action, $qrcode, $photo)
    {
        $association = new QRCodeAssociation();
        $association->setAction($action);
        $association->setQrcode($qrcode);
        $association->setPhotoFileName($photo);

        $foundAssociation = $this->findAssociationByCode($action, $qrcode);

        if ($foundAssociation){
            $action="not saved";
        }else{
            $action="saved!! :)";
            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em.flush();
        }

        return $this->render('TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
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
}
