<?php

/**
 * @package Victor\FileStorageBundle\Cloudinary
 */
namespace Victor\FileStorageBundle\Cloudinary;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Victor\FileStorageBundle\FileStorage\Storage;

/**
 * Class Cloudinary
 */
class Cloudinary implements Storage
{
    private $cloudName;
    private $key;
    private $secret;
    private $apiUrl;
    /**
     * @var Client
     */
    private $client;

    /**
     * Cloudinary constructor.
     *
     * @param $cloudName
     * @param $key
     * @param $secret
     * @param $apiUrl
     * @param Client $client
     */
    public function __construct($cloudName, $key, $secret, $apiUrl, Client $client)
    {
        $this->cloudName = $cloudName;
        $this->key = $key;
        $this->secret = $secret;
        $this->apiUrl = $apiUrl;
        $this->client = $client;
    }

    public function get(Request $request): array
    {
        $response = $this->client->get('http://ya.ru');

        return [(string) $response->getBody()];
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
