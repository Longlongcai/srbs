<?php
 class Booking extends AppModel
{
   	public $name = 'Booking'; 
   	public $belongsTo = array(
  		'Room' => array(
            'className'    => 'Room',
            'foreignKey'    => 'room_id'
        )  ,
        'User' => array(
            'className'    => 'User',
            'foreignKey'    => 'user_id'
        )
    );
}
?>