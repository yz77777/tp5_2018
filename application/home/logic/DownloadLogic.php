<?php
namespace app\home\logic;
use think\Loader;
use app\commonModel;

class DownloadLogic
{
	/**
	 * csv 指定文件下载
	 * @param $file
	 */
	public function csvDownload($file){

		// 下载方式一
		/*header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		@readfile($file);
		exit();*/

		// 下载方式二
		$fileinfo = pathinfo($file);
		header('Content-type: application/x-'.$fileinfo['extension']);
		header('Content-Disposition: attachment; filename='.$fileinfo['basename']);
		header('Content-Length: '.filesize($file));
		readfile($file);
		// 下载完成后，删除文件
		unlink($file);
		exit();
	}

	/**
	 * 获取毫秒时间戳
	 * @return float
	 */
	private function millisecondTime() {
		list($msec, $sec) = explode(' ', microtime());
		$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
		return $msectime;
	}

	/**
	 * 下载用户列表
	 * @return array
	 */
	private function getUserDownHead() {
		$headArr = array(
			'user_id' => '编号',
			'phone' => '手机号',
			'user_name' => '用户名',
			'email' => '邮箱',
		);
		return $headArr;
	}

	/**
	 * csv文件批量下载方法
	 * @param $downloadType
	 * @param $whereArr
	 * @throws \PHPExcel_Writer_Exception
	 */
	public function csvDownloadBatch($downloadType, $whereArr) {

		$downFile = $this->csvDownWrite($downloadType, $whereArr);

		if(!empty($downFile)){

			$fileInfo = pathinfo($downFile);
			header('Content-type: application/x-'.$fileInfo['extension']);
			header('Content-Disposition: attachment; filename='.$fileInfo['basename']);
			header('Content-Length: '.filesize($downFile));
			readfile($downFile);
			// 下载完成后，删除文件
			unlink($downFile);
			exit();
		} else {
			exit("ERROR");
		}
	}

	/**
	 * 分页查询并批量写入csv文件
	 * @param $downloadType
	 * @param $whereArr
	 * @return string 下载文件地址
	 * @throws \PHPExcel_Writer_Exception
	 */
	private function csvDownWrite($downloadType, $whereArr)
	{
		// 不限请求时间
		set_time_limit(0);

		// 后缀
		$suffix='.csv';

		// 下载文件临时目录
		$dirPath = RUNTIME_PATH . 'downloadTemp/';

		//文件名称
		$fileName = $this->getFileName($downloadType);

		// 下载文件
		$downFile = $dirPath.$fileName.$suffix;

		//指定目录不存在，则创建
		if(!is_dir($dirPath)){
			mkdir($dirPath);
			if(!is_dir($dirPath)){
				exit("directory does not exist");
			}

		}

		// 每页条数，每次只从数据库取5000条以防变量缓存太大
		$pageCount = 5000;

		// 数据条数
		$dataCount = 0;

		// 标题
		$headArr = array();
		switch ($downloadType) {
			case 'user':
				$UserModel = new commonModel\UserModel();
				$dataCount = $UserModel->getUserPageCount($whereArr);
				$headArr = $this->getUserDownHead();
				break;
		}

		// 获取总页数
		$pageSize = ceil($dataCount / $pageCount);

		// 标题文件
		$csvFileHead = $dirPath.$fileName . '_0' . $suffix;

		// 生成标题临时文件
		$this->csvWriteHead($csvFileHead, $headArr);

		// 当前下载所有的临时文件
		$csvFileArr = [$csvFileHead];

		// 分页获取数据
		for ($i = 1; $i <= $pageSize; $i++) {

			// 生成临时文件名称和路径
			$temp_file_path = $dirPath.$fileName . '_' . $i . $suffix;

			// 获取要下载的数据
			$dataList = array();
			switch ($downloadType) {
				case 'user':
					// 获取用户列表
					$UserModel = new commonModel\UserModel();
					$dataList = $UserModel->getUserPageList($whereArr, $i, $pageCount);
					break;
			}
			// 内容写入
			$this->csvWriteContent($temp_file_path, $headArr, $dataList);

			$csvFileArr[]=$temp_file_path;
		}

		// 合并所有临时文件
		$this->csvMergeOnly($downFile, $csvFileArr);

		// 异步处理，删除20分之前的垃圾文件
		$this->csvRecycleBinDelete($dirPath);

		return $downFile;
	}

	/**
	 * 生成CSV临时文件 - 标题
	 * @param $csvFileHead
	 * @param $headArr
	 */
	private function csvWriteHead($csvFileHead, $headArr) {
		$head = [];
		//过滤编码
		foreach ($headArr as $k => $v) {
			$head[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $v);
		}

		// 生成临时文件
		$fp = fopen($csvFileHead, 'w');
		fputcsv($fp, $head);
		//每生成一个文件关闭
		fclose($fp);
	}

	/**
	 * 生成CSV临时文件 - 内容
	 * @param $filePath
	 * @param $headArr
	 * @param $dataList
	 */
	private function csvWriteContent($filePath, $headArr, $dataList) {
		// 打开临时文件
		$fp = fopen($filePath, 'w');

		// 遍历数据写入文件中
		foreach ($dataList as $val) {

			$newVal = [];
			foreach ($headArr as $k=>$v) {
				$value = isset($val[$k]) ? $val[$k] : "";
				// 编码转换
				if ($value) {
					$newVal[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $value);
				} else {
					$newVal[$k] = $val[$k];
				}
			}

			// 数据写入临时文件中
			fputcsv($fp, $newVal);
		}

		//每生成一个文件关闭
		fclose($fp);
		return;
	}

