<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class Product extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        } else {
            $model = new ProductModel();
            $data = [
                'product'  => $model->getProduct(),
                'title' => 'Products',
            ];
            echo view('templates/header', $data);
            echo view('product/overview', $data);
            echo view('templates/footer', $data);
        }
    }

    public function view($slug = null)
    {
        if (isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        } else {
            $model = new ProductModel();

            $data['product'] = $model->getProduct($slug);
            if (empty($data['product'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: ' . $slug);
            }
            $data['title'] = $data['product']['name'];
            echo view('templates/header', $data);
            echo view('product/view', $data);
            echo view('templates/footer', $data);
        }
    }
    public function create()
    {
        if (isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        } else {
            $model = new ProductModel();

            if ($this->request->getMethod() === 'post' && $this->validate([
                'name' => 'required|min_length[3]|max_length[255]',
                'price'  => 'required'
            ])) {
                $model->save([
                    'name' => $this->request->getPost('name'),
                    'price'  => $this->request->getPost('price'),
                    'review'  => $this->request->getPost('review'),
                ]);

                $this->index();
            } else {
                echo view('templates/header', ['title' => 'Create a new item']);
                echo view('product/create');
                echo view('templates/footer');
            }
        }
    }
    public function edit($id)
    {
        if (isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        } else {
            $model = new ProductModel();

            if ($this->request->getMethod() === 'post' && $this->validate([
                'name' => 'required|min_length[3]|max_length[255]',
                'price'  => 'required'
            ])) {
                $id = $this->request->getPost('id');

                $data['product'] = [
                    'name' => $this->request->getPost('name'),
                    'price'  => $this->request->getPost('price'),
                    'review'  => $this->request->getPost('review')
                ];
                $model->update($id, $data['product']);
                $this->index();
            } else {
                $data['product'] = $model->find($id);
                echo view('templates/header', ['title' => 'Edit']);
                echo view('product/edit', $data);
                echo view('templates/footer');
            }
        }
    }
    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        $this->index();
    }
   
}
