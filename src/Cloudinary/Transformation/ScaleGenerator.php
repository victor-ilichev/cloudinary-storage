<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 24.07.2018
 * Time: 15:22
 */

namespace Victor\CloudinaryStorageBundle\Cloudinary\Transformation;

class ScaleGenerator implements Generator
{
    const ALIAS = 'scale';

    private $map = [
        'height' => 'h',
    ];

    public function generate(array $params): string
    {
        if (!isset($params[self::ALIAS])) {
            return '';
        }

        $uriParts = ['c_fill'];

        foreach ($this->map as $key => $value) {
            if (isset($params[self::ALIAS][$key])) {
                $uriParts[] = $value . '_' . $params[self::ALIAS][$key];
            }
        }

        return implode(',', $uriParts) . '/';
    }
}
