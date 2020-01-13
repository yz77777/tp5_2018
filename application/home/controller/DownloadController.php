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
	}

	/**
	 * 分页下载数据 csv
	 */
	public function csvBatch()
	{
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->csvDownloadBatch('user', []);
//		$DownloadLogic->csvDownloadBatch('user', ['user_id' => array('elt', 18174)]);
	}

	/**
	 * 指定数据下载 xlsx
	 * @throws \PHPExcel_Writer_Exception
	 */
	public function xls() {
		$fileName = "qq";
		$headArr = array(
			'user_id' => array('name'=> '用户ID', 'width' => 10),
			'phone' => array('name'=> '手机号', 'width' => 15),
			'email' => array('name'=> '邮箱', 'width' => 25),
		);

		$dataList = array(
			array('user_id'=>'1', 'phone'=>13439771795,'email'=>"wuyanzhi@zhiketong.cn")
		);
		$DownloadLogic = new logic\DownloadLogic();
		$DownloadLogic->xlsDownload($fileName, $headArr, $dataList);
	}

	public function xlsRead() {
		$filePath = ROOT_PATH."abc.xlsx";
		$DownloadLogic = new logic\DownloadLogic();
		$dataList = $DownloadLogic->xlsRead($filePath);

//		dump($dataList);

		// 小数据直接分隔
//		dump(implode(",", $dataList));

		// 大数据分页
		$pageLimit = 5000;
		$pageSize = ceil(count($dataList) / $pageLimit);
		dump(count($dataList));


		for ($page = 1; $page <= $pageSize; $page++) {

			$idArr = [];
			$i = 1;
			foreach ($dataList as $k=>$v) {
				$idArr[]=$v;
				unset($dataList[$k]);
				if ($i == 5000) {
					dump(implode(",", $idArr));
					dump(count($idArr));
					break;
				}
				$i++;
			}
			if ($page == $pageSize) {
				dump(implode(",", $idArr));
				dump(count($idArr));
			}
		}

	}

}