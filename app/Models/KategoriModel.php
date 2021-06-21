<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class KategoriModel extends Model
{

    protected $table = 'kategori';
    protected $allowedFields = [
        'kategori',
        'keterangan',

    ];

    public function findKategori($id)
    {
        $kategori = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$kategori) {
            throw new Exception('Could not find kategori for specified ID');
        }

        return $kategori;
    }
}
