<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo "Hello World ! ! !";
    }

    //创建json
    public function createJson(){
        //创建一个数组
        $personArray = array(
            'name' => 'tom',
            'age'  => 18,
            'job'  => 'php',
        );
        //将数组转为json
        $personJson = json_encode($personArray);
        //输出查看json
        dump($personJson);
    }
    //解析json
    public function readJson(){
        //json格式
        $perdonJson = '{"name":"tom","age":18,"job":"php"}';
        //json转为对象
        $personobj = json_decode($perdonJson);
        dump($personobj);
        echo "<hr>";
        $personArray = json_decode($perdonJson,true);   //加上第二个参数，json转为数组
        dump($personArray);
    }

    //生成XML
    public function createXML(){
        //XML字符串的拼接
        $str = '<?xml version="1.0" encoding="utf-8"?>';
        //根标签
        $str .= '<person>';
        $str .= '<name>tom</name>';
        $str .= '<age>18</age>';
        $str .= '<job>php</job>';
        $str .= '</person>';
        //保存为xml
        $rs = file_put_contents('./data.xml',$str);
        //$rs返回的是数字，表示写入文件的长度，不成功返回false
        echo $rs;
    }
    //解析xml
    public function readXML(){
        //获取xml数据，读取文件
        $XMLData = file_get_contents('./data.xml');
        //将xml数据转化为对象
        $objData = simplexml_load_string($XMLData);
        dump($objData);
        //使用对象调用属性
        echo 'name:'.$objData->name.'<br />';
        echo 'age:'.$objData->age.'<br />';
        echo 'job:'.$objData->job.'<br />';
    }
    //测试使用request发送请求
    function testRequest(){
        $url = 'https://www.baidu.com';
        $content = request($url);
        echo 'this is testRequest'.'<br />';
        dump($content);
    }

    //测试天气查询接口
    public function weather(){
        $city = I('get.city');
        //1.确定接口url地址
        $url = 'http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
        //2.判断请求地址(get.post)
        //3.发送请求
        $content = request($url,false);
        //4.对返回值进行处理
        $xmlObj = simplexml_load_string($content);//返回数据为xml格式
        //dump($xmlObj);
        //获取当天天气信息
        $todayInfo = $xmlObj->results->result[0];
        //输出信息
        echo '实时温度：'.$todayInfo->date.'</br>';
    }

    //电话号码归属地信息测试接口
    public function getAreaByPhone(){
        //接收get传过来的号码
        $phone = I('get.phone');
        //1.url地址
        $url = 'http://cx.shouji.360.cn/phonearea.php?number='.$phone;
        //2.判断请求方式
        //3.发送请求
        $content = request($url,false);
        //4.处理数据返回值
        //返回值为json格式
        $content = json_decode($content);//解析为对象
        dump($content);
        //输出信息
        echo "当前号码：".$phone."<br />";
        echo "省份：".$content->data->province."<br />";
    }

    //快递查询测试接口
    public function express(){
        $type = 'yunda';
        $postid = '1200722815552';
        //1.url地址
        $url = 'https://www.kuaidi100.com/query?type='.$type.'&postid='.$postid;
        //2.判断请求
        //3.发送请求
        $content = request($url);
        //4.处理数据返回值
        $content = json_decode($content);    //转为对象格式
        //获取物流信息数据
        $data = $content->data;
        //遍历数据输出每一条数据信息

        //dump($data);
        foreach($data as $key=>$value){
            echo $value->time.'#####'.$value->context.'<br />';
        }
    }
    //发送邮件测试方法
    public function sendTest(){
        //调用function.php里的sendmail
        $rs = sendMail('it_dd_zl','test-one','2711046280@qq.com');
        //接收返回值并进行判定
        if($rs === true){
            echo '发送邮件邮件成功';
        }else{
            echo '发送失败，错误原因为：'.$rs;
        }
    }

    //字符串的截取
    public function testStr(){

    }
    //测试序列化和保存数组文件
    public function writeStr(){

    }
    //反序列化和读取文件
    public function readStr(){

    }

    //获取电话号码归属地信息通过远程API
    public function getAreaByPhoneToApi(){
        //1.接收用户参数
        //2.校验参数
        //3.通过参数查询数据
        //4.根据约定数据格式返回
    }

}