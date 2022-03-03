<?php
namespace app\home\controller;
use app\home\logic;
use think\Loader;
use think\Debug;
use think\Session;

class IndexController extends BaseController
{
    public function index()
	{




		return view();
	}

	public function test() {

    	// 本金余额 * 消费金额 / 余额

		$hotel_id_list = [143969];

//		array_push($hotel_id_list, 2);
//		dump($hotel_id_list);
		$p = [];
		$p[] = [
			'ticket_category_id' => 0
		];
		$p[] = [
			'ticket_category_id' => 1
		];
		$p[] = [
			'ticket_category_id' => 1
		];
		$p[] = [
			'ticket_category_id' => 2
		];
		$productsCateList = array_values(array_filter(array_unique(array_column($p, 'ticket_category_id'))));
		dump($productsCateList);
		if ($productsCateList == 1) {
			dump(33333);
		}
		die;
	}

	function sec2Time($time)
	{
		if (is_numeric($time)) {
			$value = array(
				"years" => 0, "days" => 0, "hours" => 0,
				"minutes" => 0, "seconds" => 0,
			);
			$t = '';
			if ($time >= 31556926) {
				$value["years"] = floor($time / 31556926);
				$time = ($time % 31556926);
				$t .= $value["years"] . "年";
			}
			if ($time >= 86400) {
				$value["days"] = floor($time / 86400);
				$time = ($time % 86400);
				$t .= $value["days"] . "天";
			}
			if ($time >= 3600) {
				$value["hours"] = floor($time / 3600);
				$time = ($time % 3600);
				$t .= $value["hours"] . "小时";
			}
			if ($time >= 60) {
				$value["minutes"] = floor($time / 60);
				$time = ($time % 60);
				$t .= $value["minutes"] . "分";
			}
			$value["seconds"] = floor($time);
			//return (array) $value;
			$t .= $value["seconds"] . "秒";
			return $t;

		} else {
			return (bool) false;
		}
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

	public function downloadCsv() {

		$outformat = "entmove.csv";
		$title = "会员ID,卡ID,储值卡号,手机号,本金余额,赠金余额,类型,充值时间,备注\n";
		$json1 = '[{"memberId":"1349485","prepayCardId":"19020","cardNo":"卡号：227251325777","mobile":"13508493861","depositBalance":"128","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-14 12:39:38","remark":"线上和线下消费"},{"memberId":"1194989","prepayCardId":"21595","cardNo":"卡号：900757528044","mobile":"18633830505","depositBalance":"108","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-15 13:02:00","remark":"线上和线下消费"},{"memberId":"1378203","prepayCardId":"28060","cardNo":"卡号：285020605067","mobile":"18611099575","depositBalance":"1007","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-20 19:51:19","remark":"线上和线下消费"},{"memberId":"838311","prepayCardId":"31238","cardNo":"卡号：709324119142","mobile":"13826272355","depositBalance":"120","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-24 15:51:41","remark":"线上和线下消费"},{"memberId":"1405388","prepayCardId":"32032","cardNo":"卡号：537050317587","mobile":"13356946999","depositBalance":"1118.93","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-26 12:48:18","remark":"线上和线下消费"},{"memberId":"837198","prepayCardId":"28193","cardNo":"卡号：420195430986","mobile":"13976820000","depositBalance":"13","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-27 14:33:23","remark":"线上和线下消费"},{"memberId":"1454521","prepayCardId":"40853","cardNo":"卡号：951786408323","mobile":"13571810592","depositBalance":"30","giftBalance":"0","depositType":"wxpay","createTime":"2016-12-31 19:12:02","remark":"线上和线下消费"},{"memberId":"1092303","prepayCardId":"42177","cardNo":"卡号：215029614408","mobile":"18611952799","depositBalance":"56","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-01 18:33:23","remark":"线上和线下消费"},{"memberId":"913495","prepayCardId":"31935","cardNo":"卡号：293166877678","mobile":"13891839669","depositBalance":"2847","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-02 15:48:42","remark":"线上和线下消费"},{"memberId":"1471452","prepayCardId":"43832","cardNo":"卡号：986923259692","mobile":"13905369988","depositBalance":"1595","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-04 19:27:55","remark":"线上和线下消费"},{"memberId":"1469531","prepayCardId":"43721","cardNo":"卡号：566846550475","mobile":"18964009838","depositBalance":"340","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-04 21:27:59","remark":"线上和线下消费"},{"memberId":"1490368","prepayCardId":"44945","cardNo":"卡号：670218456073","mobile":"13801215635","depositBalance":"1448","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-07 14:04:12","remark":"线上和线下消费"},{"memberId":"860703","prepayCardId":"3327","cardNo":"卡号：926355987516","mobile":"13911128938","depositBalance":"320","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-07 19:43:55","remark":"线上和线下消费"},{"memberId":"1503463","prepayCardId":"46431","cardNo":"卡号：856273767663","mobile":"13911069828","depositBalance":"240","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-10 16:52:05","remark":"线上和线下消费"},{"memberId":"891578","prepayCardId":"47059","cardNo":"卡号：646562292807","mobile":"13858044367","depositBalance":"1420","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-11 14:48:59","remark":"线上和线下消费"},{"memberId":"1402655","prepayCardId":"31616","cardNo":"卡号：524875543652","mobile":"18207481501","depositBalance":"3","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-14 22:11:43","remark":"线上和线下消费"},{"memberId":"1539854","prepayCardId":"49362","cardNo":"卡号：923295307865","mobile":"13928457333","depositBalance":"309","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-18 12:07:54","remark":"线上和线下消费"},{"memberId":"1517744","prepayCardId":"49418","cardNo":"卡号：548934448866","mobile":"13801223663","depositBalance":"20","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-18 15:14:49","remark":"线上和线下消费"},{"memberId":"1451126","prepayCardId":"39425","cardNo":"卡号：399726704504","mobile":"13319277588","depositBalance":"600","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-18 16:41:15","remark":"线上和线下消费"},{"memberId":"1453667","prepayCardId":"40251","cardNo":"卡号：417957868714","mobile":"18611528266","depositBalance":"7560","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-18 16:48:22","remark":"线上和线下消费"},{"memberId":"1557687","prepayCardId":"50046","cardNo":"卡号：312174485108","mobile":"13321201195","depositBalance":"1391","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-20 15:44:52","remark":"线上和线下消费"},{"memberId":"1568095","prepayCardId":"50283","cardNo":"卡号：398383262180","mobile":"18610126616","depositBalance":"18","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-21 12:23:25","remark":"线上和线下消费"},{"memberId":"759063","prepayCardId":"50490","cardNo":"卡号：707427165530","mobile":"13519885506","depositBalance":"2700","giftBalance":"400","depositType":"wxpay","createTime":"2017-01-22 09:32:18","remark":"线上和线下消费"},{"memberId":"1574143","prepayCardId":"50509","cardNo":"卡号：274390385657","mobile":"13817533755","depositBalance":"5170","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-22 09:46:35","remark":"线上和线下消费"},{"memberId":"954399","prepayCardId":"50612","cardNo":"卡号：298979593693","mobile":"13910283151","depositBalance":"414","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-22 15:01:13","remark":"线上和线下消费"},{"memberId":"862138","prepayCardId":"46939","cardNo":"卡号：864888242247","mobile":"15109825679","depositBalance":"435","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-23 09:09:15","remark":"线上和线下消费"},{"memberId":"894171","prepayCardId":"15363","cardNo":"卡号：458884146064","mobile":"13908013477","depositBalance":"6600","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-23 15:52:58","remark":"线上和线下消费"},{"memberId":"1587725","prepayCardId":"51171","cardNo":"卡号：141508766777","mobile":"13666165099","depositBalance":"170","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-24 12:34:07","remark":"线上和线下消费"},{"memberId":"1589943","prepayCardId":"51244","cardNo":"卡号：357222789330","mobile":"13901159990","depositBalance":"1644","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-24 17:41:59","remark":"线上和线下消费"},{"memberId":"1589996","prepayCardId":"51248","cardNo":"卡号：563395958307","mobile":"15338950909","depositBalance":"332","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-24 17:51:22","remark":"线上和线下消费"},{"memberId":"17748","prepayCardId":"10375","cardNo":"卡号：762141193188","mobile":"13707530562","depositBalance":"99.2","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-24 20:25:16","remark":"线上和线下消费"},{"memberId":"1594430","prepayCardId":"51497","cardNo":"卡号：509364343362","mobile":"15881054888","depositBalance":"3468","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-25 14:13:07","remark":"线上和线下消费"},{"memberId":"896786","prepayCardId":"12173","cardNo":"卡号：652155598171","mobile":"13997389666","depositBalance":"68","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-25 17:31:02","remark":"线上和线下消费"},{"memberId":"1592205","prepayCardId":"51369","cardNo":"卡号：756402193806","mobile":"13757955796","depositBalance":"66","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-26 12:28:19","remark":"线上和线下消费"},{"memberId":"909146","prepayCardId":"49731","cardNo":"卡号：682539340288","mobile":"13901178838","depositBalance":"15.2","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-26 14:59:06","remark":"线上和线下消费"},{"memberId":"1491450","prepayCardId":"51911","cardNo":"卡号：186538935257","mobile":"13908006002","depositBalance":"1935","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-26 17:19:07","remark":"线上和线下消费"},{"memberId":"1588243","prepayCardId":"51190","cardNo":"卡号：708292626507","mobile":"18519893136","depositBalance":"252","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-26 18:59:18","remark":"线上和线下消费"},{"memberId":"870102","prepayCardId":"14810","cardNo":"卡号：700701710484","mobile":"13578978666","depositBalance":"22","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-27 15:55:10","remark":"线上和线下消费"},{"memberId":"1603940","prepayCardId":"52152","cardNo":"卡号：456520116073","mobile":"13910689162","depositBalance":"2965","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-27 17:00:55","remark":"线上和线下消费"},{"memberId":"1055002","prepayCardId":"9873","cardNo":"卡号：789569102271","mobile":"13976100925","depositBalance":"0.66","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-27 23:01:53","remark":"线上和线下消费"},{"memberId":"1605179","prepayCardId":"52277","cardNo":"卡号：506659701201","mobile":"13901012407","depositBalance":"7320","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-28 13:43:38","remark":"线上和线下消费"},{"memberId":"1605290","prepayCardId":"52300","cardNo":"卡号：329610558793","mobile":"13379827167","depositBalance":"132","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-28 14:50:02","remark":"线上和线下消费"},{"memberId":"911830","prepayCardId":"24463","cardNo":"卡号：378957793802","mobile":"13122231314","depositBalance":"86","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-28 15:17:20","remark":"线上和线下消费"},{"memberId":"1608193","prepayCardId":"52485","cardNo":"卡号：794109653409","mobile":"13607685687","depositBalance":"5430","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 09:04:46","remark":"线上和线下消费"},{"memberId":"1608357","prepayCardId":"52499","cardNo":"卡号：967300497268","mobile":"13804263377","depositBalance":"4080","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 10:14:26","remark":"线上和线下消费"},{"memberId":"910371","prepayCardId":"23182","cardNo":"卡号：385052220475","mobile":"13511030653","depositBalance":"200","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 11:11:56","remark":"线上和线下消费"},{"memberId":"904215","prepayCardId":"52526","cardNo":"卡号：420512413533","mobile":"13909285321","depositBalance":"1","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 11:35:24","remark":"线上和线下消费"},{"memberId":"1400028","prepayCardId":"31303","cardNo":"卡号：868828664463","mobile":"13917777877","depositBalance":"1291","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 11:55:12","remark":"线上和线下消费"},{"memberId":"1608753","prepayCardId":"52538","cardNo":"卡号：420996765710","mobile":"13906580988","depositBalance":"150","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 12:12:13","remark":"线上和线下消费"},{"memberId":"1606249","prepayCardId":"52384","cardNo":"卡号：809838187717","mobile":"13322006886","depositBalance":"1660","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 13:10:04","remark":"线上和线下消费"},{"memberId":"1492197","prepayCardId":"45146","cardNo":"卡号：590582768389","mobile":"13701080300","depositBalance":"5301","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 14:01:32","remark":"线上和线下消费"},{"memberId":"1608439","prepayCardId":"52509","cardNo":"卡号：329872972838","mobile":"13801018877","depositBalance":"192","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 14:26:46","remark":"线上和线下消费"},{"memberId":"1227568","prepayCardId":"12000","cardNo":"卡号：340542133166","mobile":"13301331805","depositBalance":"546","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 15:14:22","remark":"线上和线下消费"},{"memberId":"1610031","prepayCardId":"52683","cardNo":"卡号：389733371002","mobile":"13801250255","depositBalance":"2656","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 17:14:54","remark":"线上和线下消费"},{"memberId":"916423","prepayCardId":"43984","cardNo":"卡号：701172960274","mobile":"18600039336","depositBalance":"282","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-29 18:47:52","remark":"线上和线下消费"},{"memberId":"1615269","prepayCardId":"52982","cardNo":"卡号：626973683650","mobile":"15859077773","depositBalance":"68","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 13:07:43","remark":"线上和线下消费"},{"memberId":"1615680","prepayCardId":"52999","cardNo":"卡号：756963857786","mobile":"15649256666","depositBalance":"1961","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 14:03:58","remark":"线上和线下消费"},{"memberId":"1133849","prepayCardId":"21321","cardNo":"卡号：294063286055","mobile":"13601175573","depositBalance":"445","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 14:52:58","remark":"线上和线下消费"},{"memberId":"1616691","prepayCardId":"53102","cardNo":"卡号：504422930744","mobile":"13973299999","depositBalance":"27","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 17:44:07","remark":"线上和线下消费"},{"memberId":"907194","prepayCardId":"52974","cardNo":"卡号：442882552563","mobile":"13707501188","depositBalance":"110","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 17:57:07","remark":"线上和线下消费"},{"memberId":"414962","prepayCardId":"53110","cardNo":"卡号：362534752022","mobile":"18908805788","depositBalance":"532","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 18:00:37","remark":"线上和线下消费"},{"memberId":"1616862","prepayCardId":"53126","cardNo":"卡号：829432449853","mobile":"13702651401","depositBalance":"2","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 18:26:48","remark":"线上和线下消费"},{"memberId":"850297","prepayCardId":"53132","cardNo":"卡号：281596880518","mobile":"13802917398","depositBalance":"618","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 18:34:49","remark":"线上和线下消费"},{"memberId":"1616970","prepayCardId":"53145","cardNo":"卡号：428299303857","mobile":"13924307291","depositBalance":"1955","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-30 18:48:20","remark":"线上和线下消费"},{"memberId":"1605425","prepayCardId":"52330","cardNo":"卡号：973735596334","mobile":"13802245476","depositBalance":"21","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 07:13:42","remark":"线上和线下消费"},{"memberId":"1618741","prepayCardId":"53294","cardNo":"卡号：729848261887","mobile":"15961660003","depositBalance":"1060","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 08:55:22","remark":"线上和线下消费"},{"memberId":"1618842","prepayCardId":"53301","cardNo":"卡号：680172661363","mobile":"13311693578","depositBalance":"1616","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 09:46:42","remark":"线上和线下消费"},{"memberId":"1336644","prepayCardId":"10809","cardNo":"卡号：963591687333","mobile":"13566007667","depositBalance":"265","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 09:52:44","remark":"线上和线下消费"},{"memberId":"1618914","prepayCardId":"53305","cardNo":"卡号：234477283863","mobile":"13916105398","depositBalance":"96","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 10:04:54","remark":"线上和线下消费"},{"memberId":"1219299","prepayCardId":"47748","cardNo":"卡号：327773780539","mobile":"(null)","depositBalance":"6810","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 10:31:53","remark":"线上和线下消费"},{"memberId":"1619076","prepayCardId":"53320","cardNo":"卡号：281870894447","mobile":"18603356611","depositBalance":"1","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 10:48:56","remark":"线上和线下消费"},{"memberId":"1619172","prepayCardId":"53331","cardNo":"卡号：583322884185","mobile":"13905762230","depositBalance":"520","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 11:14:14","remark":"线上和线下消费"},{"memberId":"1619712","prepayCardId":"53378","cardNo":"卡号：707591630857","mobile":"18863668001","depositBalance":"4170","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 14:01:24","remark":"线上和线下消费"},{"memberId":"1619746","prepayCardId":"53380","cardNo":"卡号：286449644780","mobile":"13937961135","depositBalance":"200","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 14:09:20","remark":"线上和线下消费"},{"memberId":"1613544","prepayCardId":"52837","cardNo":"卡号：838410130246","mobile":"13390786333","depositBalance":"654","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 14:24:23","remark":"线上和线下消费"},{"memberId":"1619843","prepayCardId":"53389","cardNo":"卡号：219860408618","mobile":"13516387777","depositBalance":"488","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 14:28:30","remark":"线上和线下消费"},{"memberId":"1619969","prepayCardId":"53408","cardNo":"卡号：695087580872","mobile":"13991822398","depositBalance":"1450","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 15:00:46","remark":"线上和线下消费"},{"memberId":"1618825","prepayCardId":"53300","cardNo":"卡号：389750975325","mobile":"18610297999","depositBalance":"322","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 15:25:10","remark":"线上和线下消费"},{"memberId":"1620168","prepayCardId":"53416","cardNo":"卡号：424542116304","mobile":"13901124299","depositBalance":"1465","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 15:46:50","remark":"线上和线下消费"},{"memberId":"1620289","prepayCardId":"53425","cardNo":"卡号：859913523034","mobile":"15608489138","depositBalance":"1309.6","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 16:12:58","remark":"线上和线下消费"},{"memberId":"1620355","prepayCardId":"53433","cardNo":"卡号：857983717515","mobile":"13935559993","depositBalance":"1311.81","giftBalance":"9.19","depositType":"wxpay","createTime":"2017-01-31 16:31:09","remark":"线上和线下消费"},{"memberId":"910330","prepayCardId":"53442","cardNo":"卡号：977191511245","mobile":"13957658888","depositBalance":"194","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 16:44:47","remark":"线上和线下消费"},{"memberId":"1578391","prepayCardId":"50817","cardNo":"卡号：181497941615","mobile":"13605761118","depositBalance":"38","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 17:01:32","remark":"线上和线下消费"},{"memberId":"1620503","prepayCardId":"53449","cardNo":"卡号：324497654179","mobile":"13823699111","depositBalance":"771","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 17:07:47","remark":"线上和线下消费"},{"memberId":"1458188","prepayCardId":"41694","cardNo":"卡号：817216966030","mobile":"13805801838","depositBalance":"1730","giftBalance":"0","depositType":"wxpay","createTime":"2017-01-31 19:22:52","remark":"线上和线下消费"},{"memberId":"1458188","prepayCardId":"41694","cardNo":"卡号：817216966030","mobile":"13805801838","depositBalance":"3000","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 10:36:10","remark":"线上和线下消费"},{"memberId":"1623647","prepayCardId":"53767","cardNo":"卡号：422773674662","mobile":"13921210818","depositBalance":"66","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 11:26:27","remark":"线上和线下消费"},{"memberId":"1603210","prepayCardId":"52112","cardNo":"卡号：707110782283","mobile":"13801666182","depositBalance":"990","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 12:27:24","remark":"线上和线下消费"},{"memberId":"871046","prepayCardId":"55860","cardNo":"卡号：397486148755","mobile":"15595693333","depositBalance":"25","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 14:28:04","remark":"线上和线下消费"},{"memberId":"1626418","prepayCardId":"56028","cardNo":"卡号：461112838799","mobile":"18976550201","depositBalance":"820","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 15:15:31","remark":"线上和线下消费"},{"memberId":"1083666","prepayCardId":"56031","cardNo":"卡号：249603609446","mobile":"13930296999","depositBalance":"5097","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 15:17:09","remark":"线上和线下消费"},{"memberId":"893736","prepayCardId":"56167","cardNo":"卡号：594117539575","mobile":"18689803337","depositBalance":"2100","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 15:58:17","remark":"线上和线下消费"},{"memberId":"850247","prepayCardId":"55142","cardNo":"卡号：716103795388","mobile":"13627553788","depositBalance":"23","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 16:02:30","remark":"线上和线下消费"},{"memberId":"912718","prepayCardId":"56241","cardNo":"卡号：348265268223","mobile":"18722666619","depositBalance":"1033.3","giftBalance":"30.7","depositType":"wxpay","createTime":"2017-02-01 16:27:09","remark":"线上和线下消费"},{"memberId":"898848","prepayCardId":"18396","cardNo":"卡号：522482960213","mobile":"13316094239","depositBalance":"2550","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 17:08:11","remark":"线上和线下消费"},{"memberId":"1626760","prepayCardId":"56171","cardNo":"卡号：761877303663","mobile":"13902244839","depositBalance":"748","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-01 18:26:02","remark":"线上和线下消费"},{"memberId":"1403568","prepayCardId":"31753","cardNo":"卡号：889538619828","mobile":"18802168680","depositBalance":"10","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 12:12:45","remark":"线上和线下消费"},{"memberId":"1632134","prepayCardId":"57710","cardNo":"卡号：473280642501","mobile":"13911906788","depositBalance":"7216","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 15:26:26","remark":"线上和线下消费"},{"memberId":"1629864","prepayCardId":"57420","cardNo":"卡号：912228470768","mobile":"13901063226","depositBalance":"170","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 16:54:37","remark":"线上和线下消费"},{"memberId":"1575472","prepayCardId":"50614","cardNo":"卡号：306221997466","mobile":"13901729559","depositBalance":"6751.6","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 17:05:34","remark":"线上和线下消费"},{"memberId":"1072564","prepayCardId":"50491","cardNo":"卡号：529242276286","mobile":"13899569006","depositBalance":"641","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 17:47:18","remark":"线上和线下消费"},{"memberId":"1608066","prepayCardId":"52473","cardNo":"卡号：905457619826","mobile":"13906860590","depositBalance":"95","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 19:19:54","remark":"线上和线下消费"},{"memberId":"1633223","prepayCardId":"57825","cardNo":"卡号：975205294472","mobile":"13508339393","depositBalance":"80","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 19:21:47","remark":"线上和线下消费"},{"memberId":"1617207","prepayCardId":"53180","cardNo":"卡号：167469477369","mobile":"13592613399","depositBalance":"2767","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-02 19:38:02","remark":"线上和线下消费"},{"memberId":"1634938","prepayCardId":"58000","cardNo":"卡号：967635720059","mobile":"18804710000","depositBalance":"2380","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 10:27:31","remark":"线上和线下消费"},{"memberId":"1048206","prepayCardId":"58054","cardNo":"卡号：705775550606","mobile":"18926028999","depositBalance":"1348","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 12:26:50","remark":"线上和线下消费"},{"memberId":"1622647","prepayCardId":"53560","cardNo":"卡号：657570182595","mobile":"13509696089","depositBalance":"858","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 12:48:57","remark":"线上和线下消费"},{"memberId":"1381225","prepayCardId":"28740","cardNo":"卡号：188098130485","mobile":"13901245883","depositBalance":"1","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 16:34:40","remark":"线上和线下消费"},{"memberId":"1216771","prepayCardId":"11049","cardNo":"卡号：900609271539","mobile":"13803832368","depositBalance":"346","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 16:47:37","remark":"线上和线下消费"},{"memberId":"1637463","prepayCardId":"58217","cardNo":"卡号：268167936290","mobile":"13713747869","depositBalance":"161","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 17:47:31","remark":"线上和线下消费"},{"memberId":"1536302","prepayCardId":"49096","cardNo":"卡号：733679590478","mobile":"18978299999","depositBalance":"1658","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-03 18:46:39","remark":"线上和线下消费"},{"memberId":"1640544","prepayCardId":"58553","cardNo":"卡号：912065285548","mobile":"13911366663","depositBalance":"8000","giftBalance":"400","depositType":"wxpay","createTime":"2017-02-04 12:09:25","remark":"线上和线下消费"},{"memberId":"1647268","prepayCardId":"59066","cardNo":"卡号：148691892979","mobile":"13911187959","depositBalance":"45","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-05 15:19:55","remark":"线上和线下消费"},{"memberId":"1452617","prepayCardId":"47568","cardNo":"卡号：429869217011","mobile":"18627058777","depositBalance":"400","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-05 15:28:28","remark":"线上和线下消费"},{"memberId":"1648725","prepayCardId":"59186","cardNo":"卡号：728240741787","mobile":"13608587229","depositBalance":"100","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-05 20:09:33","remark":"线上和线下消费"},{"memberId":"1650139","prepayCardId":"59298","cardNo":"卡号：226430278465","mobile":"17606257169","depositBalance":"80","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-06 10:31:12","remark":"线上和线下消费"},{"memberId":"900186","prepayCardId":"50352","cardNo":"卡号：810617170349","mobile":"15883609888","depositBalance":"32","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-06 14:07:22","remark":"线上和线下消费"},{"memberId":"1651267","prepayCardId":"59418","cardNo":"卡号：770995770097","mobile":"13808022773","depositBalance":"122","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-06 15:19:25","remark":"线上和线下消费"},{"memberId":"1218077","prepayCardId":"14546","cardNo":"卡号：700330529693","mobile":"18601388014","depositBalance":"279","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-07 13:15:51","remark":"线上和线下消费"},{"memberId":"891040","prepayCardId":"2741","cardNo":"卡号：314409379517","mobile":"18689581588","depositBalance":"17","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-07 15:40:56","remark":"线上和线下消费"},{"memberId":"1350261","prepayCardId":"19477","cardNo":"卡号：336738506739","mobile":"13901308656","depositBalance":"4920","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-07 17:05:00","remark":"线上和线下消费"},{"memberId":"1662389","prepayCardId":"62397","cardNo":"卡号：552669819055","mobile":"13901116843","depositBalance":"414","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-08 10:20:53","remark":"线上和线下消费"},{"memberId":"910016","prepayCardId":"58698","cardNo":"卡号：709376695112","mobile":"13901236830","depositBalance":"7","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-08 16:49:39","remark":"线上和线下消费"},{"memberId":"1655739","prepayCardId":"59713","cardNo":"卡号：512996662607","mobile":"18858291588","depositBalance":"1","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-08 21:20:55","remark":"线上和线下消费"},{"memberId":"1679103","prepayCardId":"65265","cardNo":"卡号：319963952403","mobile":"18628132669","depositBalance":"320","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-09 20:27:17","remark":"线上和线下消费"},{"memberId":"211454","prepayCardId":"66395","cardNo":"卡号：579461104717","mobile":"15208946111","depositBalance":"2800","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-11 08:00:49","remark":"线上和线下消费"},{"memberId":"1694848","prepayCardId":"67595","cardNo":"卡号：650429423705","mobile":"17701223060","depositBalance":"766","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-13 14:15:37","remark":"线上和线下消费"},{"memberId":"778455","prepayCardId":"408","cardNo":"卡号：426102348277","mobile":"18089871166","depositBalance":"5.3","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-16 14:25:39","remark":"线上和线下消费"},{"memberId":"948787","prepayCardId":"14582","cardNo":"卡号：543294966091","mobile":"15289731999","depositBalance":"936","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-16 23:15:07","remark":"线上和线下消费"},{"memberId":"892706","prepayCardId":"77894","cardNo":"卡号：221666250599","mobile":"13617599733","depositBalance":"300","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-27 18:45:41","remark":"线上和线下消费"},{"memberId":"1800990","prepayCardId":"78299","cardNo":"卡号：837465803277","mobile":"13609267372","depositBalance":"80","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-28 08:26:47","remark":"线上和线下消费"},{"memberId":"1800990","prepayCardId":"78299","cardNo":"卡号：837465803277","mobile":"13609267372","depositBalance":"3000","giftBalance":"0","depositType":"wxpay","createTime":"2017-02-28 08:33:48","remark":"线上和线下消费"},{"memberId":"948380","prepayCardId":"30319","cardNo":"卡号：437010226108","mobile":"18976735858","depositBalance":"152","giftBalance":"0","depositType":"wxpay","createTime":"2017-03-01 22:00:46","remark":"线上和线下消费"},{"memberId":"1874450","prepayCardId":"151289","cardNo":"卡号：306272120860","mobile":"15519663999","depositBalance":"408","giftBalance":"0","depositType":"wxpay","createTime":"2017-03-08 13:00:05","remark":"线上和线下消费"},{"memberId":"945374","prepayCardId":"9631","cardNo":"卡号：808094335136","mobile":"13876641504","depositBalance":"148","giftBalance":"0","depositType":"wxpay","createTime":"2017-03-09 09:53:58","remark":"线上和线下消费"},{"memberId":"1954759","prepayCardId":"177379","cardNo":"卡号：720583368473","mobile":"13801220168","depositBalance":"4929","giftBalance":"0","depositType":"wxpay","createTime":"2017-03-22 11:41:59","remark":"线上和线下消费"},{"memberId":"1971012","prepayCardId":"187299","cardNo":"卡号：667744209894","mobile":"13723889988","depositBalance":"2300","giftBalance":"0","depositType":"wxpay","createTime":"2017-03-23 07:46:53","remark":"线上和线下消费"},{"memberId":"1876681","prepayCardId":"183647","cardNo":"卡号：841518420836","mobile":"18797685739","depositBalance":"3000","giftBalance":"100","depositType":"wxpay","createTime":"2017-03-23 19:18:32","remark":"线上和线下消费"},{"memberId":"995702","prepayCardId":"132038","cardNo":"卡号：941586874481","mobile":"13307588825","depositBalance":"41.12","giftBalance":"0","depositType":"wxpay","createTime":"2017-04-01 12:03:24","remark":"线上和线下消费"},{"memberId":"910505","prepayCardId":"45397","cardNo":"卡号：878210694310","mobile":"13907556130","depositBalance":"8000","giftBalance":"371","depositType":"wxpay","createTime":"2017-04-04 18:01:00","remark":"线上和线下消费"},{"memberId":"2245968","prepayCardId":"244465","cardNo":"卡号：863811367930","mobile":"18932186715","depositBalance":"176","giftBalance":"0","depositType":"wxpay","createTime":"2017-04-10 15:58:23","remark":"线上和线下消费"},{"memberId":"1889000","prepayCardId":"153977","cardNo":"卡号：973955890423","mobile":"13812653311","depositBalance":"530","giftBalance":"0","depositType":"wxpay","createTime":"2017-04-14 11:21:13","remark":"线上和线下消费"},{"memberId":"1822280","prepayCardId":"101849","cardNo":"卡号：673607790397","mobile":"13911461333","depositBalance":"200","giftBalance":"0","depositType":"wxpay","createTime":"2017-05-18 10:33:08","remark":"线上和线下消费"},{"memberId":"1988047","prepayCardId":"202500","cardNo":"卡号：975637603794","mobile":"18789701988","depositBalance":"692","giftBalance":"0","depositType":"wxpay","createTime":"2017-05-24 12:32:29","remark":"线上和线下消费"},{"memberId":"858687","prepayCardId":"25658","cardNo":"卡号：258798612286","mobile":"13707586697","depositBalance":"152.1","giftBalance":"0","depositType":"wxpay","createTime":"2017-05-29 12:05:42","remark":"线上和线下消费"},{"memberId":"1214967","prepayCardId":"50268","cardNo":"卡号：652830492607","mobile":"13976924957","depositBalance":"13","giftBalance":"0","depositType":"wxpay","createTime":"2017-06-15 14:54:32","remark":"线上和线下消费"},{"memberId":"3576288","prepayCardId":"425501","cardNo":"卡号：374396654220","mobile":"15601969999","depositBalance":"1072.2","giftBalance":"0","depositType":"wxpay","createTime":"2017-06-26 13:33:05","remark":"线上和线下消费"},{"memberId":"1336979","prepayCardId":"11015","cardNo":"卡号：596024849095","mobile":"13707591852","depositBalance":"348","giftBalance":"0","depositType":"wxpay","createTime":"2017-07-02 16:06:28","remark":"线上和线下消费"},{"memberId":"5392","prepayCardId":"7484","cardNo":"卡号：608034258654","mobile":"13158992223","depositBalance":"1842","giftBalance":"0","depositType":"inshop","createTime":"2017-07-03 15:54:34","remark":"线上和线下消费"},{"memberId":"2247745","prepayCardId":"441457","cardNo":"卡号：148418800640","mobile":"18602897448","depositBalance":"43","giftBalance":"0","depositType":"wxpay","createTime":"2017-07-09 23:58:40","remark":"线上和线下消费"},{"memberId":"833172","prepayCardId":"4331","cardNo":"卡号：817331534709","mobile":"13876391240","depositBalance":"18","giftBalance":"0","depositType":"wxpay","createTime":"2017-08-03 20:42:04","remark":"线上和线下消费"},{"memberId":"1478485","prepayCardId":"44056","cardNo":"卡号：554158767248","mobile":"15820444488","depositBalance":"4","giftBalance":"0","depositType":"wxpay","createTime":"2017-08-06 10:32:31","remark":"线上和线下消费"},{"memberId":"7428903","prepayCardId":"549065","cardNo":"卡号：147239900564","mobile":"13257528159","depositBalance":"82","giftBalance":"0","depositType":"wxpay","createTime":"2017-09-25 15:25:22","remark":"线上和线下消费"},{"memberId":"7808915","prepayCardId":"561876","cardNo":"卡号：742576529790","mobile":"18608508203","depositBalance":"1400","giftBalance":"0","depositType":"wxpay","createTime":"2017-09-27 08:29:59","remark":"线上和线下消费"},{"memberId":"891151","prepayCardId":"2190","cardNo":"卡号：896266724672","mobile":"13804520444","depositBalance":"6768","giftBalance":"0","depositType":"wxpay","createTime":"2017-09-30 09:25:41","remark":"线上和线下消费"},{"memberId":"77147","prepayCardId":"566874","cardNo":"卡号：195172806847","mobile":"13379843555","depositBalance":"74","giftBalance":"0","depositType":"wxpay","createTime":"2017-09-30 22:38:57","remark":"线上和线下消费"},{"memberId":"1110628","prepayCardId":"141350","cardNo":"卡号：380066225594","mobile":"13976089824","depositBalance":"3962","giftBalance":"0","depositType":"wxpay","createTime":"2017-10-03 23:47:54","remark":"线上和线下消费"},{"memberId":"4279302","prepayCardId":"571741","cardNo":"卡号：668737677207","mobile":"18189758555","depositBalance":"250","giftBalance":"0","depositType":"wxpay","createTime":"2017-10-06 00:23:10","remark":"线上和线下消费"},{"memberId":"1228634","prepayCardId":"390698","cardNo":"卡号：416260936971","mobile":"18976469819","depositBalance":"1400","giftBalance":"0","depositType":"wxpay","createTime":"2017-10-13 14:27:44","remark":"线上和线下消费"},{"memberId":"3776040","prepayCardId":"587458","cardNo":"卡号：141911135435","mobile":"13976697511","depositBalance":"193","giftBalance":"0","depositType":"wxpay","createTime":"2017-10-20 10:37:57","remark":"线上和线下消费"},{"memberId":"3911839","prepayCardId":"1981278","cardNo":"卡号：670563146265","mobile":"13637560563","depositBalance":"68","giftBalance":"0","depositType":"present","createTime":"2018-03-27 02:08:27","remark":"线上和线下消费"},{"memberId":"904194","prepayCardId":"80738","cardNo":"卡号：217234145594","mobile":"13876818984","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-03-27 08:59:26","remark":"线上和线下消费"},{"memberId":"3433276","prepayCardId":"1988554","cardNo":"卡号：130492607531","mobile":"18876162721","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-03-27 15:44:48","remark":"线上和线下消费"},{"memberId":"3433276","prepayCardId":"1988554","cardNo":"卡号：130492607531","mobile":"18876162721","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-03-27 15:46:40","remark":"线上和线下消费"},{"memberId":"3433276","prepayCardId":"1988554","cardNo":"卡号：130492607531","mobile":"18876162721","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-03-27 15:47:35","remark":"线上和线下消费"},{"memberId":"18346028","prepayCardId":"1984919","cardNo":"卡号：229052161799","mobile":"13976604393","depositBalance":"188","giftBalance":"0","depositType":"present","createTime":"2018-03-27 19:35:21","remark":"线上和线下消费"},{"memberId":"18346028","prepayCardId":"1984919","cardNo":"卡号：229052161799","mobile":"13976604393","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-03-27 19:37:07","remark":"线上和线下消费"},{"memberId":"3591449","prepayCardId":"1993460","cardNo":"卡号：766544454190","mobile":"18508937477","depositBalance":"735","giftBalance":"0","depositType":"present","createTime":"2018-03-27 20:37:08","remark":"线上和线下消费"},{"memberId":"3591449","prepayCardId":"1993460","cardNo":"卡号：766544454190","mobile":"18508937477","depositBalance":"2000","giftBalance":"0","depositType":"present","createTime":"2018-03-27 20:38:15","remark":"线上和线下消费"},{"memberId":"18358004","prepayCardId":"1986824","cardNo":"卡号：532299836565","mobile":"19802309834","depositBalance":"132","giftBalance":"0","depositType":"present","createTime":"2018-03-27 21:41:08","remark":"线上和线下消费"},{"memberId":"1059862","prepayCardId":"1990814","cardNo":"卡号：160465607922","mobile":"13006008683","depositBalance":"296","giftBalance":"0","depositType":"present","createTime":"2018-03-28 04:59:36","remark":"线上和线下消费"},{"memberId":"18419106","prepayCardId":"1996999","cardNo":"卡号：873789393394","mobile":"17798485421","depositBalance":"31","giftBalance":"0","depositType":"present","createTime":"2018-03-28 06:43:19","remark":"线上和线下消费"},{"memberId":"18299721","prepayCardId":"1977226","cardNo":"卡号：815896454841","mobile":"13034953980","depositBalance":"2","giftBalance":"0","depositType":"present","createTime":"2018-03-29 18:34:19","remark":"线上和线下消费"},{"memberId":"3591449","prepayCardId":"1993460","cardNo":"卡号：766544454190","mobile":"18508937477","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-03-29 19:40:07","remark":"线上和线下消费"},{"memberId":"18368381","prepayCardId":"1988154","cardNo":"卡号：758863318525","mobile":"13379872404","depositBalance":"25","giftBalance":"0","depositType":"present","createTime":"2018-03-31 00:31:55","remark":"线上和线下消费"},{"memberId":"18911761","prepayCardId":"2091206","cardNo":"卡号：293173890651","mobile":"18876819356","depositBalance":"124","giftBalance":"0","depositType":"present","createTime":"2018-03-31 08:56:07","remark":"线上和线下消费"},{"memberId":"1149517","prepayCardId":"2092987","cardNo":"卡号：616500517570","mobile":"18907587416","depositBalance":"186","giftBalance":"0","depositType":"present","createTime":"2018-03-31 10:39:55","remark":"线上和线下消费"},{"memberId":"1978533","prepayCardId":"195626","cardNo":"卡号：365157576612","mobile":"15091957984","depositBalance":"142","giftBalance":"0","depositType":"present","createTime":"2018-03-31 14:43:43","remark":"线上和线下消费"},{"memberId":"1978533","prepayCardId":"195626","cardNo":"卡号：365157576612","mobile":"15091957984","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-03-31 14:44:54","remark":"线上和线下消费"},{"memberId":"1978533","prepayCardId":"195626","cardNo":"卡号：365157576612","mobile":"15091957984","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-03-31 14:45:34","remark":"线上和线下消费"},{"memberId":"18392583","prepayCardId":"1992407","cardNo":"卡号：757366647851","mobile":"18889896077","depositBalance":"97","giftBalance":"0","depositType":"present","createTime":"2018-03-31 20:20:02","remark":"线上和线下消费"},{"memberId":"1331595","prepayCardId":"7839","cardNo":"卡号：820564143903","mobile":"18889345171","depositBalance":"88","giftBalance":"0","depositType":"present","createTime":"2018-04-02 19:28:15","remark":"线上和线下消费"},{"memberId":"18917862","prepayCardId":"2092917","cardNo":"卡号：945376106956","mobile":"13337552292","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-04-03 20:31:20","remark":"线上和线下消费"},{"memberId":"19258586","prepayCardId":"2209561","cardNo":"卡号：546119903413","mobile":"18976464824","depositBalance":"43","giftBalance":"0","depositType":"present","createTime":"2018-04-05 17:26:17","remark":"线上和线下消费"},{"memberId":"3568676","prepayCardId":"2133886","cardNo":"卡号：609114934748","mobile":"18689852050","depositBalance":"110","giftBalance":"0","depositType":"present","createTime":"2018-04-09 13:26:56","remark":"线上和线下消费"},{"memberId":"3568676","prepayCardId":"2133886","cardNo":"卡号：609114934748","mobile":"18689852050","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-04-09 13:27:29","remark":"线上和线下消费"},{"memberId":"16087893","prepayCardId":"1996600","cardNo":"卡号：991721863899","mobile":"18217898509","depositBalance":"184","giftBalance":"0","depositType":"present","createTime":"2018-04-10 10:37:51","remark":"线上和线下消费"},{"memberId":"841397","prepayCardId":"4701","cardNo":"卡号：669290729770","mobile":"13698927700","depositBalance":"92","giftBalance":"0","depositType":"present","createTime":"2018-04-11 19:01:09","remark":"线上和线下消费"},{"memberId":"19440226","prepayCardId":"2343800","cardNo":"卡号：644706121023","mobile":"15607563732","depositBalance":"286","giftBalance":"0","depositType":"present","createTime":"2018-04-12 00:57:00","remark":"线上和线下消费"},{"memberId":"18307151","prepayCardId":"1978351","cardNo":"卡号：119402235844","mobile":"15116160115","depositBalance":"102","giftBalance":"0","depositType":"present","createTime":"2018-04-12 21:04:33","remark":"线上和线下消费"},{"memberId":"2203742","prepayCardId":"1184302","cardNo":"卡号：753352849596","mobile":"18689907833","depositBalance":"14","giftBalance":"0","depositType":"present","createTime":"2018-04-14 23:32:04","remark":"线上和线下消费"},{"memberId":"19906481","prepayCardId":"2445420","cardNo":"卡号：205451878187","mobile":"15607618787","depositBalance":"72","giftBalance":"0","depositType":"present","createTime":"2018-04-16 02:24:34","remark":"线上和线下消费"},{"memberId":"16215404","prepayCardId":"1978742","cardNo":"卡号：525944703040","mobile":"18689580359","depositBalance":"474","giftBalance":"0","depositType":"present","createTime":"2018-04-16 21:49:44","remark":"线上和线下消费"},{"memberId":"16215404","prepayCardId":"1978742","cardNo":"卡号：525944703040","mobile":"18689580359","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-04-16 21:50:20","remark":"线上和线下消费"},{"memberId":"16215404","prepayCardId":"1978742","cardNo":"卡号：525944703040","mobile":"18689580359","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-04-16 21:50:54","remark":"线上和线下消费"},{"memberId":"15706493","prepayCardId":"1205114","cardNo":"卡号：225645902272","mobile":"13698991387","depositBalance":"1250","giftBalance":"0","depositType":"present","createTime":"2018-04-19 16:58:28","remark":"线上和线下消费"},{"memberId":"18298557","prepayCardId":"1977039","cardNo":"卡号：524801317593","mobile":"17789737657","depositBalance":"37","giftBalance":"0","depositType":"present","createTime":"2018-04-19 17:20:35","remark":"线上和线下消费"},{"memberId":"3589302","prepayCardId":"2336716","cardNo":"卡号：379184216277","mobile":"15808909582","depositBalance":"552","giftBalance":"0","depositType":"present","createTime":"2018-04-20 09:00:54","remark":"线上和线下消费"},{"memberId":"3589302","prepayCardId":"2336716","cardNo":"卡号：379184216277","mobile":"15808909582","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-04-20 09:01:59","remark":"线上和线下消费"},{"memberId":"3589302","prepayCardId":"2336716","cardNo":"卡号：379184216277","mobile":"15808909582","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-04-20 09:02:53","remark":"线上和线下消费"},{"memberId":"515298","prepayCardId":"2574421","cardNo":"卡号：259462239846","mobile":"13876308583","depositBalance":"390","giftBalance":"0","depositType":"present","createTime":"2018-04-20 20:53:28","remark":"线上和线下消费"},{"memberId":"3111903","prepayCardId":"2643625","cardNo":"卡号：351521398352","mobile":"15248994425","depositBalance":"1002","giftBalance":"0","depositType":"present","createTime":"2018-04-22 10:35:27","remark":"线上和线下消费"},{"memberId":"3111903","prepayCardId":"2643625","cardNo":"卡号：351521398352","mobile":"15248994425","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-04-22 10:36:11","remark":"线上和线下消费"},{"memberId":"3238122","prepayCardId":"408222","cardNo":"卡号：989707185308","mobile":"15595777750","depositBalance":"134","giftBalance":"0","depositType":"present","createTime":"2018-04-23 01:51:51","remark":"线上和线下消费"},{"memberId":"515298","prepayCardId":"2574421","cardNo":"卡号：259462239846","mobile":"13876308583","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-04-23 13:54:36","remark":"线上和线下消费"},{"memberId":"515298","prepayCardId":"2574421","cardNo":"卡号：259462239846","mobile":"13876308583","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-04-23 13:55:20","remark":"线上和线下消费"},{"memberId":"20967649","prepayCardId":"2693295","cardNo":"卡号：486520239213","mobile":"15203636963","depositBalance":"140","giftBalance":"0","depositType":"present","createTime":"2018-04-23 16:14:33","remark":"线上和线下消费"},{"memberId":"20572387","prepayCardId":"2616383","cardNo":"卡号：128621334382","mobile":"15501752550","depositBalance":"104","giftBalance":"0","depositType":"present","createTime":"2018-04-27 09:08:29","remark":"线上和线下消费"},{"memberId":"22378245","prepayCardId":"2939175","cardNo":"卡号：810394316602","mobile":"18689901607","depositBalance":"848","giftBalance":"0","depositType":"present","createTime":"2018-04-29 22:56:06","remark":"线上和线下消费"},{"memberId":"18298059","prepayCardId":"1976987","cardNo":"卡号：596245148212","mobile":"18689780537","depositBalance":"106","giftBalance":"0","depositType":"present","createTime":"2018-05-01 18:16:28","remark":"线上和线下消费"},{"memberId":"18298059","prepayCardId":"1976987","cardNo":"卡号：596245148212","mobile":"18689780537","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-05-01 18:17:00","remark":"线上和线下消费"},{"memberId":"1975841","prepayCardId":"193047","cardNo":"卡号：525195115347","mobile":"18789345783","depositBalance":"156","giftBalance":"0","depositType":"present","createTime":"2018-05-10 22:29:55","remark":"线上和线下消费"},{"memberId":"23892171","prepayCardId":"3231274","cardNo":"卡号：499060214184","mobile":"18876669180","depositBalance":"64","giftBalance":"0","depositType":"present","createTime":"2018-05-15 19:43:44","remark":"线上和线下消费"},{"memberId":"24454083","prepayCardId":"3302133","cardNo":"卡号：107046709038","mobile":"18380126676","depositBalance":"304","giftBalance":"0","depositType":"present","createTime":"2018-05-18 15:33:44","remark":"线上和线下消费"},{"memberId":"1074772","prepayCardId":"2059823","cardNo":"卡号：776887317241","mobile":"15289827285","depositBalance":"1012","giftBalance":"0","depositType":"present","createTime":"2018-05-18 17:59:16","remark":"线上和线下消费"},{"memberId":"1074772","prepayCardId":"2059823","cardNo":"卡号：776887317241","mobile":"15289827285","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-05-18 17:59:48","remark":"线上和线下消费"},{"memberId":"1074772","prepayCardId":"2059823","cardNo":"卡号：776887317241","mobile":"15289827285","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-05-18 18:00:12","remark":"线上和线下消费"},{"memberId":"3729117","prepayCardId":"2153970","cardNo":"卡号：243735168414","mobile":"13519831277","depositBalance":"482","giftBalance":"0","depositType":"present","createTime":"2018-06-04 20:15:30","remark":"线上和线下消费"},{"memberId":"3729117","prepayCardId":"2153970","cardNo":"卡号：243735168414","mobile":"13519831277","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-06-04 20:16:10","remark":"线上和线下消费"},{"memberId":"27510600","prepayCardId":"4016021","cardNo":"卡号：148228387638","mobile":"15872414603","depositBalance":"87","giftBalance":"0","depositType":"present","createTime":"2018-06-10 11:12:39","remark":"线上和线下消费"},{"memberId":"3155234","prepayCardId":"389182","cardNo":"卡号：125857808677","mobile":"18789985420","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-06-13 09:14:23","remark":"线上和线下消费"},{"memberId":"3155234","prepayCardId":"389182","cardNo":"卡号：125857808677","mobile":"18789985420","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-06-13 09:16:09","remark":"线上和线下消费"},{"memberId":"3155234","prepayCardId":"389182","cardNo":"卡号：125857808677","mobile":"18789985420","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-06-13 09:16:34","remark":"线上和线下消费"},{"memberId":"3155234","prepayCardId":"389182","cardNo":"卡号：125857808677","mobile":"18789985420","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-06-13 09:17:07","remark":"线上和线下消费"},{"memberId":"1980439","prepayCardId":"197288","cardNo":"卡号：487148744385","mobile":"13876909544","depositBalance":"439","giftBalance":"0","depositType":"present","createTime":"2018-07-03 19:40:00","remark":"线上和线下消费"},{"memberId":"2901605","prepayCardId":"303891","cardNo":"卡号：159048515565","mobile":"15298959126","depositBalance":"1940","giftBalance":"0","depositType":"present","createTime":"2018-07-03 20:06:37","remark":"线上和线下消费"},{"memberId":"2901605","prepayCardId":"303891","cardNo":"卡号：159048515565","mobile":"15298959126","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-07-03 20:07:21","remark":"线上和线下消费"},{"memberId":"2901605","prepayCardId":"303891","cardNo":"卡号：159048515565","mobile":"15298959126","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-07-03 20:07:51","remark":"线上和线下消费"},{"memberId":"907719","prepayCardId":"1980900","cardNo":"卡号：172042323883","mobile":"13976015520","depositBalance":"76","giftBalance":"0","depositType":"present","createTime":"2018-07-04 09:43:25","remark":"线上和线下消费"},{"memberId":"5244247","prepayCardId":"2170583","cardNo":"卡号：321860747568","mobile":"13707548258","depositBalance":"381","giftBalance":"0","depositType":"present","createTime":"2018-07-04 16:28:55","remark":"线上和线下消费"},{"memberId":"1861445","prepayCardId":"146911","cardNo":"卡号：920086911728","mobile":"18689909171","depositBalance":"578","giftBalance":"0","depositType":"present","createTime":"2018-07-04 20:23:00","remark":"线上和线下消费"},{"memberId":"1861445","prepayCardId":"146911","cardNo":"卡号：920086911728","mobile":"18689909171","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-07-04 20:23:34","remark":"线上和线下消费"},{"memberId":"26407654","prepayCardId":"3711426","cardNo":"卡号：214358179768","mobile":"15289777776","depositBalance":"4","giftBalance":"0","depositType":"present","createTime":"2018-07-09 22:15:24","remark":"线上和线下消费"},{"memberId":"3589302","prepayCardId":"2336716","cardNo":"卡号：379184216277","mobile":"15808909582","depositBalance":"2000","giftBalance":"0","depositType":"present","createTime":"2018-07-10 19:36:21","remark":"线上和线下消费"},{"memberId":"18919288","prepayCardId":"3090124","cardNo":"卡号：253285408502","mobile":"18889407630","depositBalance":"202","giftBalance":"0","depositType":"present","createTime":"2018-07-11 13:33:34","remark":"线上和线下消费"},{"memberId":"18919288","prepayCardId":"3090124","cardNo":"卡号：253285408502","mobile":"18889407630","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-07-11 13:34:53","remark":"线上和线下消费"},{"memberId":"28779434","prepayCardId":"4308945","cardNo":"卡号：221899374706","mobile":"18976382688","depositBalance":"1033","giftBalance":"0","depositType":"present","createTime":"2018-07-15 08:57:18","remark":"线上和线下消费"},{"memberId":"34600734","prepayCardId":"5385342","cardNo":"卡号：570218202628","mobile":"15103663573","depositBalance":"31","giftBalance":"0","depositType":"present","createTime":"2018-07-24 11:14:17","remark":"线上和线下消费"},{"memberId":"18291275","prepayCardId":"2054736","cardNo":"卡号：452865501220","mobile":"18089758078","depositBalance":"914","giftBalance":"0","depositType":"present","createTime":"2018-08-02 08:50:30","remark":"线上和线下消费"},{"memberId":"21292697","prepayCardId":"2760237","cardNo":"卡号：470523116756","mobile":"15211056384","depositBalance":"1002","giftBalance":"0","depositType":"present","createTime":"2018-08-02 10:30:59","remark":"线上和线下消费"},{"memberId":"2285888","prepayCardId":"251405","cardNo":"卡号：248799453141","mobile":"18374071646","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-08-02 10:45:26","remark":"线上和线下消费"},{"memberId":"2285888","prepayCardId":"251405","cardNo":"卡号：248799453141","mobile":"18374071646","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-08-02 10:46:13","remark":"线上和线下消费"},{"memberId":"28625615","prepayCardId":"4295086","cardNo":"卡号：376568344254","mobile":"15284722979","depositBalance":"2000","giftBalance":"0","depositType":"present","createTime":"2018-08-02 17:06:33","remark":"线上和线下消费"},{"memberId":"28625615","prepayCardId":"4295086","cardNo":"卡号：376568344254","mobile":"15284722979","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-08-02 17:07:27","remark":"线上和线下消费"},{"memberId":"28625615","prepayCardId":"4295086","cardNo":"卡号：376568344254","mobile":"15284722979","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-08-02 17:08:03","remark":"线上和线下消费"},{"memberId":"36627333","prepayCardId":"5801843","cardNo":"卡号：272522652050","mobile":"13603087808","depositBalance":"131","giftBalance":"0","depositType":"present","createTime":"2018-08-04 07:24:47","remark":"线上和线下消费"},{"memberId":"36983024","prepayCardId":"5860213","cardNo":"卡号：640057476020","mobile":"13627546417","depositBalance":"111","giftBalance":"0","depositType":"present","createTime":"2018-08-07 10:06:11","remark":"线上和线下消费"},{"memberId":"22240141","prepayCardId":"2906840","cardNo":"卡号：370270727413","mobile":"18689908055","depositBalance":"383","giftBalance":"0","depositType":"present","createTime":"2018-08-09 00:33:16","remark":"线上和线下消费"},{"memberId":"29075348","prepayCardId":"4345781","cardNo":"卡号：568686990534","mobile":"18789254722","depositBalance":"373","giftBalance":"0","depositType":"present","createTime":"2018-08-28 09:35:09","remark":"线上和线下消费"},{"memberId":"29075348","prepayCardId":"4345781","cardNo":"卡号：568686990534","mobile":"18789254722","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-08-28 09:36:08","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"298","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:50:22","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"2000","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:51:02","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:51:46","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:52:34","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:53:17","remark":"线上和线下消费"},{"memberId":"26655279","prepayCardId":"3770213","cardNo":"卡号：347233254683","mobile":"15203644528","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-09-20 16:54:06","remark":"线上和线下消费"},{"memberId":"27367991","prepayCardId":"7236050","cardNo":"卡号：414303654910","mobile":"13322034856","depositBalance":"133","giftBalance":"0","depositType":"present","createTime":"2018-09-21 19:53:20","remark":"线上和线下消费"},{"memberId":"28712102","prepayCardId":"4298194","cardNo":"卡号：678179908137","mobile":"15120856927","depositBalance":"1846","giftBalance":"0","depositType":"present","createTime":"2018-09-23 23:28:13","remark":"线上和线下消费"},{"memberId":"28712102","prepayCardId":"4298194","cardNo":"卡号：678179908137","mobile":"15120856927","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-09-23 23:28:53","remark":"线上和线下消费"},{"memberId":"227553","prepayCardId":"197484","cardNo":"卡号：847647392939","mobile":"18689936006","depositBalance":"61","giftBalance":"0","depositType":"present","createTime":"2018-10-05 11:41:33","remark":"线上和线下消费"},{"memberId":"9696332","prepayCardId":"1977214","cardNo":"卡号：256750377503","mobile":"15008043619","depositBalance":"233","giftBalance":"0","depositType":"present","createTime":"2018-12-07 15:41:59","remark":"线上和线下消费"},{"memberId":"1970039","prepayCardId":"186320","cardNo":"卡号：644407992854","mobile":"15289761405","depositBalance":"322","giftBalance":"0","depositType":"present","createTime":"2018-12-07 16:05:35","remark":"线上和线下消费"},{"memberId":"22378245","prepayCardId":"2939175","cardNo":"卡号：810394316602","mobile":"18689901607","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-12-07 16:19:35","remark":"线上和线下消费"},{"memberId":"29075348","prepayCardId":"4345781","cardNo":"卡号：568686990534","mobile":"18789254722","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2018-12-07 16:58:12","remark":"线上和线下消费"},{"memberId":"1970039","prepayCardId":"186320","cardNo":"卡号：644407992854","mobile":"15289761405","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2018-12-07 18:19:35","remark":"线上和线下消费"},{"memberId":"1970039","prepayCardId":"186320","cardNo":"卡号：644407992854","mobile":"15289761405","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2018-12-07 18:20:09","remark":"线上和线下消费"},{"memberId":"23403980","prepayCardId":"3156622","cardNo":"卡号：565223579960","mobile":"18608921188","depositBalance":"222","giftBalance":"0","depositType":"present","createTime":"2018-12-10 14:07:47","remark":"线上和线下消费"},{"memberId":"38119922","prepayCardId":"6105063","cardNo":"卡号：323364867123","mobile":"(null)","depositBalance":"0.01","giftBalance":"0","depositType":"present","createTime":"2018-12-13 15:07:46","remark":"线上和线下消费"},{"memberId":"55113649","prepayCardId":"10148245","cardNo":"卡号：171562960461","mobile":"15810148762","depositBalance":"0.01","giftBalance":"0","depositType":"present","createTime":"2018-12-13 15:14:31","remark":"线上和线下消费"},{"memberId":"18302678","prepayCardId":"1977680","cardNo":"卡号：974390234003","mobile":"18789776524","depositBalance":"1324","giftBalance":"0","depositType":"present","createTime":"2018-12-18 19:28:24","remark":"线上和线下消费"},{"memberId":"59595783","prepayCardId":"11426059","cardNo":"卡号：951652879052","mobile":"15953159862","depositBalance":"15","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-19 20:46:44","remark":"线上消费"},{"memberId":"1383213","prepayCardId":"29144","cardNo":"卡号：217656817078","mobile":"18904000626","depositBalance":"220","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-21 19:43:06","remark":"线上消费"},{"memberId":"60112928","prepayCardId":"11607795","cardNo":"卡号：227635451556","mobile":"18624037968","depositBalance":"61","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-24 08:43:00","remark":"线上消费"},{"memberId":"60724239","prepayCardId":"11841089","cardNo":"卡号：585206215301","mobile":"18903292299","depositBalance":"661","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-24 18:42:17","remark":"线上消费"},{"memberId":"60724239","prepayCardId":"11841089","cardNo":"卡号：585206215301","mobile":"18903292299","depositBalance":"24.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-24 19:08:53","remark":"线上消费"},{"memberId":"791157","prepayCardId":"514582","cardNo":"卡号：335593722788","mobile":"13901230508","depositBalance":"6684","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-26 12:55:48","remark":"线上消费"},{"memberId":"1047395","prepayCardId":"236028","cardNo":"卡号：441296776988","mobile":"13828709150","depositBalance":"752","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-26 13:18:06","remark":"线上消费"},{"memberId":"2247","prepayCardId":"1589","cardNo":"卡号：565121379928","mobile":"13637549447","depositBalance":"3153","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-28 22:36:55","remark":"线上消费"},{"memberId":"2247","prepayCardId":"1589","cardNo":"卡号：565121379928","mobile":"13637549447","depositBalance":"1999","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-29 09:26:49","remark":"线上消费"},{"memberId":"2160701","prepayCardId":"230684","cardNo":"卡号：824360516356","mobile":"13501910531","depositBalance":"7907","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-30 10:37:30","remark":"线上消费"},{"memberId":"45716710","prepayCardId":"7679398","cardNo":"卡号：276885547590","mobile":"13566517772","depositBalance":"3098","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-31 07:48:02","remark":"线上消费"},{"memberId":"45716710","prepayCardId":"7679398","cardNo":"卡号：276885547590","mobile":"13566517772","depositBalance":"7999","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-31 07:48:19","remark":"线上消费"},{"memberId":"45716710","prepayCardId":"7679398","cardNo":"卡号：276885547590","mobile":"13566517772","depositBalance":"7999","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-31 07:48:34","remark":"线上消费"},{"memberId":"45716710","prepayCardId":"7679398","cardNo":"卡号：276885547590","mobile":"13566517772","depositBalance":"7999","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-31 07:53:44","remark":"线上消费"},{"memberId":"61702608","prepayCardId":"12160728","cardNo":"卡号：248522150695","mobile":"13669314820","depositBalance":"41","giftBalance":"0","depositType":"wxpay","createTime":"2019-01-31 18:04:33","remark":"线上消费"},{"memberId":"9234584","prepayCardId":"2957476","cardNo":"卡号：240808442343","mobile":"13707568201","depositBalance":"405","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-01 08:59:40","remark":"线上消费"},{"memberId":"9478806","prepayCardId":"1181436","cardNo":"卡号：360099815114","mobile":"18689593808","depositBalance":"1623.8","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-04 10:28:32","remark":"线上消费"},{"memberId":"62181485","prepayCardId":"12333082","cardNo":"卡号：382686709539","mobile":"13908513883","depositBalance":"446","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-06 09:15:41","remark":"线上消费"},{"memberId":"1362038","prepayCardId":"53328","cardNo":"卡号：214564639176","mobile":"13307610378","depositBalance":"502.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-06 10:11:04","remark":"线上消费"},{"memberId":"15865013","prepayCardId":"1252605","cardNo":"卡号：535453815610","mobile":"13223207786","depositBalance":"2854","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-08 10:28:48","remark":"线上消费"},{"memberId":"48767504","prepayCardId":"11945848","cardNo":"卡号：749588891955","mobile":"15289875820","depositBalance":"594","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-09 21:28:38","remark":"线上消费"},{"memberId":"1482595","prepayCardId":"44298","cardNo":"卡号：889009311101","mobile":"18909083977","depositBalance":"228","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-10 16:44:59","remark":"线上消费"},{"memberId":"62725750","prepayCardId":"12488504","cardNo":"卡号：296046964300","mobile":"18804131858","depositBalance":"458","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-11 11:56:30","remark":"线上消费"},{"memberId":"882484","prepayCardId":"49688","cardNo":"卡号：246829988121","mobile":"13876989626","depositBalance":"2292","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-12 12:39:26","remark":"线上消费"},{"memberId":"62943288","prepayCardId":"12576673","cardNo":"卡号：218911305022","mobile":"18550557111","depositBalance":"1200","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-12 19:15:28","remark":"线上消费"},{"memberId":"16102108","prepayCardId":"1328511","cardNo":"卡号：821130881007","mobile":"19989773559","depositBalance":"541","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-12 21:05:01","remark":"线上消费"},{"memberId":"61682825","prepayCardId":"12153486","cardNo":"卡号：216135583195","mobile":"13601298565","depositBalance":"1400","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-13 18:11:17","remark":"线上消费"},{"memberId":"39249","prepayCardId":"37067","cardNo":"卡号：120685110794","mobile":"13807666863","depositBalance":"983","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-13 23:25:04","remark":"线上消费"},{"memberId":"901578","prepayCardId":"17093","cardNo":"卡号：145260720464","mobile":"13701306989","depositBalance":"2685.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-15 19:51:59","remark":"线上消费"},{"memberId":"901578","prepayCardId":"17093","cardNo":"卡号：145260720464","mobile":"13701306989","depositBalance":"4999","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-15 19:56:53","remark":"线上消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"71","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:11:38","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:12:14","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:12:35","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:12:54","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:13:14","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:13:35","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:13:49","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:14:08","remark":"线上和线下消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"100","giftBalance":"0","depositType":"present","createTime":"2019-02-17 22:14:26","remark":"线上和线下消费"},{"memberId":"1959601","prepayCardId":"180312","cardNo":"卡号：239228751330","mobile":"13602513988","depositBalance":"3102","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-19 10:41:54","remark":"线上消费"},{"memberId":"3102991","prepayCardId":"364140","cardNo":"卡号：982830129563","mobile":"18610661588","depositBalance":"3409","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-20 18:08:29","remark":"线上消费"},{"memberId":"64048752","prepayCardId":"13008141","cardNo":"卡号：326273263883","mobile":"15210711223","depositBalance":"172","giftBalance":"0","depositType":"wxpay","createTime":"2019-02-21 14:11:44","remark":"线上消费"},{"memberId":"8406580","prepayCardId":"4111250","cardNo":"卡号：529680724312","mobile":"18689760131","depositBalance":"500","giftBalance":"0","depositType":"present","createTime":"2019-02-27 10:15:19","remark":"线上和线下消费"},{"memberId":"18962648","prepayCardId":"2108553","cardNo":"卡号：361259547704","mobile":"18189788668","depositBalance":"1542","giftBalance":"0","depositType":"present","createTime":"2019-02-27 13:39:57","remark":"线上和线下消费"},{"memberId":"18962648","prepayCardId":"2108553","cardNo":"卡号：361259547704","mobile":"18189788668","depositBalance":"1000","giftBalance":"0","depositType":"present","createTime":"2019-02-27 13:42:24","remark":"线上和线下消费"},{"memberId":"18962648","prepayCardId":"2108553","cardNo":"卡号：361259547704","mobile":"18189788668","depositBalance":"200","giftBalance":"0","depositType":"present","createTime":"2019-02-27 13:43:08","remark":"线上和线下消费"},{"memberId":"64270","prepayCardId":"313568","cardNo":"卡号：362339169277","mobile":"18689898878","depositBalance":"1448","giftBalance":"0","depositType":"wxpay","createTime":"2019-03-14 20:30:46","remark":"线上消费"},{"memberId":"51959563","prepayCardId":"9393339","cardNo":"卡号：324952958505","mobile":"13804760655","depositBalance":"601","giftBalance":"0","depositType":"wxpay","createTime":"2019-03-25 11:02:44","remark":"线上消费"},{"memberId":"5616651","prepayCardId":"14994481","cardNo":"卡号：965575138464","mobile":"18689813170","depositBalance":"817","giftBalance":"0","depositType":"present","createTime":"2019-03-27 23:39:45","remark":"线上和线下消费"},{"memberId":"70230478","prepayCardId":"15101965","cardNo":"卡号：413955692933","mobile":"13011840049","depositBalance":"20","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-03 11:18:58","remark":"线上消费"},{"memberId":"71614365","prepayCardId":"15326123","cardNo":"卡号：752078122520","mobile":"13546423457","depositBalance":"1049.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-11 05:37:02","remark":"线上消费"},{"memberId":"71281616","prepayCardId":"15274853","cardNo":"卡号：255757105161","mobile":"13590246871","depositBalance":"24","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-13 10:22:04","remark":"线上消费"},{"memberId":"72063784","prepayCardId":"15388193","cardNo":"卡号：135510609021","mobile":"13632851778","depositBalance":"323","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-21 07:52:00","remark":"线上消费"},{"memberId":"1314021","prepayCardId":"2124","cardNo":"卡号：166665468654","mobile":"18689678672","depositBalance":"3735","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-25 22:23:53","remark":"线上消费"},{"memberId":"39068095","prepayCardId":"6243240","cardNo":"卡号：864614320475","mobile":"18689923859","depositBalance":"471","giftBalance":"0","depositType":"wxpay","createTime":"2019-04-28 13:20:17","remark":"线上消费"},{"memberId":"1638134","prepayCardId":"174286","cardNo":"卡号：193086138166","mobile":"13518055657","depositBalance":"103","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-04 11:27:49","remark":"线上消费"},{"memberId":"1172158","prepayCardId":"15283426","cardNo":"卡号：137481233189","mobile":"13803453068","depositBalance":"1049.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-07 18:30:19","remark":"线上消费"},{"memberId":"24823037","prepayCardId":"3372755","cardNo":"卡号：670166821027","mobile":"18613058909","depositBalance":"425.5","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-11 00:55:02","remark":"线上消费"},{"memberId":"74783260","prepayCardId":"15757648","cardNo":"卡号：584498540389","mobile":"13875815304","depositBalance":"149","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-11 13:43:24","remark":"线上消费"},{"memberId":"78840252","prepayCardId":"16234548","cardNo":"卡号：622700885849","mobile":"13976078488","depositBalance":"719","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-30 09:41:13","remark":"线上消费"},{"memberId":"78840252","prepayCardId":"16234548","cardNo":"卡号：622700885849","mobile":"13976078488","depositBalance":"841","giftBalance":"0","depositType":"wxpay","createTime":"2019-05-31 15:11:32","remark":"线上消费"},{"memberId":"35053137","prepayCardId":"5466429","cardNo":"卡号：222390941731","mobile":"15248922000","depositBalance":"10","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-06 17:59:10","remark":"线上消费"},{"memberId":"71898461","prepayCardId":"15363268","cardNo":"卡号：843813177605","mobile":"15375514848","depositBalance":"1196","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-13 09:51:05","remark":"线上消费"},{"memberId":"83759270","prepayCardId":"16873382","cardNo":"卡号：142836312631","mobile":"18876867282","depositBalance":"63","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-22 01:43:36","remark":"线上消费"},{"memberId":"1180433","prepayCardId":"313752","cardNo":"卡号：519256375075","mobile":"18608986868","depositBalance":"82","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-25 16:08:00","remark":"线上消费"},{"memberId":"84434948","prepayCardId":"16945511","cardNo":"卡号：118309601129","mobile":"13976222595","depositBalance":"1130","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-26 14:04:31","remark":"线上消费"},{"memberId":"2161713","prepayCardId":"230714","cardNo":"卡号：837973264060","mobile":"13627506140","depositBalance":"2573","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-29 08:34:56","remark":"线上消费"},{"memberId":"84785430","prepayCardId":"16989937","cardNo":"卡号：620353955076","mobile":"18085048183","depositBalance":"882","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-29 10:12:45","remark":"线上消费"},{"memberId":"84987419","prepayCardId":"17017263","cardNo":"卡号：571718943777","mobile":"18976939133","depositBalance":"1280","giftBalance":"0","depositType":"wxpay","createTime":"2019-06-29 12:18:30","remark":"线上消费"},{"memberId":"3805746","prepayCardId":"431032","cardNo":"卡号：215435471068","mobile":"13905083097","depositBalance":"667","giftBalance":"0","depositType":"wxpay","createTime":"2019-07-05 19:38:00","remark":"线上消费"},{"memberId":"87300051","prepayCardId":"17361061","cardNo":"卡号：277741227814","mobile":"13976118598","depositBalance":"302","giftBalance":"0","depositType":"wxpay","createTime":"2019-07-12 20:30:33","remark":"线上消费"},{"memberId":"1215010","prepayCardId":"17577683","cardNo":"卡号：618290653790","mobile":"13927311222","depositBalance":"441","giftBalance":"0","depositType":"wxpay","createTime":"2019-07-20 11:20:45","remark":"线上消费"},{"memberId":"3311039","prepayCardId":"424217","cardNo":"卡号：480755824154","mobile":"18789780030","depositBalance":"19","giftBalance":"0","depositType":"wxpay","createTime":"2019-07-27 02:37:11","remark":"线上消费"},{"memberId":"1887341","prepayCardId":"153554","cardNo":"卡号：842243804219","mobile":"13811011913","depositBalance":"142","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-03 11:49:40","remark":"线上消费"},{"memberId":"91967485","prepayCardId":"17956645","cardNo":"卡号：751851855731","mobile":"17597978997","depositBalance":"49","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-06 14:03:29","remark":"线上消费"},{"memberId":"23589091","prepayCardId":"18091938","cardNo":"卡号：420967699542","mobile":"15109889093","depositBalance":"58","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-10 20:12:24","remark":"线上消费"},{"memberId":"93504650","prepayCardId":"18177321","cardNo":"卡号：593164488232","mobile":"13198961608","depositBalance":"125","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-12 23:10:19","remark":"线上消费"},{"memberId":"881364","prepayCardId":"6602","cardNo":"卡号：612326605639","mobile":"15208931666","depositBalance":"1472","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-14 18:31:07","remark":"线上消费"},{"memberId":"85285525","prepayCardId":"17050995","cardNo":"卡号：298895271632","mobile":"18608923232","depositBalance":"953","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-17 14:31:28","remark":"线上消费"},{"memberId":"37620708","prepayCardId":"6014959","cardNo":"卡号：255548701132","mobile":"18616637159","depositBalance":"201","giftBalance":"0","depositType":"wxpay","createTime":"2019-08-23 10:06:44","remark":"线上消费"},{"memberId":"64064194","prepayCardId":"13012062","cardNo":"卡号：829960185179","mobile":"13925268494","depositBalance":"49","giftBalance":"0","depositType":"wxpay","createTime":"2019-09-05 01:07:50","remark":"线上消费"},{"memberId":"952971","prepayCardId":"143943","cardNo":"卡号：607154937081","mobile":"15808905262","depositBalance":"96","giftBalance":"0","depositType":"wxpay","createTime":"2020-08-20 21:47:58","remark":"线上消费"}]';

		$moveUsers = json_decode($json1, true);
		$data = "";
//		$moveUsers = [];
		foreach ($moveUsers as $b) {
			$cardNo = iconv("utf-8", "gbk//IGNORE", $b['cardNo']);
			$remark = iconv("utf-8", "gbk//IGNORE", $b['remark']);
			$data .= "{$b['memberId']}\t,{$b['prepayCardId']}\t,{$cardNo},{$b['mobile']}\t,{$b['depositBalance']}\t"
				. ",{$b['giftBalance']}\t,{$b['depositType']},{$b['createTime']},{$remark}\n";
		}
		$title = iconv("utf-8", "gbk//IGNORE", $title);
		$data = $title . $data;
		header("Cache-control: private");
		header("Pragma: public");
		header('Content-type: application/x-csv');
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5')) {
			header("Content-Disposition: inline; filename=$outformat");
		} else {
			header("Content-Disposition: attachment; filename=$outformat");
		}
		echo $data;
		exit;

	}


