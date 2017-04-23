<?php
    class NoticesController extends AppController {

        public $name = 'Notices';
        public $uses = array('Notice');
        public $components = array('Paginator');
        public $helpers = array('Paginator');
    
        public function index() {

            $this->Paginator->settings = array(
                'Notice' => array(
                    'paramType' => 'querystring',
                    'limit' => 4,
                    'order' => array('Notice.modified' =>'DESC')    

            ));
            $all_notices = $this->Paginator->paginate('Notice');
            $this->set('all_notices',$all_notices);

        }

          public function admin_index() {
            $this->layout = 'admin';
            $this->Paginator->settings = array(
                'Notice' => array(
                    'paramType' => 'querystring',
                    'limit' => 4,
                    'order' => array('Notice.modified' =>'DESC')    

            ));
            $all_notices = $this->Paginator->paginate('Notice');
            $this->set('all_notices',$all_notices);

        }


        public function admin_list() {
             $this->layout = 'admin';
             $this->Paginator->settings = array(
                'Notice' => array(
                    'paramType' => 'querystring',
                    'limit' => 8,
                    'order' => array('Notice.modified' =>'DESC')    

            ));
            $all_notices = $this->Paginator->paginate('Notice');
            $this->set('all_notices',$all_notices);


        }

        public function admin_edit($id = null) {
            $this->layout = 'admin';
            if (!$id) {
                throw new NotFoundException(__('参数非法'));
            }

            $notice = $this->Notice->findById($id);
            if (!$notice) {
                throw new NotFoundException(__('该公告不存在'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Notice->id = $id;
                if ($this->Notice->save($this->request->data)) {
                    $this->Session->setFlash(__('更新成功'));
                    return $this->redirect(array('action' => 'list','admin' => true));
                }
                $this->Session->setFlash(__('更新失败.'));
            }

            if (!$this->request->data) {
                $this->request->data = $notice;
            }

        }

        public function admin_add() {
            $this->layout = 'admin';
            if ($this->request->is('post')) {
            $this->Notice->create();
            if ($this->Notice->save($this->request->data)) {
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
            if ($this->Notice->delete($id)) {
                $this->Session->setFlash(__('删除成功！'));
            } else {
                $this->Session->setFlash(__('删除失败！'));
            }
             return $this->redirect(array('action' => 'list','admin'=>true));  
                
        }
    }    
?>