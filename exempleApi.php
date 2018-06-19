<?php


$name = 'orchid';
$message = [
    'firstName'    => 'Иван',
    'lastName'     => 'Иванов',
    'address'      => [
        "streetAddress" => "Московское ш., 101, кв.103",
        "city"          => "Ленинград",
        "postalCode"    => "101101",
    ],
    'phoneNumbers' => [
        "812 123-1234",
        "916 123-4567",
    ],
];
$token = '$2y$10$C.3HLUP/9kSHRGJvFOy0B.Q7QTT1w3DH2Uz0py235lVnfm5xPKuoW';


/*
 *
 */
$url = 'http://localhost:8000/api/logs';
$result = file_get_contents($url, false, stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query([
            'name'    => $name,
            'message' => '{"user":{"name":"Dariana","lastName":"Kihn","address":{"streetAddress":"618 Kade Island Apt. 277","city":"West Hubert","country":"Brunei Darussalam","postcode":"15220"},"creditCardNumber":"2378601700533297"},"company":{"company":"Howell, Kulas and Mraz","companyEmail":"lafayette.johnson@schowalter.com","companySuffix":"Inc"},"hardware":{"macAddress":"AF:ED:24:0E:7E:AB","userAgent":"Mozilla\/5.0 (compatible; MSIE 6.0; Windows NT 5.2; Trident\/5.0)","languageCode":"sm","latitude":51.507124}}',
            'token'   => $token,
        ]),
    ],
]));

echo $result;