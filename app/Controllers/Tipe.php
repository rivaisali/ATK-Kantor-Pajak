<?php

namespace App\Controllers;

use App\Models\TipeModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Tipe extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new TipeModel();

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

            $tipe = $this->model->findTipe($id);

            return $this->getResponse(
                [
                    'message' => 'retrieved successfully',
                    'tipe' => $tipe,
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
            'kategori_id' => 'required',
            'tipe' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $kategori_id = $input['kategori_id'];
        $tipe = $input['tipe'];

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

            $this->model->findTipe($id);

            $input = $this->getRequestInput($this->request);

            $this->model->where('id', $id)->set($input)->update();

            $tipe = $this->model->findTipe($id);

            return $this->getResponse(
                [
                    'message' => 'updated successfully',
                    'status' => true,
                    'data' => $tipe,
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

            $tipe = $this->model->findTipe($id);

            $this->model->delete($tipe);

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
