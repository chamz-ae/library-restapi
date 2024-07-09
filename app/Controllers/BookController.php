<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BookController extends ResourceController
{
    protected $db = \Config\Database::connect();
    protected $format = 'json';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('book');
        $query = $builder->get();
        $books = $query->getResultArray();
        return $this->respond($books);
    }

    public function show($id = null)
    {
        $builder = $this->db->table('book');
        $query = $builder->getWhere(['id' => $id]);
        $book = $query->getRowArray();
        if ($book) {
            return $this->respond($book);
        } else {
            return $this->failNotFound('Book not found');
        }
    }

    public function create()
    {
        $data = $this->request->getRawInput(); // Get raw JSON data

        // Validate input data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'category_id' => 'required|is_not_unique[category.id]'
        ], [
            'category_id' => [
                'is_not_unique' => 'The category_id field must contain a previously existing value in the database.'
            ]
        ]);

        if (!$validation->run($data)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        // Prepare data for insertion
        $bookData = [
            'title' => $data['title'],
            'category_id' => $data['category_id']
        ];

        // Insert book using Query Builder
        $builder = $this->db->table('book');
        if ($builder->insert($bookData)) {
            $bookData['id'] = $this->db->insertID(); // Get the inserted book ID
            return $this->respondCreated($bookData);
        } else {
            return $this->fail('Failed to create book');
        }
    }

    // ... (update and delete methods remain the same)
}
