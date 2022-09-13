<?php

if (!function_exists('generate_public_private_keys')) {
    function generate_public_private_keys()
    {
        $config = [
            'digest_alg' => 'RS256',
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];

        // Create the private and public key
        $res = openssl_pkey_new($config);

        // Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);

        // Extract the public key from $res to $pubKey
        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey['key'];
        
        return [
            'public_key' => base64_encode($pubKey),
            'private_key' => base64_encode($privKey),
        ];
    }
}