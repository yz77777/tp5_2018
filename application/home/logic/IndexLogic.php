<?php
namespace app\home\logic;
use app\home\model;
class IndexLogic
{
	public function login()
	{
//		return 'login';
		$hotelModel = new model\hotelModel();

		$data = $hotelModel->where(array())->limit(3)->select()->toArray();
echo $hotelModel->getLastSql();
//		dump($data);
//		echo 1;
		return $data;
	}

	public function download($page, $pageSize)
	{

		$memberModel = new model\memberModel();
		$data = $memberModel->field('member_id,mobile')->where()->page($page, $pageSize)->select()->toArray();
		/*
		 $page = $page*$pageSize;
		 $sql = "select
m.member_id,m.if_subscribe,m.realname,m.nickname,m.mobile,m.created_at,m.if_agency,m.if_prime,m.total_buy_item_prom_count,m.total_sell_item_prom_count,m.total_sell_amount,m.total_commision_amount,
mb.nickname as inviter,mb.member_id as inviter_id
					from member as m
					left join member as mb on m.agency_from_id = mb.member_id
					order by m.member_id desc limit {$page},{$pageSize};";

		$data = $memberModel->query($sql);
		*/
//		echo $memberModel->getLastSql();
//		die;
//		dump($data);die;
		return $data;
	}
	public function downloadCount(){
		$memberModel = new model\memberModel();
		$count = $memberModel->count();
		return $count;
	}
}