<?php


namespace app\models;
use app\core\Model;


class Main extends Model
{
    public function postValid($post){
        if(!$this->array_pass($post)) {
            $this->errors[]= 'Поле «Ваше имя» не заполнено';
            $this->input[] = 'username';
            $this->errors[]= 'Поле «Ваш комментарий» не заполнено';
            $this->input[] = 'comment';
            return false;
        }
        $username =  trim(mb_convert_case($_POST['username'], MB_CASE_TITLE, "UTF-8"));
        if(empty($username)) {
            $this->errors[] = 'Поле «Ваше имя» не заполнено';
            $this->input[] = 'username';
        }
        elseif(!preg_match("/^(([a-zA-Z ]{3,30})|([а-яА-ЯЁёІіЇї ]{3,100}))$/u",  $username)) {
          $this->errors[] = 'Поле «Ваше имя» заполнено неправильно';
          $this->input[] = 'username';
        }
        $comment = trim($_POST['comment']);
        if(empty($comment)) {
            $this->errors[] = 'Поле «Ваш комментарий» не заполнено';
            $this->input[] = 'comment';
        }
        elseif(iconv_strlen($comment) < 3 || iconv_strlen($comment) > 300) {
            $this->errors[] = 'Диапазон символов комментария от 3 до 300 символов';
            $this->input[] = 'comment';
        }

        if(!empty($this->errors) && !empty($this->input))
            return false;
        else 
            return true;
    }   
    
    public function addComment($post){
        $username = trim(mb_convert_case($this->pure($post['username'], ENT_QUOTES), MB_CASE_TITLE, "UTF-8"));
        $comment = trim($this->pure($post['comment'], ENT_NOQUOTES));
        {   
            $params = [
                'id' => null,
                'username' => $username,
                'comment' => $comment,
                'time_created_at'=>date("H:i"),
                'date_created_at'=>date("d.m.Y"),
            ];
            $this->db->query('INSERT INTO comments (`id`, `username`, `comment`,`time_created_at`, `date_created_at`)
                            VALUES (:id, :username, :comment, :time_created_at, :date_created_at)', $params);
            return true;
        }
    }
    public function showComments(){
        $comments = $this->db->row('SELECT * FROM  comments');
        return $comments;
    }
}
