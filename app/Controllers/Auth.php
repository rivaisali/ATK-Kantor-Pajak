<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
        $rules = [
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'username' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'password' => 'required|min_length[8]|max_length[255]',
            'foto' => 'required',
            'level' => 'required',
        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $userModel = new UserModel();
        $userModel->save($input);

        return $this
            ->getJWTForUser(
                $input['nip'],
                ResponseInterface::HTTP_CREATED
            );

    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'nip' => 'required',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[nip, password]',
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided',
            ],
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        return $this->getJWTForUser($input['nip']);

    }

    private function getJWTForUser(
        string $nip,
        int $responseCode = ResponseInterface::HTTP_OK
    ) {
        try {
            $model = new UserModel();
            $user = $model->findUserByNIP($nip);
            unset($user['password']);

            helper('jwt');

            $users = array(
                'id' => $user['id'],
                'email' => $user['email'],
                'level' => $user['level'],
                'nip' => $user['nip'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at'],
                'access_token' => getSignedJWTForUser($nip),
            );

            $model->update($user['id'], [
                "last_logged" => date('y-m-d H:i:s'),
            ]);

            return $this
                ->getResponse(
                    [
                        'message' => 'User authenticated successfully',
                        'data' => $users,
                    ]
                );

        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
