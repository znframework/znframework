<?php namespace ZN\CryptoGraphy\Drivers;

use ZN\CryptoGraphy\CryptoMapping;
use Converter, Arrays;

class McryptDriver extends CryptoMapping
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Encrypt
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function encrypt($data, $settings)
    {
        $set    = $this->_settings($settings);
        $encode = trim(mcrypt_encrypt($set->cipher, $set->key, $data, $set->mode, $set->iv));

        return base64_encode($encode);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decrypt
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param array  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrypt($data, $settings)
    {
        $set    = $this->_settings($settings);
        $data   = base64_decode($data);

        return trim(mcrypt_decrypt($set->cipher, $set->key, trim($data), $set->mode, $set->iv));
    }

    //--------------------------------------------------------------------------------------------------------
    // Keygen
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $length
    //
    //--------------------------------------------------------------------------------------------------------
    public function keygen($length)
    {
        return mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected
    //--------------------------------------------------------------------------------------------------------
    private function keySize($cipher)
    {
        $cipher  = strtolower($cipher);
        $ciphers =
        [
            'des'                                           => 8,
            'cast_128|rijndael_128|serpent|twofish|xtea'    => 16,
            '3des|rijndael_192|saferplus|tripledes'         => 24,
            'cast_256|gost|loki97|rijndael_256'             => 32
        ];

        $ciphers = Arrays::multikey($ciphers);

        if( ! isset($ciphers[$cipher]) )
        {
            $ciphers[$cipher] = 8;
        }

        return mb_substr(hash('md5', PROJECT_CONFIG['key']), 0, $ciphers[$cipher]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected
    //--------------------------------------------------------------------------------------------------------
    protected function vectorSize($mode, $cipher)
    {
        $mode   = strtolower($mode);
        $cipher = strtolower($cipher);
        $modes  =
        [
            'cbc'                                                       => 8,
            'cast_256|loki97|rijndael_128|saferplus|serpent|twofish'    => 16,
            'rijndael_192'                                              => 24,
            'rijndael_256'                                              => 32,
        ];

        $modes = Arrays::multikey($modes);
        $mode  = isset($modes[$mode]) ? $modes[$mode] : 8;

        if( ! empty($cipher) )
        {
            $mode = isset($modes[$cipher]) ? $modes[$cipher] : $mode;
        }

        return mb_substr(hash('sha1', PROJECT_CONFIG['key']), 0, $mode);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array settings
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _settings($settings)
    {
        $cipher = $settings['cipher'] ?? 'des';
        $cipher = str_replace('-', '_', $cipher);

        $key    = $settings['key']    ?? $this->keySize($cipher);
        $mode   = $settings['mode']   ?? 'cbc';
        $iv     = $settings['vector'] ?? $this->vectorSize($mode, $cipher);

        $cipher = Converter::toConstant($cipher, 'MCRYPT_');
        $mode   = Converter::toConstant($mode, 'MCRYPT_MODE_');

        return (object)
        [
            'key'    => $key,
            'mode'   => $mode,
            'iv'     => $iv,
            'cipher' => $cipher
        ];
    }
}
