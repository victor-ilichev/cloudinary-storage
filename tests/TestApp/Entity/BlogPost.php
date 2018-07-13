<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26.01.16
 * Time: 11:03
 */

namespace Pegas\EditorBundle\Testapp\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pegas\EditorBundle\Model\EditorData;

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
     * @ORM\Column(type="editor_data", length=255, name="`description`")
     * @var EditorData
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="blogPosts")
     */
    private $category;

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
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

}
