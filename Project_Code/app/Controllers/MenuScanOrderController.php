<?php namespace App\Controllers;


use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class MenuScanOrderController extends BaseController
{
   public function __construct()
   {
       // Load the URL helper, it will be useful in the next steps
       // Adding this within the __construct() function will make it
       // available to all views in the ResumeController
       helper('url');
       $this->session = session();
   }


   public function index()
   {
       return view('landing');
   }


//    public function admin()
//    {
//        // Create an instance of the UserModel
//        $model = new \App\Models\UserModel();
      
//        // Get the value of the 'search' query parameter from the request
//        $search = $this->request->getGet('search');
      
//        if (!empty($search)) {
//            // If the search query is not empty
          
//            // Initialize an empty array to store search conditions
//            $conditions = [];
          
//            // Loop through each allowed field in the UserModel
//            foreach ($model->allowedFields as $field) {
//                // Generate a search condition for each field using LIKE operator
//                $conditions[] = "LOWER($field) LIKE '%$search%'";
//            }
          
//            // Implode the conditions array with OR operator to create a single search clause
//            $whereClause = implode(' OR ', $conditions);
          
//            // Retrieve users matching the search conditions, order by name in ascending order
//            $users = $model->where($whereClause)->orderBy('name', 'ASC')->findAll();
//        } else {
//            // If no search query is provided
          
//            // Retrieve all users, order by name in ascending order
//            $users = $model->orderBy('name', 'ASC')->findAll();
//        }
      
//        // Store the retrieved users in the $data array
//        $data['users'] = $users;
      
//        // Load the 'admin' view and pass the $data array to it
//        return view('admin', $data);
//    }


//    public function addedit($id = null)
//     {
//         $model = new \App\Models\UserModel();

//         if ($this->request->getMethod() === 'POST') {
//             $data = $this->request->getPost();
//             $data['isAdmin'] = ($data['role'] === 'admin');
//             // $data['archived'] = ($data['is_archived'] === 'archived');
//             $data['status'] = ($data['user_status'] === 'active');

//             unset($data['role']);
//             unset($data['user_status']);
//             // unset($data['is_archived']);

//             if ($id === null) {
//                 if ($model->insert($data)) {
//                     $this->session->setFlashdata('success', 'User added successfully.');
//                 } else {
//                     $this->session->setFlashdata('error', 'Failed to add user. Please try again.');
//                 }
//             } else {
//                 if ($model->update($id, $data)) {
//                     $this->session->setFlashdata('success', 'User updated successfully.');
//                 } else {
//                     $this->session->setFlashdata('error', 'Failed to update user. Please try again.');
//                 }
//             }


//             return redirect()->to('/admin');
//         }


//         $data['user'] = ($id === null) ? null : $model->find($id);

//         return view('addedit', $data);
//     }

   public function qrcode($user_id) {
       $base_url = base_url();
       $tableNum = $this->request->getGet('tableNumber');
       $qr_codes = [];
       $urls = [];


       if(!empty($tableNum )) {
           for ($i = 0; $i < $tableNum; $i++) {
               $uniqueIdentifier = uniqid(); // Generate a unique identifier
               $url = $base_url . 'customer_menu_view/' . $user_id . '/' . $i+1 . '/?id=' . $uniqueIdentifier;
               $urls[] = $url; 

               $qr_code = QRCode::create($url);
               $writer = new PngWriter;
               $result = $writer->write($qr_code);
               // $this->response->setHeader('Content-Type', $result->getMimeType());
               // $result->getString();
               // $this->response->setBody($result->getString());
               // return $this->response->send();
               // $qr_code = $result->getMimeType();
               $qr_codes[] = $result->getString();       
           }
       }


       $data['qr_codes'] = $qr_codes;
       $data['user_id'] = $user_id;
       $data['urls'] = $urls;
       return view('qrcode', $data);
    }


    // public function archive($user_id) {
    //    $model = new \App\Models\UserModel();

    // //    $data = [ //is_archived (VARCHAR)
    // //        'is_archived' => 'archived',
    // //    ];

    //    $data = [ //archived (boolean)
    //     'archived' => true ,
    //     ];
        

    //    if($model->update($user_id, $data)) {
    //        $this->session->setFlashdata('success', 'User archived successfully.');
    //    } else {
    //        $this->session->setFlashdata('error', 'Failed to archive user. Please try again.');
    //    }

    //    return redirect()->to('/admin');
    // }


//     public function viewmenu($user_id) {


//        // Create an instance of the UserModel
//        $model = new \App\Models\MenuModel();
      
//        // Get the value of the 'search' query parameter from the request
//        $search = $this->request->getGet('search');
      
//        if (!empty($search)) {
           
//            $menus = $model->where("LOWER(name) LIKE LOWER('%$search%') AND user_id = $user_id")->orderBy('created_on', 'DESC')->findAll();

//        } else {
//            // If no search query is provided
//            // Retrieve all users, order by name in ascending order
//            $menus = $model->where('user_id', $user_id)->orderBy('created_on', 'DESC')->findAll();
//        }
      
//        // Store the retrieved users in the $data array
//        $data['menus'] = $menus;
//        $data['user_id'] = $user_id;
      
//        // Load the 'admin' view and pass the $data array to it
//        return view('menu', $data);

//    }

//    public function menuaddedit($user_id, $menu_id = null) {
//         $model = new \App\Models\MenuModel();

//         if ($this->request->getMethod() === 'POST') {
//             $data = $this->request->getPost();


//             if ($menu_id === null) {
//                 if ($model->insert($data)) {
//                     $this->session->setFlashdata('success', 'Menu entry added successfully.');
//                 } else {
//                     $this->session->setFlashdata('error', 'Failed to add menu entry. Please try again.');
//                 }
//             } else {
//                 if ($model->update($menu_id, $data)) {
//                     $this->session->setFlashdata('success', 'Menu entry updated successfully.');
//                 } else {
//                     $this->session->setFlashdata('error', 'Failed to update menu entry. Please try again.');
//                 }
//             }

//             return redirect()->to('/viewmenu/' . $user_id);
//         }

//         $data['menu'] = ($menu_id === null) ? null : $model->find($menu_id);
//         $data['user_id'] = $user_id;

//         return view('menuaddedit', $data);
//    }

//    public function menudelete($user_id, $menu_id) {
//         $model = new \App\Models\MenuModel();
    
//         if ($model->delete($menu_id)) {
//             $this->session->setFlashdata('success', 'Menu entry deleted successfully.');
//         } else {
//             $this->session->setFlashdata('error', 'Failed to delete menu entry. Please try again.');
//         }
        
//         return redirect()->to('/viewmenu/' . $user_id);
//    }

//    public function viewmenuitems($menu_id) {

//     $model = new \App\Models\MenuItemModel();
//     $menu_model = new \App\Models\MenuModel();

//     //SELECT DISTINCT(category) FROM Menu_Item WHERE menu_id = $menu_id ORDER BY category ASC;
//     $data['categories'] = $model->orderBy('category', 'ASC')->where('menu_id', $menu_id)->select('category')->distinct()->findAll();

//     //SELECT * FROM Menu_item WHERE menu_id = $menu_id ORDER BY category ASC;
//     $data['menu_items'] = $model->orderBy('category', 'ASC')->where('menu_id', $menu_id)->findAll();

//     // foreach ($data['categories'] as $category) {
//     //     echo $category['category'] . "<br>";
//     // }
//     $data['menu_record'] = $menu_model->where('menu_id', $menu_id)->first();
//     $data['menu_name'] =  $data['menu_record']['name'];
//     $data['menu_id'] = $menu_id;

//     return view('menuitems', $data);
//    }

//    public function itemaddedit($menu_id, $menu_item_id=null) {
//     $model = new \App\Models\MenuItemModel();

//     if ($this->request->getMethod() === 'POST') {
//         $data = $this->request->getPost();


//         if ($menu_item_id === null) {
//             if ($model->insert($data)) {
//                 $this->session->setFlashdata('success', 'Menu item added successfully.');
//             } else {
//                 $this->session->setFlashdata('error', 'Failed to add menu item. Please try again.');
//             }
//         } else {
//             if ($model->update($menu_item_id, $data)) {
//                 $this->session->setFlashdata('success', 'Menu item updated successfully.');
//             } else {
//                 $this->session->setFlashdata('error', 'Failed to update menu item. Please try again.');
//             }
//         }

//         return redirect()->to('/viewmenuitems/' . $menu_id);
//     }

//     $data['menu_item'] = ($menu_item_id === null) ? null : $model->find($menu_item_id);
//     $data['menu_id'] = $menu_id;

//     return view('itemaddedit', $data);
//    }

//    public function editcategory($menu_id, $category) {

//     $model = new \App\Models\MenuItemModel();

//     if ($this->request->getMethod() === 'POST') {
//         // Retrieve data from POST
//         $newCategory = $this->request->getPost('category');

//         if (!empty($newCategory)) {
//             // Perform the update operation
//             $updated = $model->where('menu_id', $menu_id)
//                              ->where('category', $category)
//                              ->set('category', $newCategory)
//                              ->update();

//             if ($updated) {
//                 $this->session->setFlashdata('success', 'Category updated successfully.');
//             } else {
//                 $this->session->setFlashdata('error', 'Failed to update category. Please try again.');
//             }

//             return redirect()->to('/viewmenuitems/' . $menu_id);
//         } else {
//             $this->session->setFlashdata('error', 'No data provided for update.');
//             return redirect()->back();
//         }
//     }

//     // Initial data load for GET request
//     $data['category'] = $category;
//     $data['menu_id'] = $menu_id;
//     return view('categoryedit', $data);
// }

//     public function category_delete($menu_id, $category) {
//         $model = new \App\Models\MenuItemModel();

//         if ($model->where('menu_id', $menu_id)->where('category', $category)->delete()) {
//             $this->session->setFlashdata('success', 'Category successfully removed.');
//         } else {
//             $this->session->setFlashdata('error', 'Failed to remove category.');
//         }
        
//         return redirect()->back();
//     }

//     public function menu_item_delete($menu_item_id) {
//         $model = new \App\Models\MenuItemModel();

//         if ($model->delete($menu_item_id)) {
//             $this->session->setFlashdata('success', 'Menu item deleted successfully.');
//         } else {
//             $this->session->setFlashdata('error', 'Failed to delete menu item. Please try again.');
//         }
        
//         return redirect()->back();
//     }

    public function customer_menu($user_id, $table_number) {
        $menu_model = new \App\Models\MenuModel();
        $menu_item_model = new \App\Models\MenuItemModel();
    
        // SELECT menu_id FROM Menu where user_id = $user_id AND visible = true;
        // Retrieve the first row that matches the condition
        $menu_record = $menu_model->select('menu_id')
                                  ->where('user_id', $user_id)
                                  ->where('visible', true)
                                  ->first();

        // Extract menu_id from the retrieved record
        // Ensure that a record was returned before trying to access its properties
        $menu_id = isset($menu_record['menu_id']) ? $menu_record['menu_id'] : null;

        // SELECT * FROM Menu_Item where menu_id = $menu_id;
        
        $data['menu_items'] = $menu_item_model->where('menu_id', $menu_id)
                                              ->findAll();
        
        $data['categories'] = $menu_item_model->orderBy('category', 'ASC')
                                              ->where('menu_id', $menu_id)
                                              ->select('category')
                                              ->distinct()
                                              ->findAll();
    
        $data['user_id'] = $user_id;
        $data['menu_id'] = $menu_id;
        $data['table_number'] = $table_number;
    
        return view('customermenu', $data);
    }

    public function order_handling($user_id, $table_number) {
        // Start or retrieve the existing session
        $order_model = new \App\Models\OrderModel();
        $order_details_model = new \App\Models\OrderDetailsModel();

        date_default_timezone_set('Australia/Brisbane');
        $timestamp = date('Y-m-d H:i:s');
    
        // Retrieve POST data
        $menu_item_ids = $this->request->getPost('menu_item_ids');
        $quantities = $this->request->getPost('quantities');
    
        if ($menu_item_ids && $quantities) {
            $order_details = [];
    
            foreach ($menu_item_ids as $index => $menu_item_id) {
                $quantity = $quantities[$index];
    
                // Check if quantity is more than 0 to process the order
                if ($quantity > 0) {
                    $order_details[] = [
                        'menu_item_id' => $menu_item_id,
                        'quantity' => $quantity,
                        'created_at' =>  $timestamp,
                        'user_id' => $user_id,
                        'table_number' => $table_number
                    ];
                }
            }
            if (!empty($order_details)) {
                $order = [
                    'user_id' => $user_id,
                    'status' => 'Pending', // Assuming status is a required field
                    'table_number' => $table_number,
                    'created_at' => $timestamp
                ];

            $order_model->insert($order);
            $order_details_model->insertBatch($order_details);

            return view('order_completed');
            } 
        }
    }

    // public function track_order($user_id) {

    //     $order_model = new \App\Models\OrderModel();

    //     $filter = $this->request->getPost('order_filter');

    //     if($filter == "today") {
    //         date_default_timezone_set('Australia/Brisbane');
    //         $today = date('Y-m-d');

    //         $orders = $order_model->select('*')
    //                       ->where('user_id', $user_id)
    //                       ->where("DATE(created_at)", $today)  // Ensure created_at date is today
    //                       ->orderBy("CASE WHEN status = 'Pending' THEN 1 WHEN status = 'Completed' THEN 2 ELSE 3 END, created_at", 'ASC')
    //                       ->findAll();
    //     } else {
    //     $orders = $order_model->select('*')
    //                       ->where('user_id', $user_id)
    //                       ->orderBy("CASE WHEN status = 'Pending' THEN 1 WHEN status = 'Completed' THEN 2 ELSE 3 END, created_at", 'ASC')
    //                       ->findAll();
    //     }

    //     $data['orders'] = $orders;
    //     $data['user_id'] = $user_id;

    //     return view('trackorder', $data);
    // }

    // public function view_order($user_id, $table_number, $created_at) {
    //     $order_details_model = new \App\Models\OrderDetailsModel();
    
    //     // Format the created_at date appropriately if it's not already in the right format.
    //     // Assuming created_at is passed in 'Y-m-d H:i:s' format. Adjust if necessary.
    
    //     // Perform the join and apply the filters
        // $order_details = $order_details_model->select('Order_Details.*, Menu_Item.name')
        //     ->join('Menu_Item', 'Menu_Item.menu_item_id = Order_Details.menu_item_id', 'inner')
        //     ->where([
        //         'Order_Details.user_id' => $user_id,
        //         'Order_Details.table_number' => $table_number,
        //         'Order_Details.created_at' => $created_at
        //     ])
        //     ->findAll();
    
    //     // Prepare the data to be passed to the view
    //     $data['order_details'] = $order_details;
    //     $data['table_number'] = $table_number;
    //     $data['user_id'] = $user_id;
    
    //     return view('vieworder', $data);
    // }    

    // public function update_status($user_id, $order_id, $created_at) {
    //     $order_model = new \App\Models\OrderModel();
        
    //     // // Retrieve the status update request from POST data
    //     // $update_order = $this->request->getPost('update_order');

    //     $data1 = ['status' => 'Completed'];
    //     $data2 = ['created_at' => $created_at];
    //     $order_model->update($order_id, $data1);
    //     $order_model->update($order_id, $data2);
        
    //     return redirect()->to('orders/track_order/' . $user_id);
    // }  

}