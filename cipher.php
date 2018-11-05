<?php

function encode($plainText, $secretKey)
{
    //$secretKey = "123~!@#$%^&*()_+";
    $cipherText = "RjdBRjc2MkQ0M0ZGQzFCN1wf2tPgdC7faBdNENaIImlt43138dxlJiqTpPfwdBO7LQXrgEVDCv01ZzOPVPXaE1NwHQcHeFVvlXPhFO+czyPpX/13PoYb+rJOXmNdxZLT";
    //$plainText = "ba0a44a5e1523d1b1eb4ef8466b45556b7c490cc3e74e34d7a7ac1427cfde85e";
    $INIT_VECTOR_LENGTH = 16;
    $CIPHER = "AES-128-CBC";

    $initVector = bin2hex(openssl_random_pseudo_bytes($INIT_VECTOR_LENGTH / 2));
// Encrypt input text
    $raw = openssl_encrypt(
        $plainText,
        $CIPHER,
        $secretKey,
        1,
        $initVector
    );
// Return base64-encoded string: initVector + encrypted result
    $result = base64_encode($initVector . $raw);

    echo $result;
}

function decode($cipherText, $secretKey)
{
    //$secretKey = "123~!@#$%^&*()_+";
    //$cipherText = "QkVCQzI1Q0UyOTM5NEUzMdUS5x3gGE//ik0h655LiFUa4l/qrqtsjF9fEprtEjGZqQhDK+9IMQGvT7NHYFiqlPUADs6bTGTsZljsI/Vf6K2kYah24uvSR+xnBHdzjY5f";
    $INIT_VECTOR_LENGTH = 16;
    $CIPHER = "AES-128-CBC";

    $encoded = base64_decode($cipherText);
// Slice initialization vector
    $initVector = substr($encoded, 0, $INIT_VECTOR_LENGTH);
// Slice encoded data
    $data = substr($encoded, $INIT_VECTOR_LENGTH);
// Trying to get decrypted text
    $decoded = openssl_decrypt(
        $data,
        $CIPHER,
        $secretKey,
        1,
        $initVector
    );
    print_r($decoded);
    //echo "heello";
    echo $decoded."\n";
}

//$secretKey = "123456789";
$secretKey = "123~!@#$%^&*()_+";
$cipherText = "QUFGMDY5MTZFNTNBMjIyMfoIwrNhkVoksqFzfs9scZVIrVbd1KCbOEgzbSQ0UizFUl/P4mvO5jYMPidH4OUnFJ5c7P0q48pf2lIQgRHapidTQuR8YPuEJM5qXkpx0DS2";
$plainText = "144d31eec6e94e2d0975dd22e59275ad7980633078fa06190622582ab260e3f";
decode($cipherText, $secretKey);
//encode($plainText, $secretKey);