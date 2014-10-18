<?php
/**
 * Created by PhpStorm.
 * User: kisscool
 * Date: 18/10/14
 * Time: 19:48
 */

namespace Tlmalp\QrcodePhotoAssociateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity
 * @ORM\Table(name="qrcodeassociation", uniqueConstraints={@UniqueConstraint(name="search_idx", columns={"action", "qrcode"})})
 */
class QRCodeAssociation {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="action")
     */
    protected $action;

    /**
     * @ORM\Column(type="string", length=100, name="qrcode")
     */
    protected $qrcode;

    /**
     * @ORM\Column(type="string", length=100, name="photo_file_name")
     */
    protected $photo_file_name;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPhotoFileName()
    {
        return $this->photo_file_name;
    }

    /**
     * @param mixed $photo_file_name
     */
    public function setPhotoFileName($photo_file_name)
    {
        $this->photo_file_name = $photo_file_name;
    }

    /**
     * @return mixed
     */
    public function getQrcode()
    {
        return $this->qrcode;
    }

    /**
     * @param mixed $qrcode
     */
    public function setQrcode($qrcode)
    {
        $this->qrcode = $qrcode;
    }



}
