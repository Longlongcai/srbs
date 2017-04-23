<?php
 class Device extends AppModel
{
    public $name = 'Device'; 
    public $belongsTo = array(
        'Room' => array(
            'className'    => 'Room',
            'foreignKey'    => 'room_id'
        ) 
    );
     public $validate = array(
        'devicename' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入设备名'
            )
        ),
        'function' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入功能描述'
            )
        )
    );
}