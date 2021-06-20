<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Barang extends BaseController
{
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
                'data' => $this->model->select_data("barang"),
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

            $barang = $this->model->select_data("barang", "getRow", ["kode_barang" => $kode_barang]);

            return $this->getResponse(
                [
                    'message' => 'retrieved successfully',
                    'data' => $barang,
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find barang for specified ID',
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }

    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    function new () {

    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'nama_barang' => 'required',
            // 'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[client.email]',
            // 'retainer_fee' => 'required|max_length[255]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $data = [
            "nama_barang" => $input['nama_barang'],
        ];

        $data = $this->model->insert_data("barang", $data);

        return $this->getResponse(
            [
                'data' => $data,
                'message' => 'added successfully',
            ]
        );

    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
