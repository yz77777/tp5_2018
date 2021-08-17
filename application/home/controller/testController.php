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
use app\home\service\impl\LoginServiceImpl;
use app\home\service\LoginService;
use think\Cache;
use think\cache\Driver;
use think\cache\driver\Redis;
use think\Controller;
use app\home\factory;
use app\home\interfaces;
use app\home\logic\TestLogic;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use think\Exception;
use wyz\RedisLock;

class TestController extends Controller
{



	public function index() {

		$a = 100; // 本金
		$b = 15; // 赠金

		$c = 21; // 限额

		// 本金占总金额比例
//		$rale = round($a / ($a + $b), 6);
		$rale = bcdiv($a , bcadd($a, $b, 2), 10);

		$split_order_number = ceil(($a + $b) / $c);
		dump("本金：". $a  . " 赠金：" . $b . " 本订单拆分数量：" . $split_order_number . " 本金占总金额比例：" . $rale);


		for ($i = 1; $i <= $split_order_number; $i++) {
			$this->split($a, $b, $c, $rale);
		}

	}

	private function split(&$deposit_amount, &$gift_amount, $limit_amount, $rale) {

		$t_deposit_amount = bcmul($limit_amount, $rale, 2);
		$t_gift_amount = bcsub($limit_amount, $t_deposit_amount, 2);

		if (bccomp(bcadd($deposit_amount, $gift_amount, 2), $limit_amount, 2) <= 0) {
			$t_deposit_amount = $deposit_amount;
			$t_gift_amount = $gift_amount;
		}

		// 剩余金额
		$deposit_amount = bcsub($deposit_amount, $t_deposit_amount, 2);
		$gift_amount = bcsub($gift_amount, $t_gift_amount, 2);

		dump("拆本金：" . $t_deposit_amount . ' 拆赠金：'. $t_gift_amount . ' 总金额：'. bcadd($t_deposit_amount, $t_gift_amount, 2)
			. ' 剩余本金：'. $deposit_amount . ' 剩余赠金：' . $gift_amount . ' 剩余总金额：' . bcadd($deposit_amount, $gift_amount, 2));
	}


	public function async() {

//		$server = new \Swoole\Server(string $host, int $port = 0, int $mode = SWOOLE_PROCESS, int $sockType = SWOOLE_SOCK_TCP);
//		$serv = new Swoole\Server('127.0.0.1', 9501);

		$host = '0.0.0.0';
		$port = 9501;
		$serv = new swoole_server($host,$port) ;

		exit;
	}



	public function redis() {
		$key = "text_lock";
		$redisLock = new RedisLock();
		try {
			if ($redisLock->lock($key, 30, 1)) {
				dump('成功');
			} else {
				dump('处理中，请稍候再试');
			}
		} finally {
			$redisLock->releaseLock($key);
		}
		die;
	}

	/**
	 * 锁
	 * @param string $key
	 * @param int $expire 过期时间（秒）
	 * @param int $sleepMillis 沉睡时间（秒）
	 * @return bool
	 */
	private function lock($key, $expire, $sleepMillis) {
		$redis = new Redis();

		$handler = $redis->handler();
		$result = $handler->set($key, true, ['nx', 'ex'=>$expire]);

		for ($startTime = time(); !$result && time() - $startTime < $expire; $result = $handler->set($key, true, ['nx', 'ex'=>$expire])) {

			try {
				sleep($sleepMillis);
			} catch (\Exception $e) {
				return false;
			}
		}
		return $result;
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

    public function filterFun() {

//    	$Driver = new Driver();

    	Driver::has('1');


    	die;
    }

    public function userLogin() {
    	$loginService = new LoginServiceImpl();
	    $result = $loginService->userLogin('', '');

	    dump($result);

	    die;
    }


}