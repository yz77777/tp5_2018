<?php
namespace app\home\logic;
use app\home\model;
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
	 * csv数据写入
	 * @return array
	 */
	public function csvWrite()
	{
		// 不限请求时间
//		set_time_limit(0);

		$res = array('status'=>'fail','msg'=>'');

		$suffix='.csv';

		// 下载文件临时目录
		$dirPath = RUNTIME_PATH . 'download/';
//var_dump($dirPath);die;
		$fileName = '用户列表';

		//指定目录不存在，则创建
		if(!is_dir($dirPath)){
			mkdir($dirPath);
			if(!is_dir($dirPath)){
				$res['msg'] = 'directory does not exist';
				return $res;
			}
		}

		// 获取数据总数
		$where = array(
			'mobile'=>''
		);
//		$memberModel = new model\memberModel();
//		$dataCount = $memberModel->memberCount($where);
		$dataCount = 100;
		if($dataCount < 1){
			$res['msg'] = 'data not';
			return $res;
		}

		//文件名称追加日期
		$fileName = $fileName.'_'.date('md_His').mt_rand(1,100);

		$filePath = $dirPath.$fileName;

		// 每次只从数据库取2万条以防变量缓存太大
		$sqlLimit = 1;

		// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 10000;

		// buffer计数器
		$cnt = 0;

		// 生成标题临时文件
		$this->_csvWriteHead($filePath, $suffix);

		// 分页获取数据
		for ($i = 0; $i < ceil($dataCount / $sqlLimit); $i++) {

			// 临时文件名称
			$temp_mark = $i + 1;
			$temp_file_path = $filePath . '_' . $temp_mark . $suffix;

			// 生成内容临时文件
			$this->_csvWriteContent($temp_file_path, $where, $i, $sqlLimit);

		}

		// 合并所有临时文件
		return $this->csvMerge($dirPath, $fileName, $suffix);

	}


	/**
	 * 临时文件写入数据
	 * @param $filePath 文件路径（名称）
	 * @param $p
	 * @param $pageSize
	 * @return int
	 */
	private function _csvWriteContent($filePath, $where, $p, $pageSize){
//		$memberModel= new model\memberModel();
//		$dataArr = $memberModel->memberPage($where, $p, $pageSize);

		$dataArr = array(
			array('name'=>'吴','sex'=>'男'),
			array('name'=>'谢','sex'=>'女'),
		);


		if(empty($dataArr)){
			return 0;
		}

		// 打开临时文件
		$fp = fopen($filePath, 'w');

		// 遍历数据写入文件中
		foreach ($dataArr as $val) {

//			$cnt++;
//			if ($limit == $cnt) {
			//刷新一下输出buffer，防止由于数据过多造成问题
//				ob_flush();
//					flush(); // 这个函数会影响下载
//				$cnt = 0;
//			}


			// 编码转换
			foreach ($val as $k => $v) {
				if ($v) {
					$val[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $v);
				} else {
					$val[$k] = $v;
				}

			}

			// 数据写入临时文件中
			fputcsv($fp, $val);
		}

		//每生成一个文件关闭
		fclose($fp);

		return 1;
	}

	/**
	 * 生成CSV文件标题
	 * @param $filePath
	 * @param $suffix
	 * @return int
	 */
	private function _csvWriteHead($filePath, $suffix){
		$head = array(
			'member_id'=>'账号ID',
			'realname'=>'姓名',
			'nickname'=>'微信昵称',
			'mobile'=>'手机号',
			'created_at'=>'注册时间',
		);

		//过滤编码
		foreach ($head as $k => $v) {
			$head[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $v);
		}

		// 生成临时文件
		$fp = fopen($filePath .'_0'. $suffix, 'w');
		fputcsv($fp, $head);
		//每生成一个文件关闭
		fclose($fp);

		return 1;
	}

	/**
	 * 合并文件
	 * @param $dirPath
	 * @param $fileName
	 * @param string $suffix
	 * @return array
	 */
	private function csvMerge($dirPath, $fileName, $suffix){
		$res = array('status'=>'error','msg'=>'');
		$filetime = array();
		$filePathArr = array();

		//这个是需要下载的文件
		$newFilePath = rtrim($dirPath,'/').'/'.$fileName.$suffix;

		// 如果要下载的文件存在，则删除
		if(is_file($newFilePath)){
			unlink($newFilePath);
		}

		$beforeTime = date('Y-m-d H:i:s', strtotime('-600 seconds'));

		// 打开待操作的文件夹句柄
		$handle1 = opendir($dirPath);
		// 提取需要合并的文件
		while(($resVal = readdir($handle1)) !== false){

			if($resVal != '.' && $resVal != '..'){

				$filePath = rtrim($dirPath,'/').'/'.$resVal;
				// 如果是文件，提出文件内容，写入目标文件
				if(is_file($filePath)){

					$file_time = date ( "Y-m-d H:i:s", filemtime ( $filePath ) );

					// 删除当前之前下载文件
					if($beforeTime >= $file_time){
						unlink($filePath);
						continue;
					}

					// 过滤不需要的文件
					if(!strstr(basename($filePath), $fileName)){
						continue;
					}

					// 获取文件最近修改日期
					$filetime[] = $file_time;

					// 获取需要合并的文件
					$filePathArr[] = $filePath;

				}

			}

		}
		//关闭句柄
		@closedir ( $handle1 );

		//按时间排序
		array_multisort($filetime,SORT_DESC, SORT_STRING, $filePathArr);
//dump($filePathArr);die;
		if(empty($filePathArr)){
			$res['msg']='没有需要合并的文件';
			return $res;
		}

		// 临时文件合并成一个文件
		foreach ($filePathArr as $value){

			$handle2 = fopen($value,'r');

			if($str = fread($handle2,filesize($value))){
				fclose($handle2);

				$handle3 = fopen($newFilePath,'a+');
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


		$res['status']='success';
		$res['data'] = array(
			'file_path'=>$dirPath.$fileName.$suffix,
		);

		return $res;

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
//		set_time_limit(0);
//		ini_set("memory_limit", "1024M");

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
		$objPHPExcel->getActiveSheet()->setTitle($workSheet .'1');
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

	public function csvDownExcel($excelFileName, $tableHeader, $tableData) {

		$suffix='.csv';

		// 下载文件临时目录
		$dirPath = RUNTIME_PATH . 'download/';

		// 文件名称追加日期
		$fileName = $excelFileName.'_'.date('md_His').mt_rand(1,100);

		// 文件路径
		$filePath = $dirPath.$fileName;

		/*$head = array(
			'member_id'=>'账号ID',
			'realname'=>'姓名',
			'nickname'=>'微信昵称',
			'mobile'=>'手机号',
			'created_at'=>'注册时间',
		);

		//过滤编码
		foreach ($head as $k => $v) {
			$head[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $v);
		}

		// 生成临时文件
		$fp = fopen($filePath .'_0'. $suffix, 'w');
		fputcsv($fp, $head);
		//每生成一个文件关闭
		fclose($fp);*/

		$headTitle = $this->handelHead($tableHeader);

		vendor('PHPExcel.PHPExcel');
		$objPHPExcel = new \PHPExcel();

		$filePath = $dirPath.'aawwrr2.csv';

		if (!is_file($filePath)) {
//			$objWriterCSV = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
//			$objWriterCSV->save($filePath);

//			$objReader = \PHPExcel_IOFactory::createReader('CSV');
//			$objReaderFile = $objReader->setInputEncoding('GBK')->load($filePath);

			foreach ($headTitle as $key=>$val) {
				$objPHPExcel->getSheet()->getCell($key.'1')->setValue($val['title']);

			}

			$objWriterCSV = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
			$objWriterCSV->setUseBOM(true);
			$objWriterCSV->save($filePath);

		}


//unset($filePath);




		die;
		$objReader = \PHPExcel_IOFactory::createReader('CSV');
		$objReaderFile = $objReader->setInputEncoding('GBK')->load($filePath);

		$countLimit = $objReaderFile->getSheet()->getHighestRow();

		$objReaderFile->getSheet()->getCell('A1')->setValue('aaaaa');
//die;
		$objWriterCSV = \PHPExcel_IOFactory::createWriter($objReaderFile, 'CSV');
		$objWriterCSV->setUseBOM(true);
		$objWriterCSV->save($dirPath.'/aa.csv');

			die;
		// 读取文件
		// 打开待操作的文件夹句柄
		$handle1 = opendir($dirPath);
		// 提取需要合并的文件
		while(($resVal = readdir($handle1)) !== false){

			if($resVal != '.' && $resVal != '..'){

				$filePath = rtrim($dirPath,'/').'/'.$resVal;
				// 如果是文件，提出文件内容，写入目标文件
				if(is_file($filePath)){

					$file_time = date ( "Y-m-d H:i:s", filemtime ( $filePath ) );

					// 删除当前之前下载文件
					/*if($beforeTime >= $file_time){
						unlink($filePath);
						continue;
					}*/

					// 过滤不需要的文件
					if(!strstr(basename($filePath), $fileName)){
						continue;
					}

					// 获取文件最近修改日期
					$filetime[] = $file_time;

					// 获取需要合并的文件
					$filePathArr[] = $filePath;

				}

			}

		}
		//关闭句柄
		@closedir ( $handle1 );

	}
}