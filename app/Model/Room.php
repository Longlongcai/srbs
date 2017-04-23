<?php
class Room extends AppModel
{
	public $hasMany = array(
        'Booking'=>array(
            'className' =>'Booking',
            'foreignkey' => 'room_id',
            'dependent' => true
            ),
        'Device'=>array(
            'className' =>'Device',
            'foreignkey' => 'room_id',
            'dependent' => true
            ),
             
        );

    public $validate = array(
        'roomname' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入房间号'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => '该房间号已被使用'
            )
        ),
        'seat_nums' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入座位数'
            ),
            'positive' => array(
                'rule' => 'isPositive',
                'message' => '请输入正整数'
            )
        )
    );

    public function isPositive($data) {
        return $data['seat_nums'] >= 0;
    }
    
}
?>