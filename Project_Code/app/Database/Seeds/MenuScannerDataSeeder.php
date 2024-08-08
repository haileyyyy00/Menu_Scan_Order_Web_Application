<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuScannerDataSeeder extends Seeder
{
    public function run()
   {
       $user_data = [
           [
               'name'          => 'John Doe',
               'email'         => 'johndoe123@gmail.com',
               'phone'         =>  '0493251118',
           ],[
               'name'          => 'Amy',
               'email'         => 'amy456@gmail.com',
               'phone'         =>  '0489765554',
               'user_status'   => 'inactive'
           ],
           [
               'name'          => 'Christina Jolly',
               'email'         => 'christinajolly789@gmail.com',
               'phone'         =>  '0498891118',
           ],[
               'name'          => 'Cheng Yang',
               'email'         => 'chengyang990@gmail.com',
               'phone'         => '0433265554',
            //    'role'      => 'admin', 
            //comment out this line at the moment, as we are currently testing to creat menus for each user
               'user_status'   => 'inactive'
           ]
       ];

       $userIds = [];
       foreach($user_data as $user) {
           $this->db->table('User')->insert($user);
           $userIds[] = $this->db->insertID();
       }
   }
}
