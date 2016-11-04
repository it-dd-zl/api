<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo "H e l l o   W o r l d  ! ! !";
    }
    //创建json
    public function createJson(){
        //创建一个数组
        $personArray = array(
            'name' => 'tom',
            'age' => '18',
            'job' => 'php',
        );
        //将数组转为json
        $personJson = json_encode($personArray);
        //输出查看json
        dump($personJson);
    }
    //解析json
    public function readJson(){
        $personJson = '{"name":"tom","age":"18","job":"php"}';
        //将json转为对象
        $personObj = json_decode($personJson);
        dump($personObj);
        echo "<hr>";
        //将json转为数组
        $personArray = json_decode($personJson,true);
        dump($personArray);
    }
}