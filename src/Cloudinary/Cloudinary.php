<?php

/**
 * @package Victor\FileStorageBundle\Cloudinary
 */
namespace Victor\FileStorageBundle\Cloudinary;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Victor\FileStorageBundle\Exception\JsonParseException;
use Victor\FileStorageBundle\Exception\UploadedFileNotFoundException;

/**
 * Class Cloudinary
 */
class Cloudinary
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Config
     */
    private $config;

    /**
     * Cloudinary constructor.
     *
     * @param Config $config
     * @param Client $client
     */
    public function __construct(Config $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    public function get(): Result
    {
        try {
            $response = $this->client->request(
                'GET',
                sprintf('%s/%s', $this->config->get('url'),'resources/image'),
                [
                    'verify' => $this->config->get('cacert.pem'),
                    'auth' => [
                        $this->config->get('key'),
                        $this->config->get('secret')
                    ]
                ]
            );

            $data = json_decode((string) $response->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new JsonParseException('', json_last_error());
            }

            $result = new Result(Result::SUCCESS_CODE, $data);

        } catch (GuzzleException $exception) {
            $result = new Result(Result::ERROR_CODE);
        } catch (JsonParseException $exception) {
            $result = new Result(Result::ERROR_CODE);
        }

        return $result;
    }

    /**
     * @param string $id
     *
     * @return Result
     */
    public function getImage(string $id): Result
    {
        try {
            $response = $this->client->request(
                'GET',
                'https://api.cloudinary.com/v1_1/mt-images/resources/image/upload/' . $id,
                [
                    'verify' => $this->config->get('cacert.pem'),
                    'auth' => [
                        $this->config->get('key'),
                        $this->config->get('secret')
                    ]
                ]
            );

            $data = json_decode((string) $response->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new JsonParseException('', json_last_error());
            }

            $result = new Result(Result::SUCCESS_CODE, $data);

        } catch (GuzzleException $exception) {
            $result = new Result(Result::ERROR_CODE, $exception->getMessage());
        } catch (JsonParseException $exception) {
            $result = new Result(Result::ERROR_CODE, $exception->getMessage());
        }

        return $result;
    }

    public function upload(UploadedFile $file): Result
    {
        $timestamp = time();
        $signature = sha1('timestamp=' . $timestamp . $this->config->get('secret'));

        try {

            if (!is_a($file, File::class)) {
                throw new UploadedFileNotFoundException();
            }

            $response =
                $this->client->request(
                    'POST',
                    sprintf('%s/%s', $this->config->get('url'),'image/upload'),
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
                                'contents' => $this->config->get('key'),
                            ],
                            [
                                'name' => 'file',
                                'contents' => fopen($file->getRealPath(), 'r'),
                                'filename' => $file->getClientOriginalName(),
                            ],
                        ]
                    ]
                )
            ;

            $data = json_decode((string) $response->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new JsonParseException('', json_last_error());
            }

            $result = new Result(Result::SUCCESS_CODE, 'sucess', $data);

        } catch (GuzzleException $exception) {
            $result = new Result(Result::ERROR_CODE, $exception->getMessage());
        } catch (JsonParseException $exception) {
            $result = new Result(Result::ERROR_CODE, $exception->getMessage());
        } catch (UploadedFileNotFoundException $exception) {
            $result = new Result(Result::ERROR_CODE, $exception->getMessage());
        }

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
