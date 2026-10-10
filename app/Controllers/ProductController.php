<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    // Display all products
    public function index()
    {
        $model = new ProductModel();

        return view('products/index', [
            'products' => $model->findAll()
        ]);
    }

    // Display the Add Product form
    public function create()
    {
        return view('products/create');
    }

    // Save a new product
    public function store()
    {
        $model = new ProductModel();

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please check your product details.');
        }

        $imageName = null;
        $image = $this->request->getFile('image');

        if ($image && $image->getError() !== UPLOAD_ERR_NO_FILE) {
            $imageRules = [
                'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpeg,image/png,image/webp]|max_size[image,2048]',
            ];

            if (!$this->validate($imageRules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Choose a valid JPG, PNG, or WebP image up to 2 MB.');
            }

            $uploadPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products';

            // Create the folder only if it does not exist.
            if (!is_dir($uploadPath)) {
                if (!@mkdir($uploadPath, 0775, true) && !is_dir($uploadPath)) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Unable to create the product upload folder.');
                }
            }

            if (!is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'The product upload folder is not writable.');
            }

            $imageName = $image->getRandomName();

            if (!$image->move($uploadPath, $imageName)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Unable to upload the product image.');
            }
        }

        $model->insert([
            'name' => trim($this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/products')
            ->with('success', 'Product added successfully!');
    }

    // Display the Edit Product form
    public function edit($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        return view('products/edit', [
            'product' => $product
        ]);
    }

    // Update an existing product
    public function update($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please check your product details.');
        }

        $data = [
            'name' => trim($this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        $image = $this->request->getFile('image');

        // Replace the image only when a new file is selected.
        if ($image && $image->getError() !== UPLOAD_ERR_NO_FILE) {
            $imageRules = [
                'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpeg,image/png,image/webp]|max_size[image,2048]',
            ];

            if (!$this->validate($imageRules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Choose a valid JPG, PNG, or WebP image up to 2 MB.');
            }

            $uploadPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products';

            // Safely create the folder if it does not exist.
            if (!is_dir($uploadPath)) {
                if (!@mkdir($uploadPath, 0775, true) && !is_dir($uploadPath)) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Unable to create the product upload folder.');
                }
            }

            if (!is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'The product upload folder is not writable.');
            }

            $imageName = $image->getRandomName();

            if (!$image->move($uploadPath, $imageName)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Unable to upload the new product image.');
            }

            $data['image'] = $imageName;

            // Delete the old image only after the new image is saved.
            if (!empty($product['image'])) {
                $oldImage = $uploadPath . DIRECTORY_SEPARATOR . $product['image'];

                if (is_file($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        $model->update($id, $data);

        return redirect()->to('/products')
            ->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function delete($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        // Delete the associated image if it exists.
        if (!empty($product['image'])) {
            $imagePath = FCPATH . 'uploads'
                . DIRECTORY_SEPARATOR . 'products'
                . DIRECTORY_SEPARATOR . $product['image'];

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $model->delete($id);

        return redirect()->to('/products')
            ->with('success', 'Product deleted successfully!');
    }
}
