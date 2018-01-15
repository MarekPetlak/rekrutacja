<?php

class User extends ActiveRecord\Model {

   public static $table_name = 'user';
   static $has_many = array(
       array('userdriverlicense'),
       array('driverlicense', 'through' => 'userdriverlicense')
   );
   static $validates_size_of = array(
       array('fname', 'within' => array(1, 20), 'too_long' => 'Imię jest zbyt długie.', 'too_short' => 'Imię jest zbyt krótkie.'),
       array('lname', 'within' => array(1, 40), 'too_long' => 'nazwisko jest zbyt długie.', 'too_short' => 'Nazwisko jest zbyt krótkie.'),
   );

}
