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
		$fileName = $downloadType.'_'.$this->millisecondTime().mt_rand(1000,9999);

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
	 * xls 下载
	 * @param $downloadType
	 * @param $whereArr
	 */
	public function xlsDownloadBatch($downloadType, $whereArr) {
		set_time_limit(0);

		// 后缀
		$suffix='.xlsx';

		// 下载文件临时目录
		$dirPath = RUNTIME_PATH . 'downloadTemp/';

		//文件名称
		$fileName = $downloadType.'_'.$this->millisecondTime().mt_rand(1000,9999);

		// 下载文件
		$downFile = $dirPath.$fileName.$suffix;

		vendor("PHPExcel.PHPExcel");
		$objPHPExcel = new \PHPExcel();
		$objWrite = new \PHPExcel_Writer_Excel2007($objPHPExcel);

		// 每页条数
		$pageSize = 1;
		// 初始下载数据条数
		$dataCount = 0;
		// 标题
		$headArr = [];

		switch ($downloadType) {
			case "user":
				$headArr = $this->getUserDownHead();
				$UserModel = new commonModel\UserModel();
				$dataCount = $UserModel->getUserPageCount($whereArr);
				break;
		}

		// 分多少页
		$pageLimit = ceil($dataCount / $pageSize);

		$objPHPExcel->setActiveSheetIndex(0);
		// 工作表名称
		$objPHPExcel->getActiveSheet()->setTitle($downloadType .'_1');

		// 标题写入
		$this->xlsWriteHead($objPHPExcel, $headArr);

		$dataList = [];
		// 行数，内容从第2行开始写入
		$row = 2;
		for ($p = 1; $p <= $pageLimit; $p++) {
			switch ($downloadType) {
				case "user":
					$UserModel = new commonModel\UserModel();
					$dataList = $UserModel->getUserPageList($whereArr, $p, $pageSize);
					break;
			}

			// 写入内容
			$this->xlsWriteContent($objPHPExcel, $headArr, $dataList, $row);
			$row = $row + count($dataList);
		}

		// 保存
		$objWrite->save($downFile);

		$fileInfo = pathinfo($downFile);
		header('Content-type: application/x-'.$fileInfo['extension']);
		header('Content-Disposition: attachment; filename='.$fileInfo['basename']);
		header('Content-Length: '.filesize($downFile));
		readfile($downFile);
		// 下载完成后，删除文件
		unlink($downFile);
		exit();
	}

	/**
	 * xls 标题写入
	 * @param $objPHPExcel
	 * @param $headArr
	 * @return mixed
	 */
	private function xlsWriteHead($objPHPExcel, $headArr) {
		$row = "A";
		foreach ($headArr as $key => $val) {
			$rowTemp = $row . '1';

			$objPHPExcel->getActiveSheet()->getStyle($rowTemp)->getFont()->setName('宋体')->setSize(14)->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue($rowTemp, $val);//第一行数据

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
	 * xls文件下载
	 * @param $excelFileName    文件名
	 * @param $tableHeader      array( array('title'=>'姓名','title_code'=>'name','width'=>20), array('title'=>'姓名','title_code'=>'name') ) || array('name'=>'姓名','sex'=>'性别')
	 * @param $data             array( array('name'=>'吴','sex'=>'男'), array('name'=>'谢','sex'=>'女') )
	 * @param string $workSheet 工作表名称
	 * @param int $limitPage    工作表最大条数数据
	 * @return bool
	 * @throws \PHPExcel_Exception
	 * @throws \PHPExcel_Writer_Exception
	 */
	public function xlsDownExcel($excelFileName, $tableHeader, $data, $workSheet = null, $limitPage = 10000)
	{
		set_time_limit(0);

		vendor("PHPExcel.PHPExcel");
		$objPHPExcel = new \PHPExcel();

		if (!is_array($data)) {
			$data = array();
		}
		if (!is_array($tableHeader)) {
			$tableHeader = array();
		}

		if (empty($workSheet)) {
			$workSheet = '工作表';
		}

		$headTitle = $this->handelHead($tableHeader);

		$countPage = ceil(count($data)/$limitPage); // 分多少页

		// 写入第一页数据
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($workSheet .'1'); // 工作表名称
		$objPHPExcel = $this->handleTableTitle($objPHPExcel, $headTitle);
		$objPHPExcel = $this->handleTableData($objPHPExcel, $headTitle, $data, $limitPage);

		// 从第二页数据开始写入
		for ($i = 2; $i <= $countPage; $i++) {
			// 设置worksheet名称
			$objPHPExcelWorksheet = new \PHPExcel_Worksheet($objPHPExcel, $workSheet.$i);
			$objPHPExcel->addSheet($objPHPExcelWorksheet);
			// 切换到当前页
			$objPHPExcel->setActiveSheetIndex($i-1);

			// 生成当前页标题
			$objPHPExcel = $this->handleTableTitle($objPHPExcel, $headTitle);
			// 生成当前页数据
			$objPHPExcel = $this->handleTableData($objPHPExcel, $headTitle, $data, $limitPage);
		}

		// 销毁data
		unset($data);

		// 切换到第一页
		$objPHPExcel->setActiveSheetIndex(0);

		$ondate = date('YmdHis');
		$filename = "{$excelFileName}_{$ondate}.xlsx";
		$write = new \PHPExcel_Writer_Excel2007($objPHPExcel);
		ob_end_clean();//清除缓冲区,避免乱码

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/download");
		header('Content-type: application/xlsx');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
//	header('Content-Length: '.filesize(''));
		$write->save('php://output');
		return true;
	}

	private function handelHead($tableHeader) {
		//表头数组
		$headTitle = array();
		$k = 'A';
		foreach ($tableHeader as $key=>$value) {
			// 判断是一维数组还是二维数组
			if (is_array($value)) {
				$headTitle[$k] = array(
					'title'=>$value['title'],
					'code'=>$value['title_code'],  // 对应数据key
					'width'=>isset($value['width'])?$value['width']:'',
				);
			} else {
				$headTitle[$k] = array(
					'title'=>$value,
					'code'=>$key, // 对应数据key
				);
			}

			$k++;
		}
		return $headTitle;
	}

	/**
	 * 处理标题
	 * @param $objPHPExcel
	 * @param $headTitle
	 * @return mixed
	 */
	private function handleTableTitle($objPHPExcel, $headTitle) {
		foreach ($headTitle as $key => $value) {
			$t_key = $key . '1';

			$width = isset($value['width'])?$value['width']:'';
			if ($width) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($width);
			}

			$objPHPExcel->getActiveSheet()->getStyle($t_key)->getFont()->setName('宋体')->setSize(14)->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue($t_key, $value['title']);//第一行数据

		}
		return $objPHPExcel;
	}

	/**
	 * 处理数据
	 * @param $objPHPExcel
	 * @param $headTitle
	 * @param $data
	 * @param $limitPage
	 * @return mixed
	 */
	private function handleTableData($objPHPExcel, $headTitle, &$data, $limitPage) {
		$w = 2; // 从第二行开始写入数据
		$mark = 1; // 标记循环次数

		foreach ($data as $key => $val) {

			// 超过当前页最大条数据限制，则跳出循环
			if ($mark > $limitPage) {

				break;
			}

			// 对应标题写入数据
			foreach ($headTitle as $k => $v) {
				$code = $v['code'];
				$objPHPExcel->getActiveSheet()->setCellValue($k . $w, $val[$code]);//第$k列 第$j行

			}
			$w++;

			// 删除已读取的数据
			unset($data[$key]);

			$mark++;
		}

		return $objPHPExcel;
	}

	/**
	 * 读取excel
	 * @param $file
	 * @return array
	 * @throws \PHPExcel_Exception
	 * @throws \PHPExcel_Reader_Exception
	 */
	public function readyFile($file) {
		Loader::import("PHPExcel", EXTEND_PATH."PHPExcel");

		if (!file_exists($file)) {
			die("文件不存在");
		}

		$fileInfo = pathinfo($file);

		$extensionArr = array('xlsx');
		if (!in_array($fileInfo['extension'], $extensionArr)) {
			die("文件类型不支持");
		}

		$type = "Excel2007";

		$objReader = \PHPExcel_IOFactory::createReader($type);
		$objPHPExcel = $objReader->load($file);

		$sheet = $objPHPExcel->getSheet(0);

		// 返回列（字母）
		$allColumn = $sheet->getHighestColumn();
		// 返回行（数字）
		$allRow = $sheet->getHighestRow();

		/*
		$ColumnNum = \PHPExcel_Cell::columnIndexFromString($allColumn);     // 列号 转 列数
		for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
			for($colIndex=0;$colIndex<=$ColumnNum;$colIndex++){
				$str = (string)$sheet->getCellByColumnAndRow($colIndex, $rowIndex)->getValue();
				$data[$rowIndex][] = $str;
			}
		}*/

		$phpexcel_shared_date = new \PHPExcel_Shared_Date();
		$data = array();

		for($colIndex=1;$colIndex<=$allRow;$colIndex++){
			for ($rowIndex = "A"; $rowIndex <= $allColumn; $rowIndex++) {
				$str = (string)$sheet->getCell($rowIndex.$colIndex)->getValue();

				if ($colIndex > 1 && in_array($rowIndex, array('G'))) {
					$str = $phpexcel_shared_date->ExcelToPHP($str,true,true);
				}

				$data[$colIndex][] = $str;
			}
		}
		return $data;
	}

	/**
	 * 解析Crm拜访目的
	 * @throws \PHPExcel_Exception
	 * @throws \PHPExcel_Reader_Exception
	 */
	public function crmHandl() {
		$file = ROOT_PATH."visit.xlsx";

		$list = $this->readyFile($file);


		$headerTitle = array(
			'visit_id'          => '拜访ID',
			'hotel_id'          => '酒店ID',
			'hotel_name'        => '酒店名称',
			'hotel_star'        => '酒店星级',
			'office_name'       => '办事处',
			'visit_mm'          => 'MM',
			'visit_time'        => '拜访时间',
			'visit_purpose_1'   => '拜访目的',
			'visit_purpose_2'   => '拜访目的二级',
			'visit_state'       => '拜访状态',
			'visit_content'     => '拜访内容',
		);
		$data = array();

		foreach ($list as $key => $value) {
			if ($key == 1) {
				continue;
			}

			// 目的数据处理
			$zktLogic = new ZKTLogic();
			$visit_purpose_2 = $zktLogic->getVisitExpectLowerLevel($value[8]);
			$visit_purpose_1 = $zktLogic->getVisitPurposeOne($value[7]);
			$visit_state = $zktLogic->active_status_opt($value[9]);

			$data[]=array(
				'visit_id'          => $value[0],
				'hotel_id'          => $value[1],
				'hotel_name'        => $value[2],
				'hotel_star'        => $value[3],
				'office_name'       => $value[4],
				'visit_mm'          => $value[5],
				'visit_time'        => date('Y-m-d',$value[6]),
				'visit_purpose_1'   => $visit_purpose_1,
				'visit_purpose_2'   => $visit_purpose_2,
				'visit_state'       => $visit_state,
				'visit_content'     => $value[10],
			);
		}
//		dump($data);
//		die;
		$this->csvDownExcelFor("crm-酒店跟进记录", $headerTitle, "",'30',$data);
	}
}