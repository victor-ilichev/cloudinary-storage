<?php

namespace Victor\FileStorageBundle\Cloudinary;

use Symfony\Component\HttpFoundation\Request;
use Victor\FileStorageBundle\FileStorage\Storage;

class Cloudinary implements Storage
{
    public function get(Request $request): array
    {
        // TODO: Implement get() method.
    }

    public function upload(Request $request): array
    {
        return [];
    }

    public function update(Request $request): array
    {
        // TODO: Implement update() method.
    }

    public function delete(Request $request): array
    {
        // TODO: Implement delete() method.
    }
}
