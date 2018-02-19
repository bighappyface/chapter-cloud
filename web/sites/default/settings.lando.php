<?php
/**
 * @file
 * Lando settings.
 */

// Configure the database if on Lando
if (isset($_SERVER['LANDO'])) {

  // Override the PLATFORM_RELATIONSHIPS env var.
  $_ENV['PLATFORM_RELATIONSHIPS'] = [
    'database' => [
      (object) [
        'scheme' => 'mysql',
        'host' => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'path' => $_ENV['DB_NAME'],
        'port' => $_ENV['DB_PORT'],
        'query' => (object) [
          'is_master' => TRUE,
        ],
      ]
    ]
  ];
  $_ENV['PLATFORM_RELATIONSHIPS'] = base64_encode(json_encode($_ENV['PLATFORM_RELATIONSHIPS']));
  $settings['hash_salt'] = $_ENV['PLATFORM_RELATIONSHIPS'];

}
