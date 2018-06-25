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


}