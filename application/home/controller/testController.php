<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2018/7/31
 * Time: 上午11:43
 */
namespace app\home\controller;
use app\home\logic;
use think\Loader;
use think\Debug;
use think\Controller;
class TestController extends Controller
{
	public function index(){
		$arr = [200293,200296,200299,200305,200307,200308,200310,200303,200304,191849,200153,196930,200321,199111,200320,199138,200322,200298,184814,199758,46468,200326,200329,190500,200330,200328,200203,200334,200142,49728,199301,200335,200306,200336,41878,200337,200339,200338,200340,200341,200295,200342,200344,196198,200346,200347,196997];

//		$arr = array_unique($arr);
		dump(count($arr));

		die;
		echo 'hello world';die;

		$this->bdUrlAPI(1, 'http://u6.gg');
//		echo '<br/><br/>----------百度短网址API----------<br/><br/>';
//
//		echo 'Long to Short: '.bdUrlAPI(1, 'http://u6.gg').'<br/>';
//
//		echo 'Short to Long: '.bdUrlAPI(0, 'http://360app.ft12.com').'<br/><br/>';
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




}