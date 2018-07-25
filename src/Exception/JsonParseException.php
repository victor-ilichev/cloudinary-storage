<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 23.07.2018
 * Time: 8:47
 */

namespace Victor\CloudinaryStorageBundle\Exception;

use Throwable;

class JsonParseException extends FileStorageException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = $this->resolveErrorMessageByCode($code);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $code
     *
     * @return string
     */
    private function resolveErrorMessageByCode($code)
    {
        switch ($code) {
            case JSON_ERROR_NONE:
                $message = ' - Ошибок нет';
                break;
            case JSON_ERROR_DEPTH:
                $message = ' - Достигнута максимальная глубина стека';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $message = ' - Некорректные разряды или несоответствие режимов';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $message = ' - Некорректный управляющий символ';
                break;
            case JSON_ERROR_SYNTAX:
                $message = ' - Синтаксическая ошибка, некорректный JSON';
                break;
            case JSON_ERROR_UTF8:
                $message = ' - Некорректные символы UTF-8, возможно неверно закодирован';
                break;
            default:
                $message = ' - Неизвестная ошибка';
        }

        return $message;
    }
}