	/**
	 * 所有临时csv文件合成一个
	 * @param $downFile
	 * @param $csvFileArr
	 */
	private function csvMergeOnly($downFile, $csvFileArr) {
		// 临时文件合并成一个文件
		foreach ($csvFileArr as $value){

			$handle2 = fopen($value,'r');

			if($str = fread($handle2,filesize($value))){
				fclose($handle2);

				$handle3 = fopen($downFile,'a+');
				if(fwrite($handle3, $str)){
					fwrite($handle3,"");
					fclose($handle3);
				}
			}

			// 删除临时文件
			if(is_file($value)){
				unlink($value);
			}
		}
		return;
	}

	/**
	 * 删除垃圾文件
	 * @param $dirPath
	 */
	private function csvRecycleBinDelete($dirPath) {
		$dateFormat = "YmdHis";
		// 当前时间 -10 分钟
		$beforeTime = date($dateFormat, strtotime('-10 minute'));

		// 打开待操作的文件夹句柄
		$handle1 = opendir($dirPath);
		// 提取需要合并的文件
		while(($resVal = readdir($handle1)) !== false){

			if($resVal != '.' && $resVal != '..'){

				$filePath = rtrim($dirPath,'/').'/'.$resVal;

				// 如果是文件
				if(is_file($filePath)){
					// 获取当前文件创建时间
					$file_time = date ( $dateFormat, filemtime ( $filePath ) );

					// 删除当前之前下载文件
					if($beforeTime >= $file_time){
						unlink($filePath);
						continue;
					}
				}
			}
		}
		//关闭句柄
		@closedir ( $handle1 );
		return;
	}

	/**
	 * 获取文件名称
	 * @param $downloadType - 下载数据类型
	 * @return string 返回文件名称
	 */
	private function getFileName($downloadType) {
		return $downloadType.'_'.$this->millisecondTime().mt_rand(1000,9999);
	}

	/**
	 * xls 标题写入
	 * @param $objPHPExcel
	 * @param $headArr
	 * @return mixed
	 */
	private function xlsWriteHead($objPHPExcel, $headArr) {
		$row = "A";
		foreach ($headArr as $val) {
			$rowTemp = $row . '1';

			$objPHPExcel->getActiveSheet()->getStyle($rowTemp)->getFont()->setName('宋体')->setSize(14)->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue($rowTemp, $val['name']);//第一行数据

			$width = isset($val['width']) ? $val['width'] : "";
			if ($width) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($row)->setWidth($width);
			}

			$row++;
		}
		return $objPHPExcel;
	}

	/**
	 * xls 内容写入
	 * @param $objPHPExcel
	 * @param $headArr
	 * @param $dataList
	 * @param $row - 行数
	 */
	private function xlsWriteContent($objPHPExcel, $headArr, $dataList, $row) {
		foreach ($dataList as $val) {
			$col = "A";
			foreach ($headArr as $k => $v) {
				$colTemp = $col . $row;

				$value = isset($val[$k]) ? $val[$k] : "";

				$objPHPExcel->getActiveSheet()->setCellValue($colTemp, $value);

				$col++;
			}
			$row++;
		}
		return;
	}

	/**
	 * xls 下载
	 * @param $fileName
	 * @param $headArr
	 * @param $dataList
	 * @throws \PHPExcel_Writer_Exception
	 */
	public function xlsDownload($fileName, $headArr, $dataList) {
		$suffix='.xlsx';
		$time = date("YmdHis");
		$fileName = empty($fileName) ? $time : $fileName."_".$time;
		vendor("PHPExcel.PHPExcel");

		$objPHPExcel = new \PHPExcel();
		$objWrite = new \PHPExcel_Writer_Excel2007($objPHPExcel);

		$this->xlsWriteHead($objPHPExcel, $headArr);

		$this->xlsWriteContent($objPHPExcel, $headArr, $dataList, 2);

		ob_end_clean();//清除缓冲区,避免乱码
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/download");
		header('Content-type: application/xlsx');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$fileName.$suffix);
//		header('Content-Length: '.filesize(''));
		$objWrite->save('php://output');
		return;
	}

	/**
	 * 读取Excel文件
	 * @param $filePath
	 * @return array
	 * @throws \PHPExcel_Reader_Exception
	 */
	public function xlsRead($filePath) {
		vendor("PHPExcel.PHPExcel");
//		dump($filePath);die;
		$fileInfo = pathinfo($filePath);

		$extensionArr = array('xlsx');
		if (!in_array($fileInfo['extension'], $extensionArr)) {
			die("文件类型不支持");
		}

		$type = "Excel2007";

		$objReader = \PHPExcel_IOFactory::createReader($type);
		$objPHPExcel = $objReader->load($filePath);

		$sheet = $objPHPExcel->getSheet(0);

		// 返回列（字母）
		$allColumn = $sheet->getHighestColumn();
		// 返回行（数字）
		$allRow = $sheet->getHighestRow();

//		$phpexcel_shared_date = new \PHPExcel_Shared_Date();
		$data = array();
//var_dump($allColumn);die;
		for($colIndex = 1; $colIndex <= $allRow; $colIndex++){
			for ($rowIndex = "A"; $rowIndex <= $allColumn; $rowIndex++) {
				$str = (string)$sheet->getCell($rowIndex.$colIndex)->getValue();

//				if ($colIndex > 1 && in_array($rowIndex, array('G'))) {
//					$str = $phpexcel_shared_date->ExcelToPHP($str,true,true);
//				}

				$data[$colIndex][] = $str;

			}
		}
//		dump($data);die;
		return $data;
	}
}