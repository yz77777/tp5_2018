<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2018/7/31
 * Time: 上午11:43
 */
namespace app\home\controller;
use app\home\logic;
use think\Loader;
use think\Debug;
use think\Controller;
use app\home\factory;
class TestController extends Controller
{
	public function index(){
		$xian = [5,35069,35800,49221,49266,59166,60042,60378,60666,60833,66875,66894,133135,150273,158031,171069,182891,182978,182989,183005,183006,183037,183067,183081,183159,183276,183410,183895,183993,184188,184222,184309,184453,184456,184620,184633,184634,184688,184824,184965,185119,185129,185337,185338,185355,185500,185552,185556,185558,186333,186334,186336,186350,186372,186411,186458,186463,186516,186539,186600,186631,186667,186733,186743,186775,186793,186841,186842,187019,187062,187073,187117,187239,187281,187406,187414,187441,187455,187481,187485,187489,187494,187498,187559,187590,187619,187763,187858,188027,188074,188076,188132,188133,188134,188222,188238,188241,188275,188319,188431,188435,188458,188486,188531,188532,188533,188534,188535,188558,188563,188663,188685,188704,188724,188725,188811,188915,189124,189272,189297,189452,189845,190315,190511,190954,191843,192035,193267,193298,193439,193456,193489,193514,193557,193662,193692,193693,193748,193810,193839,193861,193862,193871,193924,193926,193950,194143,194223,194243,194244,194245,194265,194321,194366,194395,194411,194447,194498,194500,194609,194651,194695,194716,194778,194793,194816,194836,194882,194887,194888,194951,194974,194977,195035,195090,195091,195118,195386,195422,195502,195730,195731,195738,195739,195744,195745,195791,195793,195934,195960,195962,195963,196004,196138,196139,196184,196327,196329,196332,196333];

//		$xian = [48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583,48182583];
		$xian = [5,10035,10358,10991,11055,11091,11128,11240,11360,12419,12781,13778,17870,34009,34601,35158,37138,37431,37804,37959,39222,39683,40729,41224,41421,45650,45694,46172,46468,47316,47472,47720,47985,48721,48764,48806,49493,49728,50327,50364,50406,50669,50724,50920,51463,55514,58137,58751,59904,60173,60529,60887,65790,66894,67105,67401,70710,73454,76457,81713,84116,132313,134487,143366,143371,143969,148283,161580,173591,175249,177619,181054,181458,181459,181470,182870,182874,182888,182891,182911,182914,182916,182918,182919,182924,182927,182960,182962,182969,182971,182972,182983,182986,182987,182992,182995,183030,183033,183040,183045,183046,183052,183053,183055,183058,183062,183073,183079,183080,183083,183088,183098,183103,183118,183121,183129,183134,183142,183143,183154,183159,183160,183161,183162,183163,183167,183171,183175,183178,183185,183188,183189,183199,183204,183208,183213,183214,183225,183226,183229,183232,183242,183243,183246,183248,183249,183251,183252,183256,183259,183262,183274,183284,183291,183297,183301,183302,183305,183311,183327,183332,183335,183336,183345,183347,183355,183363,183366,183367,183372,183376,183378,183392,183397,183415,183428,183430,183435,183444,183456,183471,183474,183477,183479,183480,183481,183482,183485,183493,183501,183506,183519,183532,183536,183537,183538,183543,183544,183554,183568,183570,183572,183578,183582,183589,183593,183606,183620,183622,183623,183624,183626,183632,183664,183675,183680,183682,183705,183717,183740,183748,183749,183754,183757,183759,183761,183762,183763,183765,183767,183768,183772,183786,183788,183791,183793,183803,183804,183807,183816,183823,183826,183835,183836,183837,183838,183844,183845,183846,183852,183854,183855,183863,183864,183892,183901,183903,183912,183913,183915,183918,183919,183923,183926,183937,183941,183943,183944,183946,183949,183952,183953,183959,183960,183963,183964,183977,183978,183985,183998,184033,184039,184041,184043,184046,184061,184062,184067,184068,184070,184075,184079,184080,184081,184090,184095,184096,184099,184100,184108,184116,184119,184144,184148,184153,184156,184158,184163,184168,184184,184186,184190,184194,184200,184202,184210,184219,184221,184225,184226,184236,184249,184252,184264,184267,184295,184300,184312,184316,184327,184328,184354,184356,184362,184372,184382,184389,184394,184397,184414,184431,184433,184434,184441,184446,184450,184452,184458,184464,184477,184478,184481,184483,184484,184489,184493,184498,184510,184525,184531,184572,184580,184581,184585,184590,184593,184594,184596,184598,184601,184605,184608,184609,184636,184641,184659,184663,184670,184675,184676,184678,184680,184686,184689,184692,184698,184702,184718,184720,184726,184736,184737,184738,184744,184750,184753,184755,184757,184772,184785,184786,184809,184810,184826,184831,184838,184849,184856,184866,184874,184876,184912,184913,184927,184936,184941,184961,184965,184974,184979,184981,184983,184990,184992,184999,185000,185006,185008,185010,185014,185018,185021,185023,185026,185027,185030,185033,185047,185058,185066,185068,185072,185084,185086,185093,185098,185099,185102,185107,185108,185112,185114,185116,185125,185126,185139,185143,185144,185145,185146,185155,185157,185189,185196,185198,185203,185206,185209,185221,185223,185226,185232,185233,185242,185245,185247,185250,185263,185264,185265,185267,185268,185273,185281,185293,185296,185304,185314,185315,185323,185325,185330,185331,185332,185334,185335,185336,185343,185347,185353,185356,185358,185376,185388,185391,185401,185403,185415,185423,185426,185435,185448,185449,185454,185465,185467,185473,185474,185483,185492,185498,185508,185514,185515,185520,185536,185540,185553,185561,185569,185584,185586,185588,185610,185621,185622,185624,185627,185630,185633,185637,185639,185672,185674,185686,185689,185700,185706,185711,185712,185713,185718,185728,185730,185754,185760,185790,185798,185799,185803,185804,185813,185817,185826,185837,185846,185864,185887,185892,185905,185906,185932,185940,185968,185971,185976,185995,185996,186000,186064,186066,186073,186080,186091,186092,186097,186117,186126,186133,186140,186146,186148,186198,186199,186213,186214,186217,186224,186241,186243,186248,186261,186266,186300,186301,186310,186311,186330,186339,186341,186368,186375,186376,186387,186392,186394,186395,186408,186412,186440,186441,186442,186457,186467,186472,186478,186482,186491,186492,186494,186508,186510,186511,186516,186521,186530,186545,186597,186599,186602,186604,186621,186635,186654,186672,186685,186689,186701,186726,186730,186748,186755,186758,186778,186784,186788,186794,186797,186806,186812,186813,186830,186831,186835,186837,186855,186889,186919,186933,186936,186938,186939,186945,186946,186952,186971,186988,187030,187045,187048,187050,187054,187062,187071,187072,187074,187078,187087,187112,187113,187116,187135,187144,187152,187153,187161,187167,187171,187188,187216,187219,187227,187242,187247,187257,187279,187297,187315,187326,187335,187363,187367,187381,187382,187383,187386,187387,187428,187431,187442,187450,187458,187466,187473,187474,187479,187488,187515,187517,187525,187530,187533,187539,187540,187556,187588,187590,187594,187599,187611,187648,187661,187672,187681,187682,187690,187691,187692,187703,187709,187710,187711,187716,187753,187759,187772,187777,187783,187798,187801,187804,187815,187817,187818,187820,187821,187838,187841,187847,187852,187865,187875,187881,187894,187896,187906,187915,187929,187936,187948,187976,187978,188001,188006,188007,188015,188020,188027,188036,188048,188054,188056,188059,188062,188067,188111,188115,188121,188130,188131,188138,188142,188152,188160,188171,188181,188191,188192,188199,188211,188229,188240,188252,188255,188259,188278,188281,188287,188302,188307,188318,188320,188331,188339,188341,188373,188375,188381,188406,188423,188431,188437,188451,188479,188488,188491,188503,188505,188508,188524,188529,188535,188537,188538,188549,188568,188607,188613,188616,188617,188620,188638,188641,188642,188643,188648,188654,188658,188666,188670,188679,188701,188702,188722,188740,188745,188746,188753,188756,188775,188778,188782,188784,188793,188800,188813,188820,188821,188827,188830,188831,188835,188844,188849,188852,188860,188861,188862,188866,188869,188888,188892,188906,188917,188922,188925,188936,188940,188958,188970,188972,188982,188984,188985,188988,188995,189001,189017,189023,189037,189042,189049,189061,189064,189088,189092,189094,189096,189105,189113,189116,189119,189138,189143,189145,189146,189154,189158,189159,189178,189181,189186,189189,189210,189228,189229,189237,189238,189240,189263,189268,189271,189273,189286,189326,189333,189337,189350,189351,189354,189366,189374,189379,189403,189406,189419,189429,189452,189456,189473,189486,189489,189515,189519,189538,189539,189541,189553,189593,189607,189617,189623,189631,189645,189652,189653,189659,189663,189667,189670,189676,189710,189713,189719,189720,189744,189748,189759,189765,189786,189792,189793,189802,189812,189818,189820,189823,189840,189843,189859,189865,189886,189890,189898,189903,189906,189908,189909,189910,189935,189938,189943,189947,189963,189977,189978,189990,190005,190039,190053,190068,190071,190080,190082,190110,190119,190145,190146,190147,190149,190171,190173,190187,190206,190263,190264,190266,190270,190286,190294,190296,190324,190345,190354,190369,190376,190377,190378,190383,190391,190398,190417,190419,190422,190426,190447,190448,190453,190463,190464,190468,190473,190477,190485,190488,190496,190510,190511,190516,190534,190535,190537,190546,190596,190599,190614,190616,190617,190620,190630,190631,190635,190637,190653,190654,190658,190662,190663,190666,190668,190669,190670,190676,190687,190688,190698,190704,190723,190735,190764,190791,190793,190813,190825,190844,190849,190858,190864,190899,190907,190910,190921,190930,190935,190939,190940,190946,190982,190989,190995,191003,191016,191047,191065,191087,191090,191105,191132,191133,191141,191143,191145,191157,191172,191175,191178,191191,191192,191193,191196,191226,191228,191234,191260,191263,191265,191324,191352,191354,191355,191357,191372,191373,191376,191377,191380,191381,191385,191411,191414,191415,191418,191425,191427,191446,191459,191476,191481,191503,191514,191517,191541,191547,191572,191602,191645,191656,191658,191663,191669,191675,191676,191677,191684,191697,191713,191727,191729,191756,191790,191797,191798,191805,191811,191869,191890,191927,191929,191942,191989,192004,192006,192018,192064,192118,192131,192161,192178,192207,192214,192218,192258,192264,192321,192324,192325,192365,192370,192371,192380,192394,192400,192424,192430,192442,192443,192447,192451,192457,192488,192504,192575,192577,192596,192599,192604,192614,192619,192620,192634,192652,192665,192668,192670,192681,192683,192689,192698,192705,192713,192760,192795,192803,192811,192819,192825,192837,192839,192841,192844,192909,192917,192924,192930,192967,192981,192989,193023,193028,193041,193047,193048,193050,193059,193080,193082,193087,193091,193106,193111,193129,193132,193173,193218,193273,193276,193279,193296,193319,193325,193341,193350,193371,193372,193390,193394,193395,193405,193433,193450,193454,193455,193458,193468,193479,193492,193512,193513,193525,193531,193562,193564,193571,193599,193604,193614,193621,193649,193682,193685,193695,193737,193747,193752,193761,193824,193826,193827,193861,193863,193885,193886,193894,193896,193898,193933,193935,193936,193944,193946,193947,193956,193963,193965,193975,193977,193987,194004,194020,194026,194027,194030,194031,194033,194035,194036,194037,194042,194049,194056,194063,194064,194082,194085,194092,194101,194116,194117,194135,194142,194149,194165,194192,194211,194230,194256,194258,194269,194270,194328,194335,194339,194354,194367,194385,194413,194434,194443,194467,194484,194493,194502,194503,194518,194533,194567,194570,194576,194604,194605,194606,194610,194624,194626,194627,194679,194683,194696,194698,194702,194708,194715,194723,194728,194733,194747,194748,194764,194767,194775,194781,194788,194791,194794,194800,194806,194823,194856,194857,194892,194893,194907,194915,194917,194921,194927,194938,194953,194972,194974,194984,194993,195013,195018,195024,195032,195033,195034,195038,195039,195040,195042,195043,195059,195069,195086,195092,195096,195118,195125,195132,195139,195171,195180,195184,195222,195229,195235,195256,195266,195268,195282,195292,195295,195302,195338,195352,195360,195382,195394,195397,195408,195412,195428,195430,195431,195440,195448,195449,195455,195484,195488,195547,195554,195559,195567,195572,195583,195599,195602,195615,195621,195633,195667,195678,195692,195693,195711,195720,195734,195748,195750,195769,195781,195783,195821,195825,195839,195847,195867,195870,195874,195901,195913,195916,195917,195921,195930,195935,195965,195987,195997,196007,196023,196040,196059,196062,196063,196075,196076,196083,196097,196105,196132,196145,196173,196206,196219,196260,196265,196282,196283,196319,196345,196375,196410,196437,196446,196451,196494,196506,196509,196510,196517,196518,196540,196566,196587,196593,196637,196648,196750,196751,196759,196772,196814,196824,196828,196834,196845,196882,196890,196894,196926,196945,197071,197075,197078,197080,197085,197089,197091,197104,197105,197127,197254,197258,197261,197264,197283,197286,197298,197353,197402,197429,197441,197449,197468,197470,197475,197486,197492,197525,197535,197556,197672,197677,197678,197697,197710,197740,197748,197752,197766,197781,197783,197806,197839,197847,197872,197879,197933,197938,197941,197970,197975,197984,198000,198010,198021,198039,198122,198150,198151,198158,198187,198205,198210,198226,198244,198271,198294,198318,198348,198349,198408,198427,198429,198448,198492,198501,198517,198527,198529,198536,198610,198616,198617,198685,198686,198694,198731,198766,198789,198817,198818,198937,198939,198942,198993,198995,198996,199002,199009,199047,199089,199122,199125,199127,199133,199148,199149,199185,199188,199223,199230,199243,199252,199270,199271,199302,199306,199322,199324,199329,199337,199338,199339,199342,199344,199391,199399,199402,199429,199454,199467,199504,199518,199520,199528,199532,199560,199597,199608,199627,199633,199638,199652,199655,199685,199690,199709,199733,199737,199747,199752,199761,199769,199778,199825,199846,199855,199868,199883,199889,199919,199971,199974,199977,200051,200068,200079,200081,200099,200118,200134,200153,200173,200176,200199,200245,200246,200263,200279,200280,200282,200322,200335,200340,200348,200371,200378,200395,200408,200421,200425,200459,200462,200474,200520,200534,200579,200590,200592,200603,200632,200676,200754,200762,200826,200834,200838,200850,200874,200889,200911,200916,200930,200960,200978,200998,201058,201080,201091,201093,201104,201105,201106,201108,201112,201132,201174,201176,201194,201204,201229,201237,201264,201274,201310,201363,201383,201398,201471,201541,201564,201574,201599,201635,201717,201733,201741,201742,201754,201760,201794,201864,201886,201930,201949,201989,201997,202038,202055,202057,202066,202099,202114,202120,202126,202145,202150,202152,202154,202159,202187,202256,202263,202265,202280,202298,202324,202334,203496,203780,204127,204380,205864,206206,206291,206293,206445,206554,206585,206595,206597,206608,206612,206622,206624,206625,206629,206632,206642,206646,206669,206739,206770,206806,206858,206862,206866,206904,206919,206937,206946,206962,206982,207024,207036,207070,207155,207162,207222,207234,207241,207258,207263,207269,207296,207302,207315,207319,207333,207359,207363,207371,207375,207382,207393,207412,207413,207562,207574,207575,207622,207661,207662,207680,207718,207725,207736,207737,207745,207800,207834,207919,207923,207928,207935,207955,207958,207959,207970,207971,207972,207983,207990,207994,207999,208007,208032,208033,208042,208052,208069,208071,208076,208081,208082,208087,208103,208118,208120,208165,208169,208172,208193,208194,208196,208198,208199,208209,208229,208241,208252,208253,208288,208289,208300,208305,208310,208311,208312,208313,208314,208315,208316,208319,208328,208335,208337,208340,208354,208366,208443,208466];
		$xian = [424,384,580,1405,433,549,376,476,424,384,401,354,403,354,344,386];
//		dump(count($xian));
//		dump(count(array_unique($xian)));

		$arr = [
			'template_1' => [
				'prepaycard-bg'=>'/static/img/prepay-card/template1/prepaycard-bg.jpg',
				'prepaycard-bg-2'=>'/static/img/prepay-card/template1/prepaycard-bg-2.jpg',
				'prepaycard-bg-3'=>'/static/img/prepay-card/template1/prepaycard-bg-3.jpg',
				'prepaycard-bg-4'=>'/static/img/prepay-card/template1/prepaycard-bg-4.jpg',
				'prepaycard-bg-5'=>'/static/img/prepay-card/template1/prepaycard-bg-5.jpg',
				'prepaycard-bg-6'=>'/static/img/prepay-card/template1/prepaycard-bg-6.jpg'
			]
		];

		$arr = [
			array('hotelId'=>195221, 'productType'=>'ticket','counterList'=>[11,22,55]),
			array('hotelId'=>5, 'productType'=>'room','counterList'=>[77,4,9])
		];

		echo json_encode($arr, JSON_UNESCAPED_UNICODE);



		die;
		echo 'hello world';die;

		$this->bdUrlAPI(1, 'http://u6.gg');
//		echo '<br/><br/>----------百度短网址API----------<br/><br/>';
//
//		echo 'Long to Short: '.bdUrlAPI(1, 'http://u6.gg').'<br/>';
//
//		echo 'Short to Long: '.bdUrlAPI(0, 'http://360app.ft12.com').'<br/><br/>';
	}

