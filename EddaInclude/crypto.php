<?php
  /*
  This file is part of edda.

  edda is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  edda is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with edda.  If not, see <http://www.gnu.org/licenses/>.
  */

include('Crypt/RSA.php');
date_default_timezone_set('Europe/Berlin');

function getRnd ($length)
  {
  $cstrong = false;

  while ($cstrong == false)
    {
    $bytes = openssl_random_pseudo_bytes($length, $cstrong);
    }
  return($bytes);
  }

function encryptChallenge($publicKey, $rnd)
  {
  $rsa = new Crypt_RSA();

  $rsa->loadKey($publicKey);
  $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
  $ciphertext = $rsa->encrypt($rnd);
  
  return(base64_encode($ciphertext));
  }
?>
