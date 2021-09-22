<?php

/* Para gerar este arquivo, execute 'php artisan app:db-export'
Para criar tabelas e colunas, execute 'php artisan app:db-import' */

return [
  'tables' => [
    'failed_jobs' => [
      'Name' => 'failed_jobs',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 0,
      'Avg_row_length' => 0,
      'Data_length' => 16384,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => 1,
      'Create_time' => '2021-09-17 19:42:13',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `failed_jobs` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `uuid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,  `connection` text COLLATE utf8_unicode_ci,  `queue` text COLLATE utf8_unicode_ci,  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'id' => [
          'Field' => 'id',
          'Type' => 'bigint(20) unsigned',
          'Null' => 'NO',
          'Key' => 'PRI',
          'Default' => NULL,
          'Extra' => 'auto_increment',
          'Query' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
        ],
        'uuid' => [
          'Field' => 'uuid',
          'Type' => 'varchar(255)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NULL',
        ],
        'connection' => [
          'Field' => 'connection',
          'Type' => 'text',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'text NULL DEFAULT NULL',
        ],
        'queue' => [
          'Field' => 'queue',
          'Type' => 'text',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'text NULL DEFAULT NULL',
        ],
        'payload' => [
          'Field' => 'payload',
          'Type' => 'longtext',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'longtext NOT NULL',
        ],
        'exception' => [
          'Field' => 'exception',
          'Type' => 'longtext',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'longtext NOT NULL',
        ],
        'failed_at' => [
          'Field' => 'failed_at',
          'Type' => 'timestamp',
          'Null' => 'NO',
          'Key' => '',
          'Default' => 'CURRENT_TIMESTAMP',
          'Extra' => '',
          'Query' => 'timestamp NOT NULL',
        ],
      ],
    ],
    'loteria_lotofacil' => [
      'Name' => 'loteria_lotofacil',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 2327,
      'Avg_row_length' => 112,
      'Data_length' => 262144,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => 2328,
      'Create_time' => '2021-09-21 19:24:39',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `loteria_lotofacil` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `number` int(11) DEFAULT NULL,  `numbers` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,  `date` datetime DEFAULT NULL,  `created_at` datetime DEFAULT NULL,  `updated_at` datetime DEFAULT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2328 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'id' => [
          'Field' => 'id',
          'Type' => 'bigint(20) unsigned',
          'Null' => 'NO',
          'Key' => 'PRI',
          'Default' => NULL,
          'Extra' => 'auto_increment',
          'Query' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
        ],
        'number' => [
          'Field' => 'number',
          'Type' => 'int(11)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'int(11) NULL',
        ],
        'numbers' => [
          'Field' => 'numbers',
          'Type' => 'varchar(50)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(50) NULL',
        ],
        'date' => [
          'Field' => 'date',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
        'created_at' => [
          'Field' => 'created_at',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
        'updated_at' => [
          'Field' => 'updated_at',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
      ],
    ],
    'loteria_megasena' => [
      'Name' => 'loteria_megasena',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 2410,
      'Avg_row_length' => 81,
      'Data_length' => 196608,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => 2411,
      'Create_time' => '2021-09-21 19:24:39',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `loteria_megasena` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `number` int(11) DEFAULT NULL,  `numbers` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,  `date` datetime DEFAULT NULL,  `created_at` datetime DEFAULT NULL,  `updated_at` datetime DEFAULT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2411 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'id' => [
          'Field' => 'id',
          'Type' => 'bigint(20) unsigned',
          'Null' => 'NO',
          'Key' => 'PRI',
          'Default' => NULL,
          'Extra' => 'auto_increment',
          'Query' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
        ],
        'number' => [
          'Field' => 'number',
          'Type' => 'int(11)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'int(11) NULL',
        ],
        'numbers' => [
          'Field' => 'numbers',
          'Type' => 'varchar(50)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(50) NULL',
        ],
        'date' => [
          'Field' => 'date',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
        'created_at' => [
          'Field' => 'created_at',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
        'updated_at' => [
          'Field' => 'updated_at',
          'Type' => 'datetime',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'datetime NULL DEFAULT NULL',
        ],
      ],
    ],
    'migrations' => [
      'Name' => 'migrations',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 2,
      'Avg_row_length' => 8192,
      'Data_length' => 16384,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => 4,
      'Create_time' => '2021-09-17 19:42:13',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `migrations` (  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `batch` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'id' => [
          'Field' => 'id',
          'Type' => 'int(10) unsigned',
          'Null' => 'NO',
          'Key' => 'PRI',
          'Default' => NULL,
          'Extra' => 'auto_increment',
          'Query' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
        ],
        'migration' => [
          'Field' => 'migration',
          'Type' => 'varchar(255)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NOT NULL',
        ],
        'batch' => [
          'Field' => 'batch',
          'Type' => 'int(11)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'int(11) NOT NULL',
        ],
      ],
    ],
    'password_resets' => [
      'Name' => 'password_resets',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 0,
      'Avg_row_length' => 0,
      'Data_length' => 16384,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => NULL,
      'Create_time' => '2021-09-17 19:42:13',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `password_resets` (  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `created_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'email' => [
          'Field' => 'email',
          'Type' => 'varchar(255)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NOT NULL',
        ],
        'token' => [
          'Field' => 'token',
          'Type' => 'varchar(255)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NOT NULL',
        ],
        'created_at' => [
          'Field' => 'created_at',
          'Type' => 'timestamp',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'timestamp NULL',
        ],
      ],
    ],
    'users' => [
      'Name' => 'users',
      'Engine' => 'InnoDB',
      'Version' => 10,
      'Row_format' => 'Dynamic',
      'Rows' => 0,
      'Avg_row_length' => 0,
      'Data_length' => 16384,
      'Max_data_length' => 0,
      'Index_length' => 0,
      'Data_free' => 0,
      'Auto_increment' => 2,
      'Create_time' => '2021-09-17 19:42:13',
      'Update_time' => NULL,
      'Check_time' => NULL,
      'Collation' => 'utf8_unicode_ci',
      'Checksum' => NULL,
      'Create_options' => '',
      'Comment' => '',
      'Create' => 'CREATE TABLE IF NOT EXISTS `users` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `email_verified_at` timestamp NULL DEFAULT NULL,  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,  `created_at` timestamp NULL DEFAULT NULL,  `updated_at` timestamp NULL DEFAULT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci',
      'Fields' => [
        'id' => [
          'Field' => 'id',
          'Type' => 'bigint(20) unsigned',
          'Null' => 'NO',
          'Key' => 'PRI',
          'Default' => NULL,
          'Extra' => 'auto_increment',
          'Query' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
        ],
        'name' => [
          'Field' => 'name',
          'Type' => 'varchar(255)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NULL',
        ],
        'email' => [
          'Field' => 'email',
          'Type' => 'varchar(255)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NOT NULL',
        ],
        'email_verified_at' => [
          'Field' => 'email_verified_at',
          'Type' => 'timestamp',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'timestamp NULL',
        ],
        'password' => [
          'Field' => 'password',
          'Type' => 'varchar(255)',
          'Null' => 'NO',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(255) NOT NULL',
        ],
        'remember_token' => [
          'Field' => 'remember_token',
          'Type' => 'varchar(100)',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'varchar(100) NULL',
        ],
        'created_at' => [
          'Field' => 'created_at',
          'Type' => 'timestamp',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'timestamp NULL',
        ],
        'updated_at' => [
          'Field' => 'updated_at',
          'Type' => 'timestamp',
          'Null' => 'YES',
          'Key' => '',
          'Default' => NULL,
          'Extra' => '',
          'Query' => 'timestamp NULL',
        ],
      ],
    ],
  ],
  'fks' => [],
];