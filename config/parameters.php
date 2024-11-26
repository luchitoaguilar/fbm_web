
<?php

return [
    'org_name' => 'COFADENA',
    'web_page' => 'www.cofadena.gob.bo',
    'date_format' => env('DATE_FORMAT', 'Y-m-d H:i:s'),
    'date_format_insert' => env('DATE_FORMAT_INSERT', 'Y-m-d H:i:s'),
    'app_url' => env('APP_URL','http://localhost:8000/'),
    'generated_files' => env('APP_GENERATED_FILES','http://localhost:8000/tmp/'),
    'url_logo' => env('URL_LOGO','http://lcoalhost:8000/images/logo_cofadena.png'),
    'auth_office365' => env('O365_LOGIN', true),
    'auth_2step' => env('AUTH_2STEP', true),
    'auth_google_recaptcha' => env('GOOGLE_RECAPTCHA', false),
    'storage_path' => env('STORAGE_PATH', storage_path()),
    'public_path' => env('PUBLIC_PATH', public_path()),
    'valid_domains' => env('VALID_DOMAINS', 'gmail.com,yahoo.com,hotmail.com,yahoo.es,outlook.com,cofadena.gob.bo'),
    'codigo_cifrado' => env('CODIGO_CIFRADO', 'C0f4d3n4_'),
    'vector_cifrado' => env('VECTOR_CIFRADO', 'e16ce913a20dadb8')
];
