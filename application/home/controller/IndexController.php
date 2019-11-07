<?php
namespace app\home\controller;
use app\home\logic;
use think\Loader;
use think\Debug;
use think\Controller;
class IndexController extends Controller
{
    /*public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }*/
    public function index()
	{

		$arr = array(93713,93714,93715,93716,93717,93734,93735,93736,93737,93738,93739,93752,93753,93755,93756,93757,93773,93774,93775,93776,93777,93791,93792,93794,93795,93796,93810,93811,93812,93813,93814,93815,93781,4622,93038,93454,93455,93457,93722,93263,93466,93236);
//		echo count($arr);

	    $arr = array(4930,4931,4936,4937,5021,5023,5024,5048,5084,5098,5139,5140,5141,5142,5144,5145,5149,5170,5220,5598,5605,5937,5939,5969,5971,5972,5974,6008,6520,6529,6788,11654,11732,11783,12064,12702,12725,12823,12887,12985,12998,13101,13102,13687,13720,13833,14158,14273,14278,14301,14341,14703,14826,15172,15805,25929,25930,25931,25932,25933,32811,34481,35099,36232,37085,37166,37167,39365,40379,40429,41826,43166,47846,48453,48693,49297,49788,49972,51251,51874,51875,54625,54697,55094,57583,58018,61163,64163,64254,64259,65065,65206,69792,70044,70824,72756,72935,73366,73865,75877,77705,79288,79848,79939,81000,82766,82944,83337,83350,85107,85242,85243,85977,86617,86793,86844,89901,90436,90476,90805,90816,91814,91845,93068,93073,93257,93258,93260,93309,93323,94013,94015,94171,94652,95276,95278,95879,95887,96468,97793,97832,98058,98393,98466,98584,99266,99607,100038,100039,101426,101427,101655,101950,102192,102293,102406,102435,102466,103250,103369,103380,103459,103712,103724,103762,103774,103776,104625,104648,105937,106038,106740,106759,106804,106805,106807,106840,107076,107519,107657,107710,107768,107793,107926,107927,107928,108137,108455,108581,109067,109501,109502,109804,109936,109937,109938,110253,110279,110441,112678,112826,113663,115531,115532,115539,115714,115868,115871,115971,115990,116221,116338,116339,116531,116567,116952,116955,117413,117505,117507,117508,117527,117624,117625,117724,117725,117957,118056,118090,118091,118295);


	    $arr2 = array(13687,13833,55094,75877,77705,82944,86793,91845,93073,95879,99607,100038,100039,101655,101950,102192,102293,102406,102435,102466,103250,103369,103380,103459,103712,103724,103762,103774,103776,104625,104648,105937,106038,106740,106759,106804,106805,106807,106840,107076,107519,107657,107710,107768,107793,107926,107927,107928,108137,108455,108581,109067,109501,109502,109804,109936,109937,109938,110253,110279,110441,112678,112826,113663,115531,115532,115539,115714,115868,115871,115971,115990,116221,116338,116339,116531,116567,116952,116955,117413,117505,117507,117508,117527,117624,117625,117724,117725,117957,118056,118090,118091,118295);

	    $arr3 = array_diff($arr, $arr2);

//echo implode(',', $arr3);
//dump($arr3);
	    $str = ',';

	    $arr = array('休闲娱乐','结婚','电影演出赛事','丽人','酒店','亲子','旅游','运动健身','购物','学习培训','生活服务','健康医疗','爱车','宠物');

	    $id = 40;
	    foreach ($arr as $v) {
//	    	echo "({$id},'{$v}',0,1,'2019-08-26 17:00:00','2019-08-26 17:00:00'),<br/>";
	    	$id++;
	    }

	    // 40
	    $str = '足疗按摩，洗浴/汗蒸，KTV，酒吧，密室逃脱， 轰趴馆， 茶馆， 私人影院， 网吧网咖， DIY手工坊， 文化艺术， 游乐游艺， VR， 桌游，棋牌室， 桌球馆';
	    // 41
	    $str1 = '婚纱摄影， 旅拍， 婚宴， 婚礼策划， 婚纱礼服， 西服定制， 彩妆造型， 婚礼跟拍， 婚车租赁，个性写真';
	    // 42
	    $str = '电影院，演出场馆， 剧场/影院， 音乐厅/礼堂， 艺术中心/文化广场， 热门演出， 赛事展览';
	    // 43
	    $str = '美发， 美甲美睫， 美容／SPA， 养发， 瘦身纤体， 瑜伽， 舞蹈， 韩式定妆， 祛痘， 纹身， 化妆品， 产后塑形';
	    // 44
	    $str = '五星级/豪华型， 四星级/高档型，三星级/舒适型， 经济连锁，情侣酒店， 青年旅社， 客栈';
	    // 45
	    $str = '儿童摄影， 儿童乐园， 婴儿游泳， 亲子会所， 儿童运动馆，早教中心， 幼儿外语 ，幼儿才艺，月子会所';
	    // 46
	    $str = '温泉， 动植物园， 水上娱乐， 滑雪， 景点';
	    // 47
	    $str = '健身中心， 武术场馆， 游泳馆，羽毛球馆， 溜冰场， 射箭馆， 篮球场， 网球场， 攀岩馆， 乒乓球馆， 足球场， 高尔夫场， 保龄球馆， 体育场馆， 壁球馆';
	    // 48
	    $str = '综合商场 ，服饰鞋包， 运动户外， 珠宝饰品';
	    // 49
	    $str = '英语 ，日语， 韩语， 雅思托福， 留学申请， 绘画， 西洋乐器， 书法， 乐理声乐， 民族乐器， 花艺，驾校， 美容化妆， 会计 ，厨艺， IT';
	    // 50
	    $str = '快照冲印， 搬家运输， 生活配送， 家政服务， 洗涤护理， 成人用品，家电数码维修 ，居家维修 ，回收，律师服务，文化传媒';
	    // 51
	    $str = '口腔齿科，体检中心，药店，宠物医院， 整形';
	    // 52
	    $str = '美容洗车， 维修保养，加油站， 停车场，4S店／汽车销售，汽车保险';
	    // 53
	    $str = '宠物医院，宠物店';

	    $arr = explode('，', $str1);
//	    var_dump($arr);

	    $id = 177;
	    $name1 = '';
	    foreach ($arr as $v) {

	    	$name = trim($v);
	    	echo $name.',';
//		    echo "({$id},'{$name}',53,2,'2019-08-26 17:00:00','2019-08-26 17:00:00'),<br/>";
		    $id++;
	    }

//	    echo leng
die;
//	    echo count($arr3);
//die;
//	    $arr = '[]';
//	    dump(json_decode($arr));
//		die;
//		echo DS;die;
		return view();
	}

