<?php

/* Este arquivo é gerado, NÃO EXITE-O DIRETAMENTE
Para gerá-lo, execute "php artisan app:make-routes"
ou "php artisan app:dev" para gerar todos os arquivos. */

\App\Http\Controllers\AddressesController::router();
\App\Http\Controllers\FailedJobsController::router();
\App\Http\Controllers\FilesController::router();
\App\Http\Controllers\LoteriaSorteiosController::router();
\App\Http\Controllers\MigrationsController::router();
\App\Http\Controllers\PasswordResetsController::router();
\App\Http\Controllers\PersonalAccessTokensController::router();
\App\Http\Controllers\SettingsController::router();
\App\Http\Controllers\UsersController::router();

return [
	'test' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['test', 'App\Http\Controllers\AppController@test'],
	],
	'login' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['login', 'App\Http\Controllers\AppController@login'],
	],
	'logout' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['logout', 'App\Http\Controllers\AppController@logout'],
	],
	'refresh' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['refresh', 'App\Http\Controllers\AppController@refresh'],
	],
	'me' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['me', 'App\Http\Controllers\AppController@me'],
	],
	'register' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['register', 'App\Http\Controllers\AppController@register'],
	],
	'endpoints' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['endpoints', 'App\Http\Controllers\AppController@endpoints'],
	],
	'password-reset-start' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-reset-start', 'App\Http\Controllers\AppController@passwordResetStart'],
	],
	'password-reset-change' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-reset-change', 'App\Http\Controllers\AppController@passwordResetChange'],
	],
	'email-test' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['email-test', 'App\Http\Controllers\AppController@emailTest'],
	],
	'emails-templates' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['emails-templates', 'App\Http\Controllers\AppController@emailsTemplates'],
	],
	'upload' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['upload', 'App\Http\Controllers\AppController@upload'],
	],
	'addresses_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['addresses/search', 'App\Http\Controllers\AddressesController@search'],
	],
	'addresses_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['addresses/find/{id}', 'App\Http\Controllers\AddressesController@find'],
	],
	'addresses_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['addresses/save', 'App\Http\Controllers\AddressesController@save'],
	],
	'addresses_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['addresses/valid', 'App\Http\Controllers\AddressesController@valid'],
	],
	'addresses_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['addresses/remove', 'App\Http\Controllers\AddressesController@remove'],
	],
	'addresses_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['addresses/clone/{id}', 'App\Http\Controllers\AddressesController@clone'],
	],
	'addresses_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['addresses/import', 'App\Http\Controllers\AddressesController@import'],
	],
	'addresses_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['addresses/export', 'App\Http\Controllers\AddressesController@export'],
	],
	'failed_jobs_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['failed-jobs/search', 'App\Http\Controllers\FailedJobsController@search'],
	],
	'failed_jobs_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['failed-jobs/find/{id}', 'App\Http\Controllers\FailedJobsController@find'],
	],
	'failed_jobs_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['failed-jobs/save', 'App\Http\Controllers\FailedJobsController@save'],
	],
	'failed_jobs_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['failed-jobs/valid', 'App\Http\Controllers\FailedJobsController@valid'],
	],
	'failed_jobs_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['failed-jobs/remove', 'App\Http\Controllers\FailedJobsController@remove'],
	],
	'failed_jobs_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['failed-jobs/clone/{id}', 'App\Http\Controllers\FailedJobsController@clone'],
	],
	'failed_jobs_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['failed-jobs/import', 'App\Http\Controllers\FailedJobsController@import'],
	],
	'failed_jobs_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['failed-jobs/export', 'App\Http\Controllers\FailedJobsController@export'],
	],
	'files_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['files/search', 'App\Http\Controllers\FilesController@search'],
	],
	'files_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['files/find/{id}', 'App\Http\Controllers\FilesController@find'],
	],
	'files_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['files/save', 'App\Http\Controllers\FilesController@save'],
	],
	'files_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['files/valid', 'App\Http\Controllers\FilesController@valid'],
	],
	'files_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['files/remove', 'App\Http\Controllers\FilesController@remove'],
	],
	'files_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['files/clone/{id}', 'App\Http\Controllers\FilesController@clone'],
	],
	'files_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['files/import', 'App\Http\Controllers\FilesController@import'],
	],
	'files_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['files/export', 'App\Http\Controllers\FilesController@export'],
	],
	'loteria_sorteios_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['loteria-sorteios/search', 'App\Http\Controllers\LoteriaSorteiosController@search'],
	],
	'loteria_sorteios_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['loteria-sorteios/find/{id}', 'App\Http\Controllers\LoteriaSorteiosController@find'],
	],
	'loteria_sorteios_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['loteria-sorteios/save', 'App\Http\Controllers\LoteriaSorteiosController@save'],
	],
	'loteria_sorteios_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['loteria-sorteios/valid', 'App\Http\Controllers\LoteriaSorteiosController@valid'],
	],
	'loteria_sorteios_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['loteria-sorteios/remove', 'App\Http\Controllers\LoteriaSorteiosController@remove'],
	],
	'loteria_sorteios_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['loteria-sorteios/clone/{id}', 'App\Http\Controllers\LoteriaSorteiosController@clone'],
	],
	'loteria_sorteios_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['loteria-sorteios/import', 'App\Http\Controllers\LoteriaSorteiosController@import'],
	],
	'loteria_sorteios_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['loteria-sorteios/export', 'App\Http\Controllers\LoteriaSorteiosController@export'],
	],
	'migrations_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['migrations/search', 'App\Http\Controllers\MigrationsController@search'],
	],
	'migrations_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['migrations/find/{id}', 'App\Http\Controllers\MigrationsController@find'],
	],
	'migrations_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['migrations/save', 'App\Http\Controllers\MigrationsController@save'],
	],
	'migrations_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['migrations/valid', 'App\Http\Controllers\MigrationsController@valid'],
	],
	'migrations_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['migrations/remove', 'App\Http\Controllers\MigrationsController@remove'],
	],
	'migrations_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['migrations/clone/{id}', 'App\Http\Controllers\MigrationsController@clone'],
	],
	'migrations_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['migrations/import', 'App\Http\Controllers\MigrationsController@import'],
	],
	'migrations_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['migrations/export', 'App\Http\Controllers\MigrationsController@export'],
	],
	'password_resets_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['password-resets/search', 'App\Http\Controllers\PasswordResetsController@search'],
	],
	'password_resets_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['password-resets/find/{id}', 'App\Http\Controllers\PasswordResetsController@find'],
	],
	'password_resets_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-resets/save', 'App\Http\Controllers\PasswordResetsController@save'],
	],
	'password_resets_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-resets/valid', 'App\Http\Controllers\PasswordResetsController@valid'],
	],
	'password_resets_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-resets/remove', 'App\Http\Controllers\PasswordResetsController@remove'],
	],
	'password_resets_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-resets/clone/{id}', 'App\Http\Controllers\PasswordResetsController@clone'],
	],
	'password_resets_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['password-resets/import', 'App\Http\Controllers\PasswordResetsController@import'],
	],
	'password_resets_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['password-resets/export', 'App\Http\Controllers\PasswordResetsController@export'],
	],
	'personal_access_tokens_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['personal-access-tokens/search', 'App\Http\Controllers\PersonalAccessTokensController@search'],
	],
	'personal_access_tokens_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['personal-access-tokens/find/{id}', 'App\Http\Controllers\PersonalAccessTokensController@find'],
	],
	'personal_access_tokens_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['personal-access-tokens/save', 'App\Http\Controllers\PersonalAccessTokensController@save'],
	],
	'personal_access_tokens_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['personal-access-tokens/valid', 'App\Http\Controllers\PersonalAccessTokensController@valid'],
	],
	'personal_access_tokens_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['personal-access-tokens/remove', 'App\Http\Controllers\PersonalAccessTokensController@remove'],
	],
	'personal_access_tokens_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['personal-access-tokens/clone/{id}', 'App\Http\Controllers\PersonalAccessTokensController@clone'],
	],
	'personal_access_tokens_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['personal-access-tokens/import', 'App\Http\Controllers\PersonalAccessTokensController@import'],
	],
	'personal_access_tokens_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['personal-access-tokens/export', 'App\Http\Controllers\PersonalAccessTokensController@export'],
	],
	'settings_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['settings/search', 'App\Http\Controllers\SettingsController@search'],
	],
	'settings_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['settings/find/{id}', 'App\Http\Controllers\SettingsController@find'],
	],
	'settings_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['settings/save', 'App\Http\Controllers\SettingsController@save'],
	],
	'settings_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['settings/valid', 'App\Http\Controllers\SettingsController@valid'],
	],
	'settings_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['settings/remove', 'App\Http\Controllers\SettingsController@remove'],
	],
	'settings_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['settings/clone/{id}', 'App\Http\Controllers\SettingsController@clone'],
	],
	'settings_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['settings/import', 'App\Http\Controllers\SettingsController@import'],
	],
	'settings_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['settings/export', 'App\Http\Controllers\SettingsController@export'],
	],
	'users_search' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['users/search', 'App\Http\Controllers\UsersController@search'],
	],
	'users_find' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['users/find/{id}', 'App\Http\Controllers\UsersController@find'],
	],
	'users_save' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['users/save', 'App\Http\Controllers\UsersController@save'],
	],
	'users_valid' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['users/valid', 'App\Http\Controllers\UsersController@valid'],
	],
	'users_remove' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['users/remove', 'App\Http\Controllers\UsersController@remove'],
	],
	'users_clone' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['users/clone/{id}', 'App\Http\Controllers\UsersController@clone'],
	],
	'users_import' => [
		'call' => ['Illuminate\Support\Facades\Route', 'post'],
		'params' => ['users/import', 'App\Http\Controllers\UsersController@import'],
	],
	'users_export' => [
		'call' => ['Illuminate\Support\Facades\Route', 'get'],
		'params' => ['users/export', 'App\Http\Controllers\UsersController@export'],
	],
];