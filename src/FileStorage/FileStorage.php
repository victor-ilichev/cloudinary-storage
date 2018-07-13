<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12.07.2018
 * Time: 13:03
 */

namespace Victor\FileStorageBundle\FileStorage;


use Symfony\Component\HttpFoundation\Request;

class FileStorage implements Storage
{
    private $key;
    private $url;

    public function __construct($key, $url)
    {
        $this->key = $key;
        $this->url = $url;
    }

    /**
     * @var Storage
     */
    private $storage;

    /**
     * @return Storage
     */
    public function getStorage(): Storage
    {
        return $this->storage;
    }

    /**
     * @param Storage $storage
     */
    public function setStorage(Storage $storage): void
    {
        $this->storage = $storage;
    }

    public function get(Request $request): array
    {
        return $this->getStorage()->get($request);
    }

    public function upload(Request $request): array
    {
        //$this->getStorage()->getUploadValidator()->validate($request);
        $data = $this->getStorage()->upload($request);

        return $data;
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