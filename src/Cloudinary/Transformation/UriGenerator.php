<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 24.07.2018
 * Time: 14:58
 */

namespace Victor\FileStorageBundle\Cloudinary\Transformation;


class UriGenerator
{
    /**
     * @var Generator[]
     */
    private $generators = [];

    public function addGenerator($generator)
    {
        $this->generators[] = $generator;
    }

    public function generateUrlByParams($origianlUrl, array $params = [])
    {
        if (empty($params)) {
            return $origianlUrl;
        }

        $parts = explode('upload/', $origianlUrl);

        if (2 !== count($parts)) {
            return $origianlUrl;
        }

        $prefix = $parts[0] . 'upload/';
        $postfix = $parts[1];
        $uriCollection = [];

        foreach ($this->generators as $transformer) {
            $uriCollection[] = $transformer->generate($params);
        }

        return $prefix . implode('/', array_filter($uriCollection)) . $postfix;
    }
}