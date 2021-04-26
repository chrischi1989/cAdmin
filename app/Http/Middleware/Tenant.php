<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use PDO;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*$database = DB::connection('mysql')
                      ->table('tenants_databases')
                      ->where('uuid', function($query) {
                          if(auth()->check() && !is_null(auth()->user()->tenant_uuid)) {
                              return auth()->user()->tenant_uuid;
                          }

                          return $query;
                      })->get();

        dd($database);*/

        /*config(['database.connections.' . $database->uuid => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => $database->hostname,
            'port' => $database->port,
            'database' => $database->database,
            'username' => $database->username,
            'password' => $database->password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ]]);

        session(['connection' => $database->uuid]);*/

        return $next($request);
    }
}
