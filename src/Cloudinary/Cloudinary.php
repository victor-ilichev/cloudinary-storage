<?php

/**
 * @package Victor\FileStorageBundle\Cloudinary
 */
namespace Victor\FileStorageBundle\Cloudinary;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
    private $certPath;

    /**
     * Cloudinary constructor.
     *
     * @param $cloudName
     * @param $key
     * @param $secret
     * @param $apiUrl
     * @param $certPath
     * @param Client $client
     */
    public function __construct($cloudName, $key, $secret, $apiUrl, $certPath, Client $client)
    {
        $this->cloudName = $cloudName;
        $this->key = $key;
        $this->secret = $secret;
        $this->apiUrl = $apiUrl;
        $this->client = $client;
        $this->certPath = $certPath;
    }

    public function get(Request $request): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.cloudinary.com/v1_1/mt-images/resources/image',
            [
                'verify' => $this->certPath,
                'auth' => [
                    $this->key,
                    $this->secret
                ]
            ]
        );

        $result = json_decode((string) $response->getBody(), true);

        return $result;
    }

    public function getImage(string $id): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.cloudinary.com/v1_1/mt-images/resources/image/upload/' . $id,
            [
                'verify' => $this->certPath,
                'auth' => [
                    $this->key,
                    $this->secret
                ]
            ]
        );

        $result = json_decode((string) $response->getBody(), true);

        return $result;
    }

    public function upload(Request $request): array
    {
        /** @var UploadedFile $picture */
        $picture = $request->files->get('picture');
        $timestamp = time();
        $signature = sha1('timestamp=' . $timestamp . $this->secret);

        $response =
            $this->client->request(
                'POST',
                'https://api.cloudinary.com/v1_1/mt-images/image/upload',
                [
                    'multipart' => [
                        [
                            'name' => 'timestamp',
                            'contents' => $timestamp,
                        ],
                        [
                            'name' => 'signature',
                            'contents' => $signature,
                        ],
                        [
                            'name' => 'api_key',
                            'contents' => $this->key,
                        ],
                        [
                            'name' => 'file',
                            'contents' => fopen($picture->getRealPath(), 'r'),
                            'filename' => $picture->getClientOriginalName(),
                        ],
                    ]
                ]
            )
        ;

        $result = json_decode((string) $response->getBody(), true);

        return $result;
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
