<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }


    /**
     * Show the latest listings
     * 
     * @return void
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
        ]);
    }

    /**
     * Show the create listing form
     * 
     * @return void
     */
    public function create()
    {
        loadView('listings/create');
    }

    /**
     * Show a single listing
     * 
     * @return void
     */
    public function show($params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing Not Found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Store listings
     * 
     * @return void
     */
    public function store()
    {
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

        // Filter the POST data to include only allowed fields
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        // Add user_id to the data
        $newListingData['user_id'] = 1; // Hardcoded user id for now

        // Sanitize the data
        $newListingData = array_map('sanitize', $newListingData);

        // Validate required fields
        $requiredFields = ['title', 'description', 'email', 'city', 'state'];

        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData,
            ]);
            exit;
        } else {
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newListingData as $field => $value) {
                // Convert an empty string to null
                if ($value === "") {
                    $newListingData[$field] = null;
                }

                $values[] = ':' . $field;
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

            $this->db->query($query, $newListingData);
            redirect('/listings');
        }
    }

    /**
     * Delete a listing
     * 
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];
        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing Not Found');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);
        redirect('/listings');
    }
}
