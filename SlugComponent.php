<?php
    class SlugComponent extends Component {
        public $components = array('Session');

        function startup(Controller $controller) {

            $this->controller = $controller;

        }

        function checkSlug($model, $slug, $action = "view") {
            //Cake Naming Conventions

            $model = ucfirst($model);
            if (!is_numeric($slug)) { //should be a slug but will handle ID aswell

                return $options = array('conditions' => array($model.'.slug' => $slug));

            } else {
                App::import('Model',$model);
                $this->$model = new $model();
                if (!$this->$model->exists($slug)) {
                    throw new NotFoundException(__('Invalid post'));
                }
                //get the slug and redirect back here
                $slug = $this->$model->findById($slug, array('fields' => 'slug'));

                //$this->Session->setFlash("Redirected from id to Slug"); //just for development
                $this->controller->redirect(array('action' => $action, $slug[$model]['slug']),301);
                return false;

            }
        }

        function idFromSlug($model, $slug) {

            if(!is_numeric($slug)) {
                App::import('Model',$model);
                $this->$model = new $model();
                $post_id = $this->$model->find('first', array('conditions' => array('slug' => $slug)));
                $id = $post_id[$model]['id'];
            } else {
                $id = $slug;
            }
            return $id;
        }
    }
?>
