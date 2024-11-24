<?php

function isValidSignature($signature)
{
    $username = env('USERNAME_AUTH', 'default_username');
    $password = env('PASSWORD_AUTH', 'default_password');

    $now = now();
    $YYYY = $now->format('Y');
    $MM = $now->format('m');
    $DD = $now->format('d');

    // Create the expected signature
    $expectedSignature = sha1($YYYY . $username . $MM . $password . $DD); // Adjust as per your actual hashing logic

    // Compare the provided signature with the expected signature
    return hash_equals($expectedSignature, $signature);
}
