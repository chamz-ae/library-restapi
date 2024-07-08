<?php

use PharIo\Manifest\Library;

class BukuLibrary extends Library
{
    // ... metode string yang ada

    public function getAllBuku()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM buku');
        $buku = $query->getResultArray();

        return $buku;
    }

    public function getBukuById($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM buku WHERE id = $id");
        $buku = $query->getRowArray();

        return $buku;
    }

    public function createBuku($data)
    {
        $db = \Config\Database::connect();
        $judul = $data['judul'];
        $penulis = $data['penulis'];
        $penerbit = $data['penerbit'];
        $tahun_terbit = $data['tahun_terbit'];
        $jumlah_halaman = $data['jumlah_halaman'];
        $deskripsi = $data['deskripsi'];

        $query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, jumlah_halaman, deskripsi) VALUES ('$judul', '$penulis', '$penerbit', $tahun_terbit, $jumlah_halaman, '$deskripsi')";
        $db->query($query);

        return true;
    }

    public function updateBuku($id, $data)
    {
        $db = \Config\Database::connect();
        $judul = $data['judul'];
        $penulis = $data['penulis'];
        $penerbit = $data['penerbit'];
        $tahun_terbit = $data['tahun_terbit'];
        $jumlah_halaman = $data['jumlah_halaman'];
        $deskripsi = $data['deskripsi'];

        $query = "UPDATE buku SET judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun_terbit = $tahun_terbit, jumlah_halaman = $jumlah_halaman, deskripsi = '$deskripsi' WHERE id = $id";
        $db->query($query);

        return true;
    }

    public function deleteBuku($id)
    {
        $db = \Config\Database::connect();
        $query = "DELETE FROM buku WHERE id = $id";
        $db->query($query);

        return true;
    }
}