<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2018/7/31
 * Time: 上午11:43
 */
namespace app\home\controller;
use app\common\Common;
use app\home\logic;
use think\Controller;
use app\home\factory;
use app\home\interfaces;
use app\home\logic\TestLogic;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class TestController extends Controller
{

	public function index(){

		$str='{{ ཨ་ཁུ་སྟོན་པ }}';
//		require_once __DIR__ . '/vendor/autoload.php';
//		// 建立AMQP连接
//		$connection = new AMQPStreamConnection('localhost', 8080, 'guest', 'guest');
//		$channel    = $connection->channel();
//		// 定义队列名称
//		$channel->queue_declare('hello', false, false, false, false);
//		// 定义要发送的信息
//		$msg = new AMQPMessage('Hello World!'.time());
//		// 发送消息
//		$channel->basic_publish($msg, '', 'hello');
//		echo " [x] Sent 'Hello World!'\n";
//		$channel->close();
//		$connection->close();


die;

//		$today =time();   //当前时间戳 6月7号
//		$end_time = '2020-08-08 00:00:00';  //一般由数据库查询出来的活动结束时间
//		$second = strtotime($end_time)-$today; //结束时间戳减去当前时间戳
//		// echo $second;
//		$day = floor($second/3600/24);    //倒计时还有多少天
//		$hr = floor($second/3600%24);     //倒计时还有多少小时（%取余数）
//		$min = floor($second/60%60);      //倒计时还有多少分钟
//		$sec = floor($second%60);         //倒计时还有多少秒
//		$str = $day."天".$hr."小时".$min."分钟".$sec."秒";  //组合成字符串
//
//		dump($second);
//		dump($str);

//		die;


		$f=array(
			'31536000'=>'年',
			'2592000'=>'个月',
			'604800'=>'星期',
			'86400'=>'天',
			'3600'=>'小时',
			'60'=>'分钟',
			'1'=>'秒'
		);
		foreach ($f as $k=>$v){
			if (0 !=$c=floor($t/(int)$k)) {
				dump($c.$v);
				return;
			}
		}

		die;

//		$this->bdUrlAPI(1, 'http://u6.gg');
//		echo '<br/><br/>----------百度短网址API----------<br/><br/>';
//
//		echo 'Long to Short: '.bdUrlAPI(1, 'http://u6.gg').'<br/>';
//
//		echo 'Short to Long: '.bdUrlAPI(0, 'http://360app.ft12.com').'<br/><br/>';
	}


	public function redis() {
		//实例化redis对象
		$redis = new redis();
		//连接redis,第一个参数是redis服务的IP127.0.0.1是自己的,6379是端口号
		$redis->connect('127.0.0.1', 6379);
		echo "Server is running: " . $redis->ping();

		die;
	}

	  /**

    * @author: vfhky 20130304 20:10

    * @description: PHP调用百度短网址API接口

    *     * @param string $type: 非零整数代表长网址转短网址,0表示短网址转长网址

    */

    function bdUrlAPI($type, $url){

	    if($type)

	    {
//	    	$baseurl = 'http://dwz.cn/create.';
	    	$baseurl = 'http://dwz.cn/admin/create';
	    }

	    else

	    {
	    	$baseurl = 'http://dwz.cn/query.php';
	    }

	    $ch=curl_init();

	    curl_setopt($ch,CURLOPT_URL,$baseurl);

	    curl_setopt($ch,CURLOPT_POST,true);

	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

	    if($type)

	    {
	    	$data=array('url'=>$url);
	    }

	    else

	    {
	    	$data=array('tinyurl'=>$url);
	    }

	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

	    $strRes=curl_exec($ch);

	    curl_close($ch);

	    $arrResponse=json_decode($strRes,true);
dump($arrResponse);
	    if($arrResponse['status']!=0)

	    {

	    echo 'ErrorCode: ['.$arrResponse['status'].'] ErrorMsg: ['.iconv('UTF-8','GBK',$arrResponse['err_msg'])."]<br/>";

	    return 0;

	    }
dump($arrResponse);
	    if($type)

	    return $arrResponse['tinyurl'];

	    else

	    return $arrResponse['longurl'];

    }

    public function shareposter() {

    	return view('shareposter_2');
    }


    public function autio() {

    	return view();
    }

    public function log() {
    	$TestLogic = new logic\TestLogic();
    	$TestLogic->logAdd();
    }

	/**
	 * 工厂模式
	 */
    public function myFactory() {

    	$user = factory\UserFactory::createUser();

    	echo $user->getUser();

    	die;
    }

    public function insertUser() {

    	$TestLogic = new logic\TestLogic();
	    $TestLogic->insertUser();
    }

    public function myComposer() {



    }

	/**
	 * 观察者模式
	 */
    public function observer() {
	    $userList = [
		    array('name'=>'李子子', 'type'=>'other'),
		    array('name'=>'小谢同学', 'type'=>'stock'),
		    array('name'=>'二哈', 'type'=>'stock'),
	    ];

    	$SubjectA = new interfaces\SubjectA();

    	foreach ($userList as $value) {
    		$name = $value['name'].'，';
    		$key = $value['name'];
    		switch ($value['type']) {
			    case 'stock':
				    $stock = new interfaces\StockObserver($name, $SubjectA);
				    $SubjectA->attach($key, $stock);
			    	break;
			    default:
			    	// other
				    $colleague = new interfaces\NbaObserver($name, $SubjectA);
				    $SubjectA->attach($key, $colleague);
			    	break;
		    }
	    }

	    $SubjectA->secretaryContent('老板回来了！');
	    $SubjectA->notify();
    	die;
    }

    public function factory() {

    	$Users = new interfaces\Users();
	    $result = $Users->getName(1);
	    dump($result);
    	die;
    }

    public function order() {
	    $TestLogic = new logic\TestLogic();
	    $TestLogic->splitOrder();
    }

    public function getToken() {
    	$TestLogic = new TestLogic();
	    $token = $TestLogic->getToken();
    	dump($token);
    }
    public function getUUID() {
    	$TestLogic = new TestLogic();
	    $orderNo = $TestLogic->getUUID();
	    dump($orderNo);
    }


}