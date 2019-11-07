<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/9/11
 * Time: 下午4:20
 */
namespace app\home\model;
use think\model;
class TextPaperModel extends model {
	protected $table = 'yz_text_paper';

	public function findTextPaperId($id) {
		$data = $this->where(array('text_paper_id'=>$id))->find();

		if ($data) {
			return $data->toArray();
		} else {
			return array();
		}
	}
}