<?php

namespace Modules\Setting\Tasks;

use Jackiedo\DotenvEditor\DotenvEditor;

/**
 * Class UpdateEnvTask
 * @package Modules\Setting\Tasks
 */
class UpdateEnvTask
{
    /**
     * @var DotenvEditor
     */
    private $env;

    /**
     * UpdateEnvTask constructor.
     * @param DotenvEditor $dotenvEditor
     */
    public function __construct(DotenvEditor $dotenvEditor)
    {
        $this->env = $dotenvEditor;
    }

    /**
     * @param array $data
     * @return DotenvEditor
     */
    public function run($data = []) {
        $this->env->setKeys([
            [
                'key'   => 'APP_NAME',
                'value' => $data['APP_NAME'] ?? env('APP_NAME'),
            ],
            [
                'key'   => 'APP_DEBUG',
                'value' => $data['APP_DEBUG'] ?? env('APP_DEBUG'),
            ],
            [
                'key'   => 'APP_URL',
                'value' => $data['APP_URL'] ?? env('APP_URL'),
            ],
            [
                'key'   => 'APP_SUPPORT',
                'value' => $data['APP_SUPPORT'] ?? env('APP_SUPPORT'),
            ],
            [
                'key'   => 'DB_CONNECTION',
                'value' => $data['DB_CONNECTION'] ?? env('DB_CONNECTION'),
            ],
            [
                'key'   => 'DB_HOST',
                'value' => $data['DB_HOST'] ?? env('DB_HOST'),
            ],
            [
                'key'   => 'DB_PORT',
                'value' => $data['DB_PORT'] ?? '3306'
            ],
            [
                'key'   => 'DB_DATABASE',
                'value' => $data['DB_DATABASE'] ?? env('DB_DATABASE'),
            ],
            [
                'key'   => 'DB_USERNAME',
                'value' => $data['DB_USERNAME'] ?? env('DB_USERNAME'),
            ],
            [
                'key'   => 'DB_PASSWORD',
                'value' => $data['DB_PASSWORD'] ?? env('DB_PASSWORD'),
            ],
        ]);

        return $this->env->save();
    }
}
