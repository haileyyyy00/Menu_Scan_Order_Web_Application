<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class AdminController extends BaseController
{
    /**
     * Constructor function initializes helpers and session.
     */
    public function __construct()
    {
        helper('url');
        $this->session = session();
    }

    /**
     * Displays the admin page with a list of users.
     * Users can be filtered by a 'search' query parameter.
     *
     * @return mixed The view for the admin page with users data.
     */
    public function admin()
    {
        $model = new \App\Models\UserModel();
      
        $search = $this->request->getGet('search');
      
        if (!empty($search)) {
            $conditions = [];
          
            foreach ($model->allowedFields as $field) {
                $conditions[] = "LOWER($field) LIKE '%$search%'";
            }
          
            $whereClause = implode(' OR ', $conditions);
            $users = $model->where($whereClause)->orderBy('name', 'ASC')->findAll();
        } else {
            $users = $model->orderBy('name', 'ASC')->findAll();
        }
      
        $data['users'] = $users;
      
        return view('admin', $data);
    }

    /**
     * Handles adding or editing a user based on POST data.
     * Redirects to the admin page after the operation.
     *
     * @param int|null $id The ID of the user to edit, null if adding a new user.
     * @return mixed Redirect response to the admin page.
     */
    public function addedit($id = null)
    {
        $model = new \App\Models\UserModel();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            $data['isAdmin'] = ($data['role'] === 'admin');
            $data['status'] = ($data['user_status'] === 'active');

            unset($data['role']);
            unset($data['user_status']);

            if ($id === null) {
                if ($model->insert($data)) {
                    $this->session->setFlashdata('success', 'User added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add user. Please try again.');
                }
            } else {
                if ($model->update($id, $data)) {
                    $this->session->setFlashdata('success', 'User updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update user. Please try again.');
                }
            }

            return redirect()->to('/admin');
        }

        $data['user'] = ($id === null) ? null : $model->find($id);
        return view('addedit', $data);
    }

    /**
     * Archives a user by setting the archived field to true.
     * Redirects to the admin page after archiving.
     *
     * @param int $user_id The ID of the user to archive.
     * @return mixed Redirect response to the admin page.
     */
    public function archive($user_id)
    {
        $model = new \App\Models\UserModel();

        $data = ['archived' => true];

        if ($model->update($user_id, $data)) {
            $this->session->setFlashdata('success', 'User archived successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to archive user. Please try again.');
        }

        return redirect()->to('/admin');
    }
}
