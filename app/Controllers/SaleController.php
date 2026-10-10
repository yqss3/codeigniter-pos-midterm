<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class SaleController extends BaseController
{
    public function index()
    {
        $saleModel = new SaleModel();

        $data['sales'] = $saleModel
            ->select('sales.*, products.name AS product_name, customers.full_name AS customer_name, users.full_name AS staff_name')
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left')
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.id', 'DESC')
            ->findAll();

        return view('sales/index', $data);
    }

    public function create()
    {
        $data['products'] = (new ProductModel())->findAll();
        $data['customers'] = (new CustomerModel())->findAll();

        return view('sales/create', $data);
    }

    public function store()
    {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $productId = (int) $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id');
        $quantity = (int) $this->request->getPost('quantity');

        $product = $productModel->find($productId);

        if (!$product || $quantity < 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid product and quantity.');
        }

        if ($quantity > (int) $product['stock_quantity']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Not enough stock available.');
        }

        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to(site_url('login'));
        }

        $totalPrice = (float) $product['price'] * $quantity;

        $db = \Config\Database::connect();
        $db->transBegin();

        $saleModel->insert([
            'product_id' => $productId,
            'customer_id' => $customerId ?: null,
            'sold_by' => $userId,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $productModel->update($productId, [
            'stock_quantity' => (int) $product['stock_quantity'] - $quantity,
        ]);

        if ($db->transStatus() === false) {
            $db->transRollback();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to record the sale. Please try again.');
        }

        $db->transCommit();

        return redirect()->to(site_url('sales'))
            ->with('success', 'Sale recorded successfully.');
    }
}
