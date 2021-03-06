<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Kategori extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();

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
    public function show($id = null)
    {
        try {

            $kategori = $this->model->findKategori($id);

            return $this->getResponse(
                [
                    'message' => 'retrieved successfully',
                    'kategori' => $kategori,
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
            'kategori' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $kategori = $input['kategori'];
        $keterangan = $input['keterangan'];

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
    public function update($id = null)
    {
        try {

            $this->model->findKategori($id);

            $input = $this->getRequestInput($this->request);

            $this->model->where('id', $id)->set($input)->update();

            $kategori = $this->model->findKategori($id);

            return $this->getResponse(
                [
                    'message' => 'updated successfully',
                    'status' => true,
                    'data' => $kategori,
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
    public function delete($id = null)
    {
        try {

            $kategori = $this->model->findKategori($id);

            $this->model->delete($kategori);

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
