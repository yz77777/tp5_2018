<?php
namespace app\home\controller;
use think\Controller;
use app\home\logic;
use think\Loader;
use think\Debug;
class Download extends Controller
{
	public function index()
	{
		echo '<a href="batch">下载</a>';
	}

	public function batch()
	{

		$DownloadLogic = new logic\DownloadLogic();

		$res = $DownloadLogic->csvWrite();

		if($res['status'] == 'success'){

			$data = $res['data'];
			$file = $data['file_path'];
			$DownloadLogic->csvDownload($file);
		}

	}

	public function xls() {

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
	}

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
		$file = ROOT_PATH."visit.xlsx";
		$DownloadLogic->readyFile($file);
		die;
	}

	public function crm() {
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->crmHandl();
		die;
	}


}