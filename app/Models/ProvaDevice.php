<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdaDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
        'otac',
        'key_status',
        'key_expiry',
        'device_status',
        'device_expiry',
    ];

    /**
     * Generate public key and private key, and then save
     *
     */
    public function save_with_key()
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
        $this->private_key = base64_encode($privKey);
        $this->public_key = base64_encode($pubKey);

        return $this->save();
    }
}
