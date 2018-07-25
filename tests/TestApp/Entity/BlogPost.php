<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26.01.16
 * Time: 11:03
 */

namespace Victor\CloudinaryStorageBundle\TestApp\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victor\CloudinaryStorageBundle\Model\CloudinaryData;

/**
 * Class Category
 * @package Pegas\EditorBundle\Testapp\Entity
 * @ORM\Entity()
 * @ORM\Table(name="blog_post")
 */
class BlogPost
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="`title`")
     */
    protected $title;

    /**
     * @ORM\Column(type="text", length=255, name="`description`")
     */
    protected $description;

    /**
     * @ORM\Column(type="cloudinary_data", length=1024, name="`image`")
     * @var CloudinaryData
     */
    protected $image;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return CloudinaryData
     */
    public function getImage(): CloudinaryData
    {
        return $this->image;
    }

    /**
     * @param CloudinaryData $image
     */
    public function setImage(CloudinaryData $image): void
    {
        $this->image = $image;
    }
}
