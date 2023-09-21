<?php

namespace App\Service;

class RandomIdGenerator
{
  public function generateRandomId($userId)
  {
    $rand1 = mt_rand(100000000, 999999999);

    $rand1 *= $userId;

    $rand2 = mt_rand(100000000, 999999999);

    $number = $rand1 * $rand2;

    $number = sqrt($number);

    $stringNumber = strval($number);

    $result = str_replace(".", "", $stringNumber);

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $length = strlen($characters);

    $id = '';

    while (strlen($id) < 50) {

      if (is_numeric($result)) {
        $id .= $characters[mt_rand(0, $length - 1)];
      }
    }

    $id = substr($id, 0, 50);

    return $id;
  }
}
