<?php
namespace app\home\controller;
use think\Controller;
use app\home\logic;
use think\Loader;
use think\Debug;
class DownloadController extends Controller
{
	public function index()
	{
		echo '<a href="csvBatch">csv下载</a>';
		echo '<a href="xlsBatch">xls下载</a>';
	}

	public function csvBatch()
	{
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->csvDownloadBatch('user', []);
	}

	public function xlsBatch() {
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->xlsDownloadBatch('user', []);
	}

	public function xls() {
		$fileName = "aaa";
		$headArr = array('user_id'=>'编号', 'user_name'=>'用户名');
		$dataList = array(
			array('user_id'=>'1')
		);
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->xlsDownload($fileName, $headArr, $dataList);
	}

	public function xlsRead() {
		$filePath = ROOT_PATH."abc.xlsx";
		$DownloadLogic = new logic\DownloadLogic();
		$dataList = $DownloadLogic->xlsRead($filePath);

//		dump($dataList);
		dump(implode(",", $dataList));
	}

	/*public function xls() {

		$DownloadLogic = new logic\DownloadLogic();

		$title = '测试';
		$headerTitle = array(
			'id'=>'ID',
			'name'=>'名字',
			'sex'=>'性别',
		);
		$data = array();
		for ($i=1; $i<=100; $i++) {
			$data[] = array(
				'id'=>$i,
				'name'=>'A_'.$i,
				'sex'=>($i%2)?'男':'女',
			);
		}

		$DownloadLogic->xlsDownExcel($title, $headerTitle, $data,'','20');
		exit;
	}*/

	public function csv() {

		$DownloadLogic = new logic\DownloadLogic();

		$title = '测试';
		$headerTitle = array(
			'id'=>'aID',
			'name'=>'名字',
			'sex'=>'性别',
		);
		$data = array();
		for ($i=1; $i<=120000; $i++) {
			$data[] = array(
				'id'=>$i,
				'name'=>'A_'.$i,
				'sex'=>($i%2)?'男':'女',
			);
		}


		$DownloadLogic->csvDownExcel($title, $headerTitle, $data);
		exit;
	}


	public function csvFor() {

		$DownloadLogic = new logic\DownloadLogic();

		$title = '测试';
		$headerTitle = array(
			'member_id'=>'用户ID',
			'nickname'=>'微信名称',
			'realname'=>'别名',
			'mobile'=>'手机号',
			'created_at'=>'注册时间',
		);


		$DownloadLogic->csvDownExcelFor($title, $headerTitle, 'user', 10000);
		exit;
	}



	public function readyFile() {

		$DownloadLogic = new logic\DownloadLogic();
//		$file = ROOT_PATH."visit.xlsx";
		$file = ROOT_PATH."idlist.xlsx";

		$data = $DownloadLogic->readyFile($file);

		$arr = [];
		foreach ($data as $vo) {
			$arr[]=$vo[0];
		}
//		dump($arr);
		dump(implode(',', $arr));
		die;
	}

	public function crm() {
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->crmHandl();
		die;
	}


}