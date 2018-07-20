<?php

namespace Victor\FileStorageBundle\DBAL\Type;

use Victor\FileStorageBundle\Model\CloudinaryData;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class CloudinaryFileType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        // TODO: Implement getSQLDeclaration() method.
    }

    public function getName()
    {
        return self::class;
    }

    public function convertToPHPValue($cloudinaryData, AbstractPlatform $platform)
    {
        try {
            $cloudinaryData = unserialize($cloudinaryData);

            if (!$cloudinaryData instanceof CloudinaryData) {
                $cloudinaryData =
                    (new CloudinaryData())
                        ->setId($cloudinaryData['public_id'])
                        ->setUrl($cloudinaryData['url'])
                ;
            }

        } catch (\Exception $e) {
            $message = $e->getMessage();
            $cloudinaryData = new CloudinaryData();
        }


        return $cloudinaryData;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return serialize($value);
    }
}
