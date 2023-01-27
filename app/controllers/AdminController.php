<?php

namespace app\controllers;
use app\core\Controller;


class AdminController extends Controller
{


    public function adminAction()
    {

       $this->view->render('Панель Администратора');
    }


}