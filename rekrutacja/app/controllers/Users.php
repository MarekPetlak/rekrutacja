<?php

class Users extends Controller {

   public function index($offset = 0) {
      $limit = 3;
      $offset = $offset > 0 ? ($offset - 1) * $limit : intval($offset);

      $user = $this->model('user');
      $result = $user::find('all', array('limit' => $limit, 'offset' => $offset));
      $count = $user::count();


      $this->smarty->assign('mode', 'users');
      $this->smarty->assign('users', $result);
      $this->smarty->assign('user_counter', $count);
      $this->smarty->assign('pagination_counter', ceil($count / $limit));

      $this->smarty->display('user_list.tpl');
   }

   public function preview($id = 0) {
      if ($id > 0) {
         $user = $this->model('user');
         $licenses = $this->model('driverlicense');

         try {
            $result = $user::find($id);
            $user_licenses = $licenses::all('all', array('conditions' => 'user_id = ' .$id, 'joins' => 'JOIN `user-driverlicense` ud ON(id = ud.driverlicense_id)'));
         } catch (ActiveRecord\RecordNotFound $e) {
            //null
         }
      } else {
         $result = "";
      }

      $this->smarty->assign('user', $result);
      $this->smarty->assign('user_licenses', $user_licenses);
      $this->smarty->display('user_preview.tpl');
   }

   public function edit($id = 0) {
      if ($id > 0) {
         $user = $this->model('user');
         $result = $user::find($id);

         $driver_licenses = $this->model('userdriverlicense');
         $user_licenses = $driver_licenses::all('all', array('conditions' => 'user_id = ' .$id, 'joins' => 'JOIN driverlicense dl ON(driverlicense_id = dl.id)'));
      }

      $licenses = $this->model('driverlicense');
      $categories = $licenses::all();

      $this->smarty->assign('user', $result);
      $this->smarty->assign('categories', $categories);
      $this->smarty->assign('user_licenses', $user_licenses);
      $this->smarty->display('user_edit.tpl');
   }

   public function update() {
      $id = intval($_POST['id']);

      $this->model('user');
      $driver_licenses = $this->model('userdriverlicense');

      if ($id > 0) {
         try {
            $user = user::find($id);

            $user->fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
            $user->lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);

            $user->save();

            $driver_licenses->table()->delete(array('user_id' => array($id)));
         } catch (ActiveRecord\RecordNotFound $e) {
            //null
         }
      } else {
         $user = new user();

         $user->fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
         $user->lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
         $user->created_at = filter_var($_POST['created_at'], FILTER_SANITIZE_STRING);

         if ($user->save() == false) {
            echo $user->errors->on('fname');
            echo $user->errors->on('lname');
         }

         $id = $user->id;
      }

      if ($id > 0 && is_array($_POST['category'])) {
         foreach ($_POST['category'] AS  $value) {
            try {
               $license = new userdriverlicense();

               $license->user_id = $id;
               $license->driverlicense_id = intval($value);
               $license->save();
            } catch (ActiveRecord\RecordNotFound $e) {
               //null
            }
         }
      }

      echo $id;
   }

   public function delete() {
      $id = intval($_POST['value']);

      if ($id > 0) {
         $driver_licenses = $this->model('userdriverlicense');
         $driver_licenses->table()->delete(array('user_id' => array($id)));
         
         $user = $this->model('user');
         $user->table()->delete(array('id' => array($id)));
      }
   }
   
   public function autocomplete() {
      $value = trim(filter_var($_GET['term'], FILTER_SANITIZE_STRING));
      if (strlen($value) > 0) {
         
            $user = $this->model('user');
            $result = $user::find('all', array('conditions' =>  'lname LIKE \'%' . $value. '%\''));
            
            if (is_array($result) && count($result) > 0) {
               foreach ($result AS $row) {
                  $json[] = '{"id":"'. $row->id .'", "value":"' . $row->lname . ' ' . $row->fname. '","label": "' . $row->lname . ' ' . $row->fname. '"}'; 
               }
            }
            echo is_array($json) ? '['  . join(',', $json). ']' : ''; 
      }
   }
}
