<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show the login page
     * 
     * @return void
     */
    public function login()
    {
        loadView('users/login', [
            'errors' => $errors ?? [],
        ]);
    }

    /**
     * Show the registration page
     * 
     * @return void
     */
    public function create()
    {
        loadView('users/create', [
            'errors' => $errors ?? [],
        ]);
    }

    /**
     * Store a new user
     * 
     * @return void
     */
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];
        $errors = [];

        // Validate email
        if (!Validation::email($email)) {
            $errors['email'] = "Please enter a valid email address";
        }

        // Validate name
        if (!Validation::string($name, 1, 50)) {
            $errors['name'] = "Please enter a valid name";
        }

        // Validate password length
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = "Password must be at least 6 characters long";
        }

        // Validate password match
        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = "Passwords do not match";
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                ]
            ]);
            exit;
        }

        // Check if account exists
        $params = [
            'email' => $email,
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'That email already exists';
            loadView('users/create', [
                'errors' => $errors,
            ]);
            exit;
        }

        // Create account
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);

        // Get the user id
        $userId = $this->db->conn->lastInsertId();

        redirect('/listings');
    }
}
