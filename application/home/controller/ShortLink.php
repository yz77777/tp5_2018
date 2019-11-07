<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2018/8/3
 * Time: 下午3:27
 */
namespace app\home\controller;
use app\home\model\linksModel;
use think\Controller;
use think\db;

class ShortLink extends Controller
{
	public function index()
	{

		$linksModel = new linksModel();
		$a = $linksModel->find()->toArray();

		dump($a);
		dump($linksModel->getLastSql());
		die;

//		$info = Db::query('select * from yz_links where id=:id',['id'=>8]);
		$info = Db::query('select * from yz_links where keyword=:keyword',['keyword'=>'eleqhnaa']);
		dump($info);
//		$this->shorturl('http://baidu.com');
	}

	public function create()
	{
		$postdata = $_POST;

		$url = $postdata['url'];

		$info = Db::query('select * from yz_links where url=:url',['url'=>$url]);

		if ($info && $info[0] && $info[0]['keyword']) {
			return json_encode(array('short_link'=>$info[0]['keyword']));

		} else {
			$urlArr = $this->shorturl($url);
			$keyword = $urlArr[1];
			$arr = array(
				'url' => $url,
				'keyword' => $keyword,
				'type_link' => 'system',
				'create_time' => date('Y-m-d H:i:s'),
				'update_time' => date('Y-m-d H:i:s'),
			);

			if ($info && $info[0] && empty($info[0]['keyword'])) {
				$res_data = Db::execute("update yz_links set keyword=:keyword where url=:url", ['url'=>$url,'keyword'=>$keyword]);

			} else {
				$res_data = Db::execute('insert into yz_links (url,keyword,type_link,create_time,update_time) values (:url, :keyword,:type_link,:create_time,:update_time)',$arr);

			}

			if ($res_data) {
				return json_encode(array('short_link'=>$keyword));

			} else {
				return json_encode(array('msg'=>'失败'));
			}
		}

	}

	public function shorturl($input) {
		$key = 'yz2008';
		$base32 = array (
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
			'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
			'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
			'y', 'z', '0', '1', '2', '3', '4', '5'
		);

		$hex = md5($key.$input);
		$hexLen = strlen($hex);
		$subHexLen = $hexLen / 8;
		$output = array();

		for ($i = 0; $i < $subHexLen; $i++) {
		//把加密字符按照8位一组16进制与0x3FFFFFFF(30位1)进行位与运算
			$subHex = substr ($hex, $i * 8, 8);

			$int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
			$out = '';

			for ($j = 0; $j < 8; $j++) {

		//把得到的值与0x0000001F进行位与运算，取得字符数组chars索引
				$val = 0x0000001F & $int;
				$out .= $base32[$val];
				$int = $int >> 5;
			}

			$output[] = $out;
		}

		return $output;
	}
}