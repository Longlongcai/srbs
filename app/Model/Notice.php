<?php
 class Notice extends AppModel
{
    public $name = 'Notice'; 
    public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'    => 'user_id'
        ) 
    );
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入公告标题'
            )
        ),
        'content' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => '请输入公告标题'
            )
        )
    );
}
?>