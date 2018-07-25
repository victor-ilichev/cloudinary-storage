<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 24.07.2018
 * Time: 15:21
 */

namespace Victor\FileStorageBundle\Cloudinary\Transformation;

interface Generator
{
    public function generate(array $params): string;
}