	public function download_xml()
	{
//		import("org.Yufan.Excel");

		import("extra.org.Yufan.Excel","",".class.php");

		$IndexLogic = new logic\IndexLogic();
		$res = $IndexLogic->download();

//		dump($res);

		$row=array();
		$row[0]=array('酒店ID','酒店名称','手机','地址');


		$i=1;
		foreach($res as $v){
			$row[$i]['i'] = $i;
			$row[$i]['hotel_id'] = $v['hotel_id'];
			$row[$i]['hotel_name'] = $v['hotel_name'];
			$row[$i]['phone'] = $v['phone'];
			$row[$i]['address'] = $v['address'];
			$i++;
		}

		$xls = new \Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("yufan956932910");


	}
	public function download(){

		$IndexLogic = new logic\IndexLogic();
		$xlsData = $IndexLogic->download(10000);
//dump($xlsData);die;
		$xlsName  = "User用户数据表";
		$xlsCell  = array(
			array('member_id','账号序列'),
			array('member_name','名字'),
			array('mobile','手机号'),
			array('gender','状态'),
		);

//		$this->exportExcel_2();
//		$this->exportExcel($xlsName,$xlsCell,$xlsData);
	}

	public function downloadBatch(){

		$baseUrl = LIB_PATH.'vendor';
		Loader::import("PHPExcel.PHPExcel", $baseUrl);

		$objPHPExcel = new \PHPExcel();
		$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
//		$objWriter->save("xxx.xlsx");


		$IndexLogic = new logic\IndexLogic();
		$data = $IndexLogic->download(1, 100);


	/*	$filePath = RUNTIME_PATH.'download/';
		if(!is_dir($filePath)){
			mkdir($filePath);
		}

		$fileName = $filePath.'wyz.csv';
		if(!is_file($fileName)){
echo 2;
		}else{

			$csv_data = $this->read_csv_lines($filePath);

		}*/



//		dump($filePath);


		$head = array(
			array('member_id','账号序列'),
			array('member_name','名字'),
			array('mobile','手机号'),
			array('gender','状态'),
		);

		$filePath = RUNTIME_PATH.'download/';
//		$this->putCsv();
		$this->mergeCSV($filePath,$filePath.'wyz.csv');

	}


