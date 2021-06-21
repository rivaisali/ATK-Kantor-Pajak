<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class TipeModel extends Model
{

    protected $table = 'tipe';
    protected $allowedFields = [
        'kategori_id',
        'tipe',

    ];

    public function findTipe($id)
    {
        $tipe = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$tipe) {
            throw new Exception('Could not find kategori for specified ID');
        }

        return $tipe;
    }
}
