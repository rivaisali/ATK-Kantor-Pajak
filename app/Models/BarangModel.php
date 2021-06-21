<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class BarangModel extends Model
{

    protected $table = 'barang';
    protected $allowedFields = [
        'kode_barang',
        'barcode',
        'nama_barang',
        'kategori_id',
        'tipe_id',
        'merk',
        'stok',

    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function findBarang($where, $filter)
    {
        $barang = $this
            ->asArray()
            ->where([$where => $filter])
            ->first();

        if (!$barang) {
            throw new Exception('Could not find barang for specified ID');
        }

        return $barang;
    }
}