	/**
	 * csv大数据导出
	 * @param array $head
	 * @param $data
	 * @param string $mark
	 * @param string $fileName
	 */
	public function putCsv($mark = 'attack_ip_info', $fileName = "test.csv")
	{
		set_time_limit(0);



		$IndexLogic = new logic\IndexLogic();


//		$sqlCount = $data->count();

		$sqlCount = 100000;

		// 输出Excel文件头，可把user.csv换成你要的文件名
//		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
//		header('Content-Disposition: attachment;filename="' . $fileName . '"');
//		header('Cache-Control: max-age=0');

		$head = array(
			'member_id'=>'账号ID',
			'member_name'=>'名字',
			'mobile'=>'手机号',
			'gender'=>'性别',
		);
		foreach ($head as $k=>$v){
			$head[$k] = iconv('utf-8', 'gbk', $v);
		}

		$filePath = RUNTIME_PATH.'download/';
		$mark = $filePath.$mark;
//echo $mark;die;
		$sqlLimit = 20000;//每次只从数据库取100000条以防变量缓存太大
		// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 10000;
		// buffer计数器
		$cnt = 0;
		$fileNameArr = array();
		// 逐行取出数据，不浪费内存
		for ($i = 0; $i < ceil($sqlCount / $sqlLimit); $i++) {
			$fp = fopen($mark . '_' . $i . '.csv', 'w'); //生成临时文件
			//     chmod('attack_ip_info_' . $i . '.csv',777);//修改可执行权限
			$fileNameArr[] = $mark . '_' .  $i . '.csv';

			// 将数据通过fputcsv写到文件句柄
			if($i < 1){
				fputcsv($fp, $head);
			}

			$dataArr = $IndexLogic->download($i+1, $sqlLimit);

//			$dataArr = $data->offset($i * $sqlLimit)->limit($sqlLimit)->get()->toArray();
			foreach ($dataArr as $a) {
				$cnt++;
				if ($limit == $cnt) {
					//刷新一下输出buffer，防止由于数据过多造成问题
					ob_flush();
					flush();
					$cnt = 0;
				}

				foreach ($a as $k=>$v){
					if($v){
						$a[$k] = iconv('utf-8', 'gbk//TRANSLIT//IGNORE', $v);
					}else{
						$a[$k] = $v;
					}

				}

				fputcsv($fp, $a);
			}
			dump($i);
			fclose($fp);  //每生成一个文件关闭
		}

		die;
		/*//进行多个文件压缩
		$zip = new ZipArchive();
		$filename = $mark . ".zip";
		$zip->open($filename, ZipArchive::CREATE);   //打开压缩包
		foreach ($fileNameArr as $file) {
			$zip->addFile($file, basename($file));   //向压缩包中添加文件
		}
		$zip->close();  //关闭压缩包
		foreach ($fileNameArr as $file) {
			unlink($file); //删除csv临时文件
		}
		//输出压缩文件提供下载
		header("Cache-Control: max-age=0");
		header("Content-Description: File Transfer");
		header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
		header("Content-Type: application/zip"); // zip格式的
		header("Content-Transfer-Encoding: binary"); //
		header('Content-Length: ' . filesize($filename)); //
		@readfile($filename);//输出文件;
		unlink($filename); //删除压缩包临时文件*/
	}

	public function mergeCSV($dirName,$targetFile){
		$filetime = array();
		$path = array();
		//打开待操作的文件夹句柄
		$handle1 = opendir($dirName);
		//遍历文件夹
		while(($res = readdir($handle1)) !== false){
			if($res != '.' && $res != '..'){
				//如果是文件，提出文件内容，写入目标文件
				if(is_file($dirName.'/'.$res)){
					$fileName = $dirName.'/'.$res;
					if(!strpos($fileName, 'attack_ip_info_')){
						continue;
					}
					$filetime[] = date ( "Y-m-d H:i:s", filemtime ( $fileName ) ); // 获取文件最近修改日期
					$path[]=$fileName;
					//读
					/*$handle2 = fopen($fileName,'r');
					if($str = fread($handle2,filesize($fileName))){
						fclose($handle2);
						$handle3 = fopen($targetFile,'a+');
						if(fwrite($handle3, $str)){
							fwrite($handle3,"\n");
							fclose($handle3);
						}
					}*/
				}
				/*//如果是文件夹，继续调用mergeCSV方法
				if(is_dir($dirName.'/'.$res)){
					$newDirName = $dirName.'/'.$res;
					mergeCSV($newDirName,$targetFile);
				}*/
			}
		}
		@closedir ( $handle1 );

		array_multisort($filetime,SORT_ASC, SORT_STRING,$path);//按时间排序

		if(empty($path)){
			dump("没有需要合并的文件");
		}
		foreach ($path as $fileName){
			$handle2 = fopen($fileName,'r');
			if($str = fread($handle2,filesize($fileName))){
				fclose($handle2);
				$handle3 = fopen($targetFile,'a+');
				if(fwrite($handle3, $str)){
					fwrite($handle3,"\n");
					fclose($handle3);
				}
			}

			dump("csv文件数据合并成功");

			//删除下载的临时文件
			if(unlink($fileName)){
				dump("删除临时文件成功：".$fileName);
			}else{
				dump("删除临时文件失败：".$fileName);
			}

		}

//		dump($path);

	}


