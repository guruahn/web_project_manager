<?php
/**
 * TasksController Class
 *
 * @category  Controller
 * @package   Task
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class TasksController extends Controller {

    function view($id = null,$name = null) {
        $this->set('title',$name);
        $post = $this->Post->getPost( "*", array("id"=>$id) );
        $user = new User();
        $post['user_name'] = $user->getUser("name",array('user_id'=>$post["user_id"]));
        $category = new Category();
        $post['category'] = $category->getCategory("*", array('id'=>$post['category_id']));
        $this->set('post',$post);
    }

    function view_all($page_idx, $thispage = null) {
        global $is_API;
        $result = array(
            'result'=>0,
            'list'=>''
        );
        if(is_null($thispage) || empty($thispage)) $thispage = 1;
        $limit = array( ($thispage-1)*10, 100 );

        $where = array( "t.page_idx"=>$page_idx );
        $this->Task->join("user u", "u.idx=t.receiver_idx", "LEFT");
        $column = array("u.idx as u_idx", "u.name as u_name", "t.idx as idx", "t.title as title", "t.status as status");
        $tasks = $this->Task->getList("task t", array('t.insert_date'=>'desc'), $limit, $where, $column);
        if($tasks) {
            $result['result'] = 1;
            foreach($tasks as $task){

            }
            $result['list'] = $tasks;
        }
        if($is_API){
            echo json_encode($result);
        }else{
            return $result;
        }
    }



    function makeState($state){
        $result = array(
            "en"=>"",
            "ko"=>""
        );
        if($state == 1){
            $result["en"] = "ready";
            $result["ko"] = "진행중";
            $result["class"] = "button tiny state0";
        }else if($state == 1){
            $result["en"] = "finish";
            $result["ko"] = "완료";
            $result["class"] = "button tiny alert state1";
        }else if($state == 2){
            $result["en"] = "delete";
            $result["ko"] = "삭제";
            $result["class"] = "button tiny secondary state2";
        }
        return $result;
    }
    function writeForm($project_idx) {
        $limit = array( 0, 1000 );
        $where = array(
            'project_idx'=> $project_idx
        );
        $category = new Category();
        $categories = $category->getList( array('insert_date'=>'asc'), $limit, $where );
        $this->set('project_idx', $project_idx);
        $this->set('categories', $categories);
        $this->set('title','Write  pages');
    }

    function addTask() {
        global $is_API;
        $result = array(
            'result'=>0,
            'idx'=>''
        );
        $due_date = (isset($_POST['due_date'])) ? $_POST['due_date'] : date("Y-m-d");
        $due_date = date("Y-m-d", strtotime($due_date));
        $data = Array(
            "page_idx" => $_POST['page_idx'],
            "title" => $_POST['title'],
            "project_idx" => $_POST['project_idx'],
            "user_idx" => $_SESSION['LOGIN_NO'],
            "receiver_idx"=> $_POST['receiver_idx'],
            "due_date" => $due_date
        );

        $task_id = $this->Task->add($data);
        if($task_id) {
            $result['result'] = 1;
            $result['idx'] = $task_id;
        }
        if($is_API){
            echo json_encode($result);
        }else{
            return $result;
        }
    }

    function del($idx = null, $project_idx) {

        $data = Array(
            "state" => 4,
        );

        $this->Page->updatePost($idx, $data);
        redirect(_BASE_URL_."/pages/view_all/".$project_idx);
    }


    function updateTask($idx = null) {

        $data = Array(
            "link" => $_POST['link'],
            "name" => $_POST['name'],
            "state" => $_POST['state'],
            "description" => $_POST['description'],
            "category_idx" => $_POST['category_idx']
        );
        if( isset($_POST['finish_date']) ) $data["finish_date"] = $_POST['finish_date'];
        $this->Task->updateTask($idx, $data);
        redirect(_BASE_URL_."/pages/view_all/".$_POST['project_idx']);
    }

    function updateStatus($idx = null) {
        global $is_API;
        $result = array(
            'result'=>0
        );
        $data = Array(
            "status" => $_POST['status'],
            "finish_date" => date("Y-m-d")
        );
        $result['result'] = $this->Task->updateTask($idx, $data);
        if($is_API){
            echo json_encode($result);
        }else{
            return $result;
        }
    }

    function sendMail(){
        global $is_API;

        $result = array(
            'result'=>0
        );

        /*
        |
        | Begin sending mail
        |
        */
        $user = new User();
        $user_id = $user->getUser("id",array('idx'=>$_POST["receiver_idx"]));

        $to = $user_id['id'];
        $subject = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR","할일이 추가되었습니다."))."?=";
        // 메세지
        $message = 'Message: '.PHP_EOL.PHP_EOL;
        if(isset($_POST['title']))
        {
            $message.= '할일 추가 : '.$_POST['title'].PHP_EOL;
        }
        if(isset($_POST['due_date']))
        {
            $message.= '기한 : '.$_POST['due_date'].PHP_EOL;
        }
        // 한 줄이 70 문자를 넘어갈 때를 위하여, wordwrap()을 사용해야 합니다.
        $message = wordwrap($message, 70);
        $message = iconv("UTF-8","EUC-KR",$message);

        $headers = 'From: <'.$_SESSION['LOGIN_ID'].'>' . "\r\n" .
            'Reply-To: '.$_SESSION['LOGIN_ID']. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $send = mail($to, $subject, $message, $headers);

        if($send > 0)
        {
            $result['result'] = $send;

            if($is_API){
                echo json_encode($result);
            }else{
                return $result;
            }

            exit;
        }
        else
        {
            echo 'ERROR';
            exit;
        }

        /*
        |
        | End sending mail
        |
        */
    }

}