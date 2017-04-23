<?php

class BookingsController extends AppController {

    public $name = 'Bookings';
    public $uses = array('User','Room','Booking');
    public $components = array('Paginator');
    public $helpers = array('Paginator','Time');
    
    
	
    public function index() {

        $this->Room->unbindModel(array('hasMany' => array('Booking')));
    	$rooms = $this->Room->find('list',array(
            'fields' => 'Room.roomname',
            'conditions' => array('Room.is_available' => 1)));
    	$this->set('rooms',$rooms);
    	if($this->request->is('post')){
            if(!$this->request->data['Booking']['booking_date']) {
                $this->Session->setFlash('请选择查询日期!');

            }

    		if($this->request->data['Booking']['booking_date']&&$this->request->data['Booking']['room_id']) {


                $date_format = preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$this->request->data['Booking']['booking_date']);
                $date_arr = explode('-', $this->request->data['Booking']['booking_date']);
                $date_today = date("Y-m-d");
                    if($date_format == 1 && checkdate($date_arr[1], $date_arr[2], $date_arr[0])
                        && $this->request->data['Booking']['booking_date'] >= $date_today) {
                       
                    $query_date = $this->request->data['Booking']['booking_date'];
                    $query_room_id = $this->request->data['Booking']['room_id'];
                   
                     $this->Room->unbindModel(array('hasMany' => array('Booking')));

                    $query_room = $this->Room->find('first',array(
                        'fields' => 'Room.roomname',
                        'conditions' => array('Room.id' => $query_room_id)
                        ));
                    $timeslots_booked = $this->Booking->find('list',array(
                        'fields' => array('Booking.timeslot'),
                        'conditions'=>array('Booking.booking_date'=>$query_date,'Booking.room_id' =>$query_room_id)
                        ));
                   $timeslots = array(
                        "08:00-09:00",
                        "09:00-10:00",
                        "10:00-11:00",
                        "11:00-12:00",
                        "12:00-13:00",
                        "13:00-14:00",
                        "14:00-15:00",
                        "15:00-16:00",
                        "16:00-17:00",
                        "17:00-18:00",
                        "18:00-19:00",
                        "19:00-20:00",
                        "20:00-21:00",
                        "21:00-22:00");
                    $this->set('timeslots', $timeslots);
                    $this->set('timeslots_booked', $timeslots_booked);
                    $this->set('query_date',$query_date);
                    $this->set('query_room',$query_room);
                    $this->set('query_room_id',$query_room_id);

                    $this->render('show');
                } else {
                    $this->Session->setFlash("填写格式为从今天开始的YYYY-MM-DD的有效日期！");
                }
             
            }

    	}

	}

    public function add() {
       $booked_times_limit = 6;
       if($this->request->is('post')) {
            $this->request->data['Booking']['user_id'] = $this->Auth->user('id');
            $valid_booked_times = 0;
            $now = date("Y-m-d H:i:s");
            $my_bookings = $this->Booking->find('all',array(
            'fields' =>array('Booking.id','Booking.booking_date','Booking.timeslot'),
            'conditions'=>array('Booking.user_id' => $this->Auth->user('id')),
            ));
            foreach ($my_bookings as $booking) {
                $booked_end_time = 
                    $booking['Booking']['booking_date'].' '.substr($booking['Booking']['timeslot'], 6,5).':00';
                if($booked_end_time > $now) {
                    $valid_booked_times++;
                 }
            }
            if(($valid_booked_times+1) > $booked_times_limit)
            {
                echo $this->Session->setFlash("有效预约次数超过限制！");
                $this->redirect(array('action'=>'index'));
            }
            $this->Booking->create();
            if($this->Booking->save($this->request->data)) {
                echo $this->Session->setFlash("预约成功");
                $this->redirect(array('action'=>'index'));
            } else {
                echo $this->Session->setFlash("预约失败，请重新选择！");
            }
        }
    }

    public function booked_list() {

        $my_id = $this->Auth->user('id');
        $this->User->unbindModel(array('hasMany' => array('Booking')));
        $username = $this->User->find('first',array(
            'fields' => 'User.username',
            'conditions' => array('User.id' => $my_id)
            ));
        $this->set('username',$username);
        $this->Paginator->settings = array(
            'Booking' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'fields' => array('Booking.id','Room.roomname','Booking.booking_date','Booking.created','Booking.timeslot'),
                'conditions' => array('Booking.user_id' => $my_id),
                'order' => array('Booking.booking_date'=>'DESC','Booking.timeslot'=> 'DESC')    

            ));
        $my_bookings = $this->Paginator->paginate('Booking');
        $this->set('my_bookings',$my_bookings);
       
    }

    public function cancel($id) {
          
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Booking->delete($id)) {
            $this->Session->setFlash('操作成功！');
        } else {
            $this->Session->setFlash('操作失败！');
        }
         return $this->redirect(array('action' => 'booked_list'));
    }
    
    //-----------------------------------------------------------------------
    public function admin_index() {
        $this->layout = 'admin';
       $this->Room->unbindModel(array('hasMany' => array('Booking')));
        $rooms = $this->Room->find('list',array(
            'fields' => 'Room.roomname',
            'conditions' => array('Room.is_available' => 1)));
        $this->set('rooms',$rooms);
        if($this->request->is('post')){
            if(!$this->request->data['Booking']['booking_date']) {
                $this->Session->setFlash('请选择查询日期!');

            }

            if($this->request->data['Booking']['booking_date']&&$this->request->data['Booking']['room_id']) {


                $date_format = preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$this->request->data['Booking']['booking_date']);
                $date_arr = explode('-', $this->request->data['Booking']['booking_date']);
                $date_today = date("Y-m-d");
                    if($date_format == 1 && checkdate($date_arr[1], $date_arr[2], $date_arr[0])
                        && $this->request->data['Booking']['booking_date'] >= $date_today) {
                       
                    $query_date = $this->request->data['Booking']['booking_date'];
                    $query_room_id = $this->request->data['Booking']['room_id'];
                   
                     $this->Room->unbindModel(array('hasMany' => array('Booking')));

                    $query_room = $this->Room->find('first',array(
                        'fields' => 'Room.roomname',
                        'conditions' => array('Room.id' => $query_room_id)
                        ));
                    $timeslots_booked = $this->Booking->find('list',array(
                        'fields' => array('Booking.timeslot'),
                        'conditions'=>array('Booking.booking_date'=>$query_date,'Booking.room_id' =>$query_room_id)
                        ));
                   $timeslots = array(
                        "08:00-09:00",
                        "09:00-10:00",
                        "10:00-11:00",
                        "11:00-12:00",
                        "12:00-13:00",
                        "13:00-14:00",
                        "14:00-15:00",
                        "15:00-16:00",
                        "16:00-17:00",
                        "17:00-18:00",
                        "18:00-19:00",
                        "19:00-20:00",
                        "20:00-21:00",
                        "21:00-22:00");
                    $this->set('timeslots', $timeslots);
                    $this->set('timeslots_booked', $timeslots_booked);
                    $this->set('query_date',$query_date);
                    $this->set('query_room',$query_room);
                    $this->set('query_room_id',$query_room_id);

                    $this->render('show');
                } else {
                    $this->Session->setFlash("填写格式为从今天开始的YYYY-MM-DD的有效日期！");
                }
             
            }

        }
    }


    public function admin_add() {
       if($this->request->is('post')) {
            $this->request->data['Booking']['user_id'] = $this->Auth->user('id');
            $this->Booking->create();
            if($this->Booking->save($this->request->data)) {
                echo $this->Session->setFlash("预约成功");
                $this->redirect(array('action'=>'index'));
            } else {
                echo $this->Session->setFlash("预约失败，请重新选择！");
            }
        }
    }

    public function admin_cancel($id) {
          
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Booking->delete($id)) {
            $this->Session->setFlash('操作成功！');
        } else {
            $this->Session->setFlash('操作失败！');
        }
         return $this->redirect(array('action' => 'booked_list'));
    }
    public function admin_delete($id) {
          
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Booking->delete($id)) {
            $this->Session->setFlash('操作成功！');
        } else {
            $this->Session->setFlash('操作成功！');
        }
         return $this->redirect(array('action' => 'list','admin'=>true));
    }


     public function admin_booked_list() {
        $this->layout = 'admin';
        $my_id = $this->Auth->user('id');
        $this->User->unbindModel(array('hasMany' => array('Booking')));
        $username = $this->User->find('first',array(
            'fields' => 'User.username',
            'conditions' => array('User.id' => $my_id)
            ));
        $this->set('username',$username);

        $this->Paginator->settings = array(
            'Booking' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'fields' => array('Booking.id','Room.roomname','Booking.booking_date','Booking.created','Booking.timeslot'),
                'conditions' => array('Booking.user_id' => $my_id),
                'order' => array('Booking.booking_date'=>'DESC','Booking.timeslot'=> 'DESC')    

            ));
        $my_bookings = $this->Paginator->paginate('Booking');
        $this->set('my_bookings',$my_bookings);
       
    }

     public function admin_list() {
        $this->layout = 'admin';

        $this->Paginator->settings = array(
            'Booking' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'fields' => array('Booking.id','User.username','Room.roomname','Booking.booking_date','Booking.timeslot','Booking.created'),
                'order' => array('Booking.booking_date'=>'DESC','Booking.timeslot'=> 'DESC')    

            ));
        $all_bookings = $this->Paginator->paginate('Booking');
        $this->set('all_bookings',$all_bookings);
       
    }
}


?>