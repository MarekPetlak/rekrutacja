<?php

class UserDriverlicense extends ActiveRecord\Model {

   public static $table_name = 'user-driverlicense';

   static $belongs_to = array(
       array('user'),
       array('driverlicense')
       );

}
