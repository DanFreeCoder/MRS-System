<?php

class Encryptor
{
    protected  $secretKey = '1nnoGroupMRS2023';

    public  function decrypt_secretKey($id)
    {
        // Retrieve the encrypted ID from the URL parameter
        $encodedEncryptedId = $id;
        // Decrypt the encrypted ID using the same secret key
        $encryptedId = base64_decode(urldecode($encodedEncryptedId));
        $decryptedId = openssl_decrypt($encryptedId, 'aes-256-cbc', $this->secretKey, 0, $this->secretKey);
        return $decryptedId;
    }

    public function encrypt_secreKey($id)
    {
        $encryptedId = base64_encode(openssl_encrypt($id, 'aes-256-cbc', $this->secretKey, 0, $this->secretKey));
        return $encryptedId;
    }
}