	  /**

    * @author: vfhky 20130304 20:10

    * @description: PHP调用百度短网址API接口

    *     * @param string $type: 非零整数代表长网址转短网址,0表示短网址转长网址

    */

    function bdUrlAPI($type, $url){

	    if($type)

	    {
//	    	$baseurl = 'http://dwz.cn/create.';
	    	$baseurl = 'http://dwz.cn/admin/create';
	    }

	    else

	    {
	    	$baseurl = 'http://dwz.cn/query.php';
	    }

	    $ch=curl_init();

	    curl_setopt($ch,CURLOPT_URL,$baseurl);

	    curl_setopt($ch,CURLOPT_POST,true);

	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

	    if($type)

	    {
	    	$data=array('url'=>$url);
	    }

	    else

	    {
	    	$data=array('tinyurl'=>$url);
	    }

	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

	    $strRes=curl_exec($ch);

	    curl_close($ch);

	    $arrResponse=json_decode($strRes,true);
dump($arrResponse);
	    if($arrResponse['status']!=0)

	    {

	    echo 'ErrorCode: ['.$arrResponse['status'].'] ErrorMsg: ['.iconv('UTF-8','GBK',$arrResponse['err_msg'])."]<br/>";

	    return 0;

	    }
dump($arrResponse);
	    if($type)

	    return $arrResponse['tinyurl'];

	    else

	    return $arrResponse['longurl'];

    }

    public function shareposter() {

    	return view('shareposter_2');
    }


    public function autio() {

    	return view();
    }

    public function log() {
    	$TestLogic = new logic\TestLogic();
    	$TestLogic->logAdd();
    }

	/**
	 * 工厂模式
	 */
    public function myFactory() {

    	$user = factory\UserFactory::createUser();

    	echo $user->getUser();

    	die;
    }

    public function insertUser() {

    	$TestLogic = new logic\TestLogic();
	    $TestLogic->insertUser();
    }




}