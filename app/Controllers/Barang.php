<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Barang extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new BarangModel();

    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return Response
     */
    public function index()
    {

        return $this->getResponse(
            [
                'message' => 'retrieved successfully',
                'data' => $this->model->findAll(),
            ]
        );

    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($kode_barang = null)
    {
        try {

            $barang = $this->model->findBarang('kode_barang', $kode_barang);

            return $this->getResponse(
                [
                    'message' => 'retrieved successfully',
                    'barang' => $barang,
                ]
            );

        } catch (Exception $e) {

            return $this->getResponse(
                [
                    'message' => 'Could not find for specified ID',
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }

    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'kode_barang' => 'required',
            'barcode' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'tipe_id' => 'required',
            'merk' => 'required',
            'stok' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $kode_barang = $input['kode_barang'];
        $barcode = $input['barcode'];
        $nama_barang = $input['nama_barang'];
        $kategori_id = $input['kategori_id'];
        $tipe_id = $input['tipe_id'];
        $merk = $input['merk'];
        $stok = $input['stok'];

        $data = $this->model->save($input);

        return $this->getResponse(
            [
                'data' => $data,
                'message' => 'added successfully',
            ]
        );

    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($kode_barang = null)
    {
        try {

            $this->model->findBarang('kode_barang', $kode_barang);

            $input = $this->getRequestInput($this->request);

            $this->model->where('kode_barang', $kode_barang)->set($input)->update();

            $barang = $this->model->findBarang('kode_barang', $kode_barang);

            return $this->getResponse(
                [
                    'message' => 'updated successfully',
                    'status' => true,
                    'data' => $barang,
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage(),
                    'status' => false,
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }

    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($kode_barang = null)
    {
        try {

            $barang = $this->model->findBarang('kode_barang', $kode_barang);

            $this->model->delete($barang);

            return $this
                ->getResponse(
                    [
                        'message' => 'deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage(),
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

}
