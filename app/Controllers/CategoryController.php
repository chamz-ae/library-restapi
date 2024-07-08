<?php namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class CategoryController extends Controller
{
    public function addCategory($category_id, $category_name)
    {
        $db = Database::connect();

        // Periksa apakah category_id ada
        $query = $db->query("SELECT * FROM categories WHERE category_id = ?", [$category_id]);
        $result = $query->getResult();

        if (empty($result)) {
            // Tambahkan entri baru jika category_id tidak ada
            $db->query("INSERT INTO categories (category_id, category_name) VALUES (?, ?)", [$category_id, $category_name]);
            echo "Category added successfully!";
        } else {
            echo "Category already exists!";
        }
    }
}
