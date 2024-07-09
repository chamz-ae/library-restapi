<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;

class BookController extends ResourceController
{
    protected $db;
    protected $format;

    public function __construct()
    {
        
        $this->db = \Config\Database::connect();

    }

    public function index()
    {
        $builder = $this->db->table('book');
        $query = $builder->get();
        $books = $query->getResultArray();
        return ($books);
    }

    public function show($id = null)
    {
        $builder = $this->db->table('book');
        $query = $builder->getWhere(['id' => $id]);
        $book = $query->getRowArray();
        if ($book) {
            return ($book);
        } else {
            return ('Book not found');
        }
    }

    public function create()
    {
        $data = $this->request->getRawInput(); // Get raw JSON data

        // Validate input data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'book_title' => 'required',
            'publisher' => 'required'
        ], [
            'book_title' => [
                'is_not_unique' => 'The book field must contain a previously existing value in the database.'
            ]
        ]);

        if (!$validation->run($data)) {
            return ($validation->getErrors());
        }

        // Prepare data for insertion
        $bookData = [
            'book_title' => $data['book_title'],
            'publisher' => $data['publisher']
        ];

        // Insert book using Query Builder
        $builder = $this->db->table('book');
        if ($builder->insert($bookData)) {
            $bookData['id'] = $this->db->insertID(); // Get the inserted book ID
            return ($bookData);
        } else {
            return ('Failed to create book');
        }
    }

    // ... (update and delete methods remain the same)
}
