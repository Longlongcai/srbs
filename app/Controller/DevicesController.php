<?php
    class DevicesController extends AppController {

        public $name = 'Devices';
        public $uses = array('Device','Room');
        public $components = array('Paginator');
        public $helpers = array('Paginator');

       
        public function admin_edit($id = null) {
            $this->layout = 'admin';
            if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }

            $device = $this->Device->findById($id);
           
            if (!$device) {
                throw new NotFoundException(__('该设备不存在'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Device->id = $id;
                if ($this->Device->save($this->request->data)) {
                    $this->Session->setFlash(__('更新成功'));
                      return $this->redirect(array('controller'=>'rooms','action' => 'edit','admin' => true,$device['Device']['room_id']));
                } else {
                    $this->Session->setFlash(__('更新失败.'));
                }
              

            }

            if (!$this->request->data) {
                $this->request->data = $device;
            }

        }

        public function admin_add($id=null) {
            $this->layout = 'admin';
             if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }

            $room = $this->Room->findById($id);
            if (!$room) {
                throw new NotFoundException(__('该研讨室不存在'));
            }
            $this->set('room_id',$id);
            if ($this->request->is('post')) {
                $this->Device->create();
                if ($this->Device->save($this->request->data)) {
                    $this->Session->setFlash(__('设备添加成功'));
                     return $this->redirect(array('controller'=>'rooms','action' => 'edit','admin'=>true,$id));
                } else{
                    $this->Session->setFlash(__('设备添加失败'));
                }
           

            }

        }

        public function admin_delete($id = null) {
            if ($this->request->is('get')) {
                throw new MethodNotAllowedException();
            }
            $device = $this->Device->findById($id);
            if (!$device) {
                throw new NotFoundException(__('该设备不存在'));
            }
            if ($this->Device->delete($id)) {
                $this->Session->setFlash('删除成功！');
            } else {
                $this->Session->setFlash('删除失败！');
            }
            return $this->redirect(array('controller'=>'rooms','action' => 'edit','admin' => true,$device['Device']['room_id']));
                
        }
    }    
?>