<?php

class driverlicense extends ActiveRecord\Model {

   public static $table_name = 'driverlicense';
   static $has_many = array(
       array('userdriverlicense'),
       array('user', 'through' => 'userdriverlicense')
   );
   static $validates_size_of = array(
       array('category', 'within' => array(1, 5), 'too_long' => 'Nazwa kategorii jest zbyt długa.', 'too_short' => 'Nazwa kategorii jest zbyt krótka.')
   );

}
