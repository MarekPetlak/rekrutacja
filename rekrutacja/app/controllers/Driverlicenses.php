<?php

class DriverLicenses extends Controller {

   public function index($offset = 0) {
      $limit = 4;
      $offset = $offset > 0 ? ($offset - 1) * $limit : intval($offset);
      
      $driverlicense = $this->model('driverlicense');
      $result = $driverlicense::find('all', array('limit' => $limit, 'offset' => $offset));
      $count = $driverlicense::count();

      $this->smarty->assign('mode', 'driverlicenses');
      $this->smarty->assign('categories', $result);
      $this->smarty->assign('categories_counter', $count);
      $this->smarty->assign('pagination_counter', ceil($count / $limit));

      $this->smarty->display('categories_list.tpl');
   }

   public function preview($id = 0) {
      if ($id > 0) {
         $driverlicense = $this->model('driverlicense');
         try {
            $result = $driverlicense::find($id);
         } catch (ActiveRecord\RecordNotFound $e) {
            //null
         }
      } else {
         $result = "";
      }

      $this->smarty->assign('category', $result);
      $this->smarty->display('category_preview.tpl');
   }

   public function edit($id = 0) {
      if ($id > 0) {
         $driverlicense = $this->model('driverlicense');
         try {
            $result = $driverlicense::find($id);
         } catch (ActiveRecord\RecordNotFound $e) {
            //null
         }
      }

      $this->smarty->assign('category', $result);

      $this->smarty->display('category_edit.tpl');
   }

   public function update() {
      $id = intval($_POST['id']);

      $driverlicense = $this->model('driverlicense');

      if ($id > 0) {
         try {
            $license = driverlicense::find($id);

            $license->category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
            $license->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $license->created_at = filter_var($_POST['created_at'], FILTER_SANITIZE_STRING);

            $license->save();
         } catch (ActiveRecord\RecordNotFound $e) {
            //null
         }
      } else {
         $license = new driverlicense();

         $license->category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
         $license->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
         $license->created_at = filter_var($_POST['created_at'], FILTER_SANITIZE_STRING);

         if ($license->save() == false) {
            echo $license->errors->on('category');
         }
         
         $id = $license->id;
      }
      
      echo $id;
   }
   
   public function delete() {
      $id = intval($_POST['value']);

      if ($id > 0) {
         $driver_licenses = $this->model('userdriverlicense');
         $driver_licenses->table()->delete(array('driverlicense_id' => array($id)));
         
         $license = $this->model('driverlicense');
         $license->table()->delete(array('id' => array($id)));
      }
   }
   
   public function autocomplete() {
      $value = trim(filter_var($_GET['term'], FILTER_SANITIZE_STRING));
      if (strlen($value) > 0) {
         
            $license = $this->model('driverlicense');
            $result = $license::find('all', array('conditions' =>  'category LIKE \'%' . $value. '%\''));
            
            if (is_array($result) && count($result) > 0) {
               foreach ($result AS $row) {
                  $json[] = '{"id":"'. $row->id .'", "value":"' . $row->category . '","label": "' . $row->category . '"}'; 
               }
            }
            echo is_array($json) ? '['  . join(',', $json). ']' : ''; 
      }
   }
}
