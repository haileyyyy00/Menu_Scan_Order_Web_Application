<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class UserController extends BaseController
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
     * Generates QR codes for specific URLs based on a user's table numbers. Each QR code represents
     * a unique URL for accessing a menu, and the QR codes are returned as image strings.
     *
     * @param int $user_id The ID of the user for whom the QR codes are generated.
     * @return mixed Renders a view displaying QR codes.
     */
    public function qrcode($user_id) {
        $base_url = base_url(); 
        $tableNum = $this->request->getGet('tableNumber'); 
        $qr_codes = []; 
        $urls = [];

        if (!empty($tableNum)) {
            for ($i = 0; $i < $tableNum; $i++) {
                $uniqueIdentifier = uniqid(); 
                $url = $base_url . 'customer_menu_view/' . $user_id . '/' . ($i + 1) . '/?id=' . $uniqueIdentifier;
                $urls[] = $url; 

                $qr_code = QRCode::create($url); 
                $writer = new PngWriter(); 
                $result = $writer->write($qr_code);

                $qr_codes[] = $result->getString(); 
            }
        }

        $data['qr_codes'] = $qr_codes; 
        $data['user_id'] = $user_id; 
        $data['urls'] = $urls; 

        return view('qrcode', $data); 
    }

    /**
     * Displays menu items for a specific user based on search parameters or all items.
     *
     * @param int $user_id The ID of the user whose menus are to be displayed.
     * @return mixed Returns the menu view with menu data.
     */
    public function viewmenu($user_id) {
        $model = new \App\Models\MenuModel();
        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $menus = $model->where("LOWER(name) LIKE LOWER('%$search%') AND user_id = $user_id")->orderBy('created_on', 'DESC')->paginate(2);
        } else {
            $menus = $model->where('user_id', $user_id)->orderBy('created_on', 'DESC')->paginate(2);
        }

        $data['menus'] = $menus;
        $data['user_id'] = $user_id;
        $data['pager'] = $model->pager;
        return view('menu', $data);
    }

    /**
     * Adds or edits a menu based on user input.
     *
     * @param int $user_id User ID related to the menu.
     * @param int|null $menu_id Menu ID for editing; null for a new entry.
     * @return mixed Redirects to the viewmenu page.
     */
    public function menuaddedit($user_id, $menu_id = null) {
        $model = new \App\Models\MenuModel();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();

            if ($menu_id === null) {
                $insertion = $model->insert($data);
                if ($insertion) {
                    $this->session->setFlashdata('success', 'Menu entry added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add menu entry. Please try again.');
                }
            } else {
                $update = $model->update($menu_id, $data);
                if ($update) {
                    $this->session->setFlashdata('success', 'Menu entry updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update menu entry. Please try again.');
                }
            }

            return redirect()->to('viewmenu/' . $user_id);
        }

        $data['menu'] = ($menu_id === null) ? null : $model->find($menu_id);
        $data['user_id'] = $user_id;
        return view('menuaddedit', $data);
    }

    /**
     * Deletes a specific menu entry.
     *
     * @param int $user_id User ID related to the menu.
     * @param int $menu_id Menu ID to delete.
     * @return mixed Redirects to the viewmenu page.
     */
    public function menudelete($user_id, $menu_id) {
        $model = new \App\Models\MenuModel();

        $deletion = $model->delete($menu_id);
        if ($deletion) {
            $this->session->setFlashdata('success', 'Menu entry deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete menu entry. Please try again.');
        }

        return redirect()->to('viewmenu/' . $user_id);
    }

    /**
     * Displays categories and menu items within a specific menu.
     * This function fetches categories uniquely and all menu items under each category.
     *
     * @param int $menu_id The ID of the menu.
     * @return mixed Renders the menuitems view with the menu details.
     */
    public function viewmenuitems($menu_id) {
        $model = new \App\Models\MenuItemModel();
        $menu_model = new \App\Models\MenuModel();

        // Fetching distinct categories for the menu items
        $data['categories'] = $model->orderBy('category', 'ASC')
                                    ->where('menu_id', $menu_id)
                                    ->select('category')
                                    ->distinct()
                                    ->findAll();

        // Fetching all menu items for the menu
        $data['menu_items'] = $model->orderBy('category', 'ASC')
                                    ->where('menu_id', $menu_id)
                                    ->findAll();

        // Fetching the specific menu record
        $data['menu_record'] = $menu_model->where('menu_id', $menu_id)->first();
        $data['menu_name'] = $data['menu_record']['name'];
        $data['menu_id'] = $menu_id;

        return view('menuitems', $data);
    }

    /**
     * Adds or updates a menu item. If a menu item ID is provided, it updates the item, otherwise it adds a new one.
     *
     * @param int $menu_id The ID of the menu to which the item belongs.
     * @param int|null $menu_item_id Optional. The ID of the menu item to update. If null, a new item is created.
     * @return mixed Redirects to the viewmenuitems page after operation.
     */
    public function itemaddedit($menu_id, $menu_item_id = null) {
        $model = new \App\Models\MenuItemModel();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();

            if ($menu_item_id === null) {
                if ($model->insert($data)) {
                    $this->session->setFlashdata('success', 'Menu item added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add menu item. Please try again.');
                }
            } else {
                if ($model->update($menu_item_id, $data)) {
                    $this->session->setFlashdata('success', 'Menu item updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update menu item. Please try again.');
                }
            }

            return redirect()->to('viewmenuitems/' . $menu_id);
        }

        $data['menu_item'] = ($menu_item_id === null) ? null : $model->find($menu_item_id);
        $data['menu_id'] = $menu_id;

        return view('itemaddedit', $data);
    }

    /**
     * Edits the category of menu items within a specific menu.
     * If a new category name is provided through POST, it updates all items in the old category to the new one.
     *
     * @param int $menu_id The ID of the menu.
     * @param string $category The current category name to be changed.
     * @return mixed Redirects back to the menu items view or stays on the same page if update fails.
     */
    public function editcategory($menu_id, $category) {
        $model = new \App\Models\MenuItemModel();

        if ($this->request->getMethod() === 'POST') {
            $newCategory = $this->request->getPost('category');

            if (!empty($newCategory)) {
                $updated = $model->where('menu_id', $menu_id)
                                 ->where('category', $category)
                                 ->set('category', $newCategory)
                                 ->update();

                if ($updated) {
                    $this->session->setFlashdata('success', 'Category updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update category. Please try again.');
                }

                return redirect()->to('viewmenuitems/' . $menu_id);
            } else {
                $this->session->setFlashdata('error', 'No data provided for update.');
                return redirect()->back();
            }
        }

        $data['category'] = $category;
        $data['menu_id'] = $menu_id;
        return view('categoryedit', $data);
    }

    /**
     * Deletes an entire category of menu items from a specific menu.
     *
     * @param int $menu_id The ID of the menu.
     * @param string $category The category to be removed.
     * @return mixed Redirects back to the previous page with a success or error message.
     */
    public function category_delete($menu_id, $category) {
        $model = new \App\Models\MenuItemModel();

        if ($model->where('menu_id', $menu_id)->where('category', $category)->delete()) {
            $this->session->setFlashdata('success', 'Category successfully removed.');
        } else {
            $this->session->setFlashdata('error', 'Failed to remove category.');
        }
        
        return redirect()->back();
    }

    /**
     * Deletes a specific menu item.
     *
     * @param int $menu_item_id The ID of the menu item to delete.
     * @return mixed Redirects back to the previous page with a success or error message.
     */
    public function menu_item_delete($menu_item_id) {
        $model = new \App\Models\MenuItemModel();

        if ($model->delete($menu_item_id)) {
            $this->session->setFlashdata('success', 'Menu item deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete menu item. Please try again.');
        }
        
        return redirect()->back();
    }

    /**
     * Tracks and displays orders based on the user and optional date filter.
     *
     * @param int $user_id User ID whose orders are to be tracked.
     * @return mixed Renders the track order view with order details.
     */
    public function track_order($user_id) {
        $order_model = new \App\Models\OrderModel();
        $filter = $this->request->getPost('order_filter');

        if ($filter == "today") {
            date_default_timezone_set('Australia/Brisbane');
            $today = date('Y-m-d');
            $orders = $order_model->select('*')
                                  ->where('user_id', $user_id)
                                  ->where("DATE(created_at)", $today)
                                  ->orderBy("CASE WHEN status = 'Pending' THEN 1 WHEN status = 'Completed' THEN 2 ELSE 3 END, created_at", 'ASC')
                                  ->findAll();
        } else {
            $orders = $order_model->select('*')
                                  ->where('user_id', $user_id)
                                  ->orderBy("CASE WHEN status = 'Pending' THEN 1 WHEN status = 'Completed' THEN 2 ELSE 3 END, created_at", 'ASC')
                                  ->findAll();
        }

        $data['orders'] = $orders;
        $data['user_id'] = $user_id;

        return view('trackorder', $data);
    }

    /**
     * View details of a specific order.
     *
     * @param int $user_id User ID related to the order.
     * @param int $table_number Table number where the order was placed.
     * @param string $created_at Timestamp when the order was created.
     * @return mixed Renders the vieworder view with order details.
     */
    public function view_order($user_id, $table_number, $created_at) {
        $order_details_model = new \App\Models\OrderDetailsModel();

        $order_details = $order_details_model->select('Order_Details.*, Menu_Item.name')
                                             ->join('Menu_Item', 'Menu_Item.menu_item_id = Order_Details.menu_item_id', 'inner')
                                             ->where([
                                                'Order_Details.user_id' => $user_id,
                                                'Order_Details.table_number' => $table_number,
                                                'Order_Details.created_at' => $created_at
                                             ])
                                             ->findAll();

        $data['order_details'] = $order_details;
        $data['table_number'] = $table_number;
        $data['user_id'] = $user_id;

        return view('vieworder', $data);
    }      

    /**
     * Updates the status of an existing order to 'Completed' and potentially updates the creation timestamp.
     * This method updates the status based on the provided order ID and optionally updates the creation date.
     *
     * @param int $user_id The user ID associated with the order.
     * @param int $order_id The ID of the order whose status is to be updated.
     * @param string $created_at The creation timestamp of the order.
     * @return mixed Redirects to the order tracking page for the user.
     */
    public function update_status($user_id, $order_id, $created_at) {
        $order_model = new \App\Models\OrderModel();

        $data1 = ['status' => 'Completed'];
        $data2 = ['created_at' => $created_at];

        $order_model->update($order_id, $data1);
        $order_model->update($order_id, $data2);

        return redirect()->to('orders/track_order/' . $user_id);
    }

}