	//导出操作
	public function exportExcel_2(){

		Debug::remark('begin');

		ini_set('max_execution_time', 0);
		ini_set('memory_limit','256M');


		$IndexLogic = new logic\IndexLogic();
//		$xlsData = $IndexLogic->download(10000);
//		$dataCount = $IndexLogic->downloadCount();
//		if($dataCount > 500000){
//			$dataCount = 30000;
//		}


		//====下载start=====
		$expTitle = "用户列表";
		$expCellName = array(
			array('member_id','账号序列'),
			array('member_name','名字'),
			array('mobile','手机号'),
			array('gender','状态'),
		);
		$expTableData = array();

		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $expTitle.date('_Ymd_His');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);
//		$dataNum = count($expTableData);

		$baseUrl = LIB_PATH.'vendor';
		Loader::import("PHPExcel.PHPExcel", $baseUrl);

		$objPHPExcel = new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$dataCount = 600;
		$pageNum = 600;
		$pageSize = ceil($dataCount/$pageNum);
		$i = $pre_dataNum = 0;
		for($w=0; $w<$pageSize; $w++){

			$objPHPExcel->createSheet($w);
			$objPHPExcel->setActiveSheetIndex($w);
			$objPHPExcel->getActiveSheet()->setTitle('wyz'.($w+1));
			$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));//第一行标题


			for($t=0;$t<$cellNum;$t++){
				$objPHPExcel->getActiveSheet()->setCellValue($cellName[$t].'2', $expCellName[$t][1]);
			}


			$expTableData = $IndexLogic->download($w+1, $pageNum);


			$dataNum = count($expTableData);

			$dataNum = $dataNum + $pre_dataNum;
			$pre_dataNum = $dataNum;

			$k = 0;
			for($i;$i<$dataNum;$i++) {


				for($j=0;$j<$cellNum;$j++){


					$objPHPExcel->getActiveSheet()->setCellValue($cellName[$j].($k+3), $expTableData[$k][$expCellName[$j][0]]);
				}

				$k++;
			}
			unset($expTableData);



		}
		Debug::remark('end');
//die;
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

//		echo Debug::getRangeTime('begin','end').'s';
//		echo '<br>';
//		echo Debug::getRangeMem('begin','end');

		exit;
	}






	/**
	 * 导出CSV文件
	 * @param array $data        数据
	 * @param array $header_data 首行数据
	 * @param string $file_name  文件名称
	 * @return string
	 */
	public function export_csv_2($data = [], $header_data = [], $file_name = '')
	{
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$file_name);
		header('Cache-Control: max-age=0');

		$fp = fopen('php://output', 'x');
		if (!empty($header_data)) {
			foreach ($header_data as $key => $value) {
				$header_data[$key] = iconv('utf-8', 'gbk', $value);
			}
			fputcsv($fp, $header_data);
		}

		$num = 0;
		//每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
		$limit = 100000;
		//逐行取出数据，不浪费内存
		$count = count($data);
		if ($count > 0) {
			for ($i = 0; $i < $count; $i++) {
				$num++;
				//刷新一下输出buffer，防止由于数据过多造成问题
				if ($limit == $num) {
					ob_flush();
					flush();
					$num = 0;
				}
				$row = $data[$i];
				foreach ($row as $key => $value) {
					$row[$key] = iconv('utf-8', 'gbk', $value);
				}
				fputcsv($fp, $row);
			}
		}
		fclose($fp);
	}
	/**
	 * 读取CSV文件
	 * @param string $csv_file csv文件路径
	 * @param int $lines       读取行数
	 * @param int $offset      起始行数
	 * @return array|bool
	 */
	public function read_csv_lines($csv_file = '', $lines = 0, $offset = 0)
	{
		if (!$fp = fopen($csv_file, 'r')) {
			return false;
		}
		$i = $j = 0;
		while (false !== ($line = fgets($fp))) {
			if ($i++ < $offset) {
				continue;
			}
			break;
		}
		$data = array();
		while (($j++ < $lines) && !feof($fp)) {
			$data[] = fgetcsv($fp);
		}
		fclose($fp);
		return $data;
	}
	//导出操作
	public function exportExcel($expTitle,$expCellName,$expTableData){
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $expTitle.date('_Ymd_His');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);
//		vendor("PHPExcel.PHPExcel");
		$baseUrl = LIB_PATH.'vendor';
		Loader::import("PHPExcel.PHPExcel", $baseUrl);
		$objPHPExcel = new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));//第一行标题
		for($i=0;$i<$cellNum;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i=0;$i<$dataNum;$i++){
			for($j=0;$j<$cellNum;$j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}
