<?php

namespace Victor\FileStorageBundle\Model;

class CloudinaryData
{
    private $id;
    private $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return CloudinaryData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return CloudinaryData
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
