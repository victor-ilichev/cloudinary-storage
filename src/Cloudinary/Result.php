<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 23.07.2018
 * Time: 9:01
 */

namespace Victor\CloudinaryStorageBundle\Cloudinary;

class Result
{
    const SUCCESS_CODE = 0;
    const ERROR_CODE = 1;

    /**
     * @var int
     */
    private $code;
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $data;

    public function __construct(int $code, string $message = '', array $data = [])
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
    }

    public function isSuccess()
    {
        return $this->code === self::SUCCESS_CODE;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
