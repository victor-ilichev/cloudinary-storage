<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12.07.2018
 * Time: 13:02
 */

namespace Victor\FileStorageBundle\FileStorage;

use Symfony\Component\HttpFoundation\Request;

interface Storage
{
    public function get(Request $request): array;
    public function upload(Request $request): array;
    public function update(Request $request): array;
    public function delete(Request $request): array;
}