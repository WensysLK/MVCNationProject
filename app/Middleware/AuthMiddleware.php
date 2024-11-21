<?php

namespace Middleware;

class AuthMiddleware
{
    public static function handle()
    {
        session_start();

        // Check if the user is authenticated
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if session is expired
            header('Location: /login');
            exit();
        }
    }

}