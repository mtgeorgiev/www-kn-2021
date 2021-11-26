<?php

class Bootstrap {

    public static function init(): void {
        self::registerExceptionHandlers();
        self::registerClassLoader();
    }

    private static function registerExceptionHandlers() {
        set_exception_handler(function ($e) {

            var_dump($e);

            $error = [
                'error' => true
            ];

            if ($e instanceof RepositoryException) {
                $error['message'] = 'Exception with database operation: ' . $e->getMessage();
            }

            echo json_encode($error);
        });
    }

    private function registerClassLoader() {

        spl_autoload_register(function($className) {
            if (file_exists('../libs/' . $className . '.php')) {
                require_once '../libs/' . $className . '.php';
            } elseif (file_exists('../libs/db/' . $className . '.php')) {
                require_once '../libs/db/' . $className . '.php';
            } elseif (file_exists('../libs/exceptions/' . $className . '.php')) {
                require_once '../libs/exceptions' . $className . '.php';
            }
        });

    }

}