	public function download(){

//		$IndexLogic = new logic\IndexLogic();
//		$xlsData = $IndexLogic->download(10000);
//dump($xlsData);die;
		$xlsName  = "User用户数据表";
		$xlsCell  = array(
			array('member_id','账号序列'),
			array('member_name','名字'),
			array('mobile','手机号'),
			array('gender','状态'),
		);

		$xlsData = [];
		$this->exportExcel_2();
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
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

	public function readExcel() {
//		$baseUrl = LIB_PATH.'vendor';
//		Loader::import("PHPExcel.PHPExcel", $baseUrl);
//		$objPHPExcel = new \PHPExcel();
//		$objPHPExcel->

//		$objPHPExcel=new \PHPExcel();
//		$objPHPExcel->
//		new \PHPExcel_Reader_Excel2007();

		$dirName = '/mymulu/wnmp/www/';
//		$targetFile = $dirName'zkt.refund_log.xlsx';

		$handle1 = opendir($dirName);
		//遍历文件夹
		while(($res = readdir($handle1)) !== false){
			if($res != '.' && $res != '..'){
				//如果是文件，提出文件内容，写入目标文件
				if(is_file($dirName.'/'.$res)){
					$fileName = $dirName.'/'.$res;
					if(!strpos($fileName, 'zkt.refund_log.xlsx')){
						continue;
					}
					$filetime[] = date ( "Y-m-d H:i:s", filemtime ( $fileName ) ); // 获取文件最近修改日期
					$path[]=$fileName;
dump($fileName);
					//读
					$handle2 = fopen($fileName,'r');
					if($str = fread($handle2,filesize($fileName))){
						fclose($handle2);
//						$handle3 = fopen($fileName,'a+');
						dump($str);
//						if(fwrite($handle3, $str)){
////							fwrite($handle3,"\n");
//							fclose($handle3);
//						}
					}
				}
				/*//如果是文件夹，继续调用mergeCSV方法
				if(is_dir($dirName.'/'.$res)){
					$newDirName = $dirName.'/'.$res;
					mergeCSV($newDirName,$targetFile);
				}*/
			}
		}
		@closedir ( $handle1 );


		echo 1;
	}
}
