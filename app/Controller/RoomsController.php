<?php
    class RoomsController extends AppController {

        public $name = 'Rooms';
        public $uses = array('Room','Device');
        public $components = array('Paginator');
        public $helpers = array('Paginator');
    
        public function index() {

            $this->Room->unbindModel(array('hasMany' => array('Booking')));
            $this->Paginator->settings = array(
            'Room' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'order' => array('Room.roomname'=>'ASC')    

            ));
            $all_rooms = $this->Paginator->paginate('Room');
            $this->set('all_rooms',$all_rooms);

        }
        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }
            $this->Room->unbindModel(array('hasMany' => array('Booking')));
            $this->Room->unbindModel(array('hasMany' => array('Device')));
            $room = $this->Room->findById($id);
            if (!$room) {
                throw new NotFoundException(__('该研讨室不存在'));
            }

            $this->Paginator->settings = array(
            'Device' => array(
                'paramType' => 'querystring',
                'limit' => 4,
                'fields' => array('Device.id','Room.id','Room.roomname','Device.devicename',
                    'Device.function','Device.produced_date','Device.introduced_date','Device.extra'),
                'conditions' => array('Device.room_id' => $id)
            ));
            $my_devices = $this->Paginator->paginate('Device');
            $this->set('my_devices',$my_devices);
            $this->set('room',$room);
        } 
        

        public function admin_index() {
            $this->layout = 'admin';
            $this->Room->unbindModel(array('hasMany' => array('Booking')));
            $this->Paginator->settings = array(
            'Room' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'order' => array('Room.roomname'=>'ASC')    

            ));
            $all_rooms = $this->Paginator->paginate('Room');
            $this->set('all_rooms',$all_rooms);

        }

        public function admin_list() {
            $this->layout = 'admin';
            $this->Room->unbindModel(array('hasMany' => array('Booking')));
            $this->Paginator->settings = array(
            'Room' => array(
                'paramType' => 'querystring',
                'limit' => 8,
                'order' => array('Room.roomname'=>'ASC')    


            ));
            $all_rooms = $this->Paginator->paginate('Room');

            $this->set('all_rooms',$all_rooms);


        }
        public function admin_view($id = null) {
             $this->layout = 'admin';
            if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }
            $this->Room->unbindModel(array('hasMany' => array('Booking')));
            $this->Room->unbindModel(array('hasMany' => array('Device')));
            $room = $this->Room->findById($id);
            if (!$room) {
                throw new NotFoundException(__('该研讨室不存在'));
            }

            $this->Paginator->settings = array(
            'Device' => array(
                'paramType' => 'querystring',
                'limit' => 4,
                'fields' => array('Device.id','Room.id','Room.roomname','Device.devicename',
                    'Device.function','Device.produced_date','Device.introduced_date','Device.extra'),
                'conditions' => array('Device.room_id' => $id)
            ));
            $my_devices = $this->Paginator->paginate('Device');
            $this->set('my_devices',$my_devices);
            $this->set('room',$room);
        } 

        public function admin_edit($id = null) {
            $this->layout = 'admin';
            if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }

            $room = $this->Room->findById($id);
            if (!$room) {
                throw new NotFoundException(__('该研讨室不存在'));
            }

            $this->Paginator->settings = array(
            'Device' => array(
                'paramType' => 'querystring',
                'limit' => 4,
                'fields' => array('Device.id','Room.id','Room.roomname','Device.devicename',
                    'Device.function','Device.produced_date','Device.introduced_date','Device.extra'),
                'conditions' => array('Device.room_id' => $id)
            ));
            $my_devices = $this->Paginator->paginate('Device');
            $this->set('my_devices',$my_devices);
            $this->set('room_id',$id);
            if ($this->request->is(array('post', 'put'))) {
                $this->Room->id = $id;
                if ($this->Room->save($this->request->data)) {
                    $this->Session->setFlash(__('更新成功'));
                    return $this->redirect(array('action' => 'list','admin' => true));
                }
                $this->Session->setFlash(__('更新失败.'));
            }

            if (!$this->request->data) {
                $this->request->data = $room;
            }

        }

        public function admin_add() {
            $this->layout = 'admin';
            if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->request->data)) {
                $this->Session->setFlash(__('添加成功'));
                return $this->redirect(array('action' => 'list','admin'=>'true'));
            }
            $this->Session->setFlash(__('添加失败'));
        }

        }

        public function admin_delete($id = null) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
            $this->Room->recursive = 1;
            if ($this->Room->delete($id)) {
                $this->Session->setFlash('删除成功！');
            } else {
                $this->Session->setFlash('删除失败！');
            }
             return $this->redirect(array('action' => 'list','admin'=>true));  
                
        }
    }    
?>