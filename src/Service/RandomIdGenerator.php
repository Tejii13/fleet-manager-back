<?php

namespace App\Service;

class RandomIdGenerator
{
  public function generateRandomId($idLength)
  {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $length = strlen($characters);

    $id = '';

    for ($i = 0; strlen($id) < $idLength; $i++) {
        $id .= $characters[mt_rand(0, $length - 1)];
    }

    return $id;
  }
}
