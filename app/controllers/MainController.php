<?php


namespace app\controllers;
use app\core\Controller;

class MainController extends Controller
{



    public function indexAction()
    {
        $vars = [
            "comments"=>$this->model->showComments(),
        ];
        $this->view->render('Главная',$vars);
    }

    public function commentsAddAction(){
        if(!empty($_POST)){
            if(!$this->model->postValid($_POST)) {
                http_response_code(400);
                exit($this->view->invalidInput(http_response_code(400),$this->model->input, $this->model->errors));
            }
            if(!$this->model->addComment($_POST)) {
                http_response_code(400);
                exit($this->view->message('addFail', 'Ошибка добавления комментария'));
            }
            else {
                http_response_code(200);
                exit($this->view->message('Success', 'Комментарий успешно добавлен.'));
            }
        }
    }
}