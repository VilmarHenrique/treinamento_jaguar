<?php

  class SoapClientSSL extends SoapClient
  {
    public function __construct($wsdl, $options = array(), $workaround = array())
    {
      if (!is_null($workaround) && sizeof($workaround) == 0)
      {
        // bash$ openssl ciphers -v | grep 'TLSv1.2' | cut -d ' ' -f 1 | tr "\n" ':'
        // bash$ openssl ciphers
        $ciphers = trim(shell_exec("openssl ciphers 2>/dev/null"));

        if (!$ciphers)
        {
          $ciphers = 'ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-SHA384:' .
                     'ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:SRP-DSS-AES-256-CBC-SHA:' .
                     'SRP-RSA-AES-256-CBC-SHA:DHE-DSS-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-SHA256:' .
                     'DHE-DSS-AES256-SHA256:DHE-RSA-AES256-SHA:DHE-DSS-AES256-SHA:DHE-RSA-CAMELLIA256-SHA:' .
                     'DHE-DSS-CAMELLIA256-SHA:ECDH-RSA-AES256-GCM-SHA384:ECDH-ECDSA-AES256-GCM-SHA384:' .
                     'ECDH-RSA-AES256-SHA384:ECDH-ECDSA-AES256-SHA384:ECDH-RSA-AES256-SHA:ECDH-ECDSA-AES256-SHA:' .
                     'AES256-GCM-SHA384:AES256-SHA256:AES256-SHA:CAMELLIA256-SHA:PSK-AES256-CBC-SHA:' .
                     'ECDHE-RSA-DES-CBC3-SHA:ECDHE-ECDSA-DES-CBC3-SHA:SRP-DSS-3DES-EDE-CBC-SHA:SRP-RSA-3DES-EDE-CBC-SHA:' .
                     'EDH-RSA-DES-CBC3-SHA:EDH-DSS-DES-CBC3-SHA:ECDH-RSA-DES-CBC3-SHA:ECDH-ECDSA-DES-CBC3-SHA:' .
                     'DES-CBC3-SHA:PSK-3DES-EDE-CBC-SHA:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:' .
                     'ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:' .
                     'SRP-DSS-AES-128-CBC-SHA:SRP-RSA-AES-128-CBC-SHA:DHE-DSS-AES128-GCM-SHA256:DHE-RSA-AES128-GCM-SHA256:' .
                     'DHE-RSA-AES128-SHA256:DHE-DSS-AES128-SHA256:DHE-RSA-AES128-SHA:DHE-DSS-AES128-SHA:' .
                     'DHE-RSA-SEED-SHA:DHE-DSS-SEED-SHA:DHE-RSA-CAMELLIA128-SHA:DHE-DSS-CAMELLIA128-SHA:' .
                     'ECDH-RSA-AES128-GCM-SHA256:ECDH-ECDSA-AES128-GCM-SHA256:ECDH-RSA-AES128-SHA256:' .
                     'ECDH-ECDSA-AES128-SHA256:ECDH-RSA-AES128-SHA:ECDH-ECDSA-AES128-SHA:AES128-GCM-SHA256:' .
                     'AES128-SHA256:AES128-SHA:SEED-SHA:CAMELLIA128-SHA:PSK-AES128-CBC-SHA:ECDHE-RSA-RC4-SHA:' .
                     'ECDHE-ECDSA-RC4-SHA:ECDH-RSA-RC4-SHA:ECDH-ECDSA-RC4-SHA:RC4-SHA:RC4-MD5:PSK-RC4-SHA:' .
                     'EDH-RSA-DES-CBC-SHA:EDH-DSS-DES-CBC-SHA:DES-CBC-SHA:EXP-EDH-RSA-DES-CBC-SHA:' .
                     'EXP-EDH-DSS-DES-CBC-SHA:EXP-DES-CBC-SHA:EXP-RC2-CBC-MD5:EXP-RC4-MD5';
        }

        $workaround = array(
          'verifypeer'         => false,
          'verifyhost'         => false,
          'soap_version'       => SOAP_1_2,
          'trace'              => 1,
          'exceptions'         => 1,
          'connection_timeout' => 180,
          'stream_context'     =>
            stream_context_create(
              array(
                'ssl' => array(
                  'crypto_method'    => STREAM_CRYPTO_METHOD_ANY_CLIENT,
                  'ciphers'          => $ciphers,
                  'verify_peer'      => false,
                  'verify_peer_name' => false
                )
              )
            )
        );

        $workaround = array_diff_key($workaround, $options);
      }

      parent::SoapClient($wsdl, array_merge($options, $workaround));
    }
  }