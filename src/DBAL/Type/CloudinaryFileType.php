<?php

namespace Victor\CloudinaryStorageBundle\DBAL\Type;

use Victor\CloudinaryStorageBundle\Exception\FileStorageException;
use Victor\CloudinaryStorageBundle\Model\CloudinaryData;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class CloudinaryFileType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TEXT';
    }

    public function getName()
    {
        return self::class;
    }

    public function convertToPHPValue($data, AbstractPlatform $platform)
    {
        try {
            $decodedData = json_decode($data, true);

            if (JSON_ERROR_NONE === json_last_error()) {
                $cloudinaryData = new CloudinaryData();

                if (isset($decodedData['public_id'])) {
                    $cloudinaryData->setId($decodedData['public_id']);
                }

                if (isset($decodedData['url'])) {
                    $cloudinaryData->setUrl($decodedData['url']);
                }

                return $cloudinaryData;
            }

            throw new FileStorageException('CloudinaryData does not recognized.');
        } catch (\Exception $e) {
            $cloudinaryData = new CloudinaryData();
        }

        return $cloudinaryData;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return json_encode($value);
    }
}
