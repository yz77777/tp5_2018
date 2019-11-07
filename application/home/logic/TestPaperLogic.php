<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/1/22
 * Time: 下午2:14
 */
namespace app\home\logic;
use app\home\model;
use think\Exception;
class TestPaperLogic {

	public function getTextPaperQuestion() {
		$textPaperModel = new model\TextPaperModel();
		$textPaperInfo = $textPaperModel->findTextPaperId(1);

		if (empty($textPaperInfo)) {
			return array();
		}

		$choiceQuestionList = $this->getChoiceQuestionList($textPaperInfo['text_paper_id']);

		$data = array(
			'textPaperInfo' => $textPaperInfo,
			'choiceQuestionList' => $choiceQuestionList,
		);
		return $data;
	}

	private function getChoiceQuestionList($textPaperId) {

		$questionModel = new model\QuestionModel();
		$answerModel = new model\AnswerModel();

		// 获取选择题
		$list = $questionModel->getQuestionList(array('text_paper_id'=>$textPaperId));

		// 获取选择题答案
		foreach ($list as &$v) {

			$whereAnswer = array(
				'question_id' => $v['question_id']
			);
			$answerList = $answerModel->getAnswerList($whereAnswer);

			$v['answer_list'] = $answerList;
		}
		unset($v);

		return $list;
	}

	public function handAnswer($param) {

		$res = array('code'=>1,'message'=>'','data'=>'');

		$textPaperId = intval($param['text_paper_id']) ? $param['text_paper_id'] : 0;

		$answerModel = new model\AnswerModel();

		// 获取答案
		$answerYesList = $answerModel->getAnswerList(array('text_paper_id'=>$textPaperId,'question_type'=>'choice','answer_yes'=>1));

		// 答案分组，方便验证提交答案是否正确
		$answerGroup = array();
		foreach ($answerYesList as $v) {
			$key = 'choice_question_'.$v['question_id'];
			$answerGroup[$key] = $v['answer_id'];
		}

		$userAnswer = array();
		$scored = 0;
		foreach ($param as $k=>$value) {
			if (!array_key_exists($k, $answerGroup)) {
				continue;
			}
			$userAnswer[$k] = $value;
			if ($value == $answerGroup[$k]) {
				$scored+=1;
			}
		}


		if ($userAnswer) {
			// 记录用户答案
			$userAnswerModel = new model\UserAnswerModel();
			$dataAdd = array(
				'text_paper_id' => $param['text_paper_id'],
				'user_id' => 0,
				'scored' => $scored,
				'answer_txt' => json_encode($userAnswer, JSON_UNESCAPED_UNICODE),
				'create_time' => date('Y-m-d H:i:s'),
			);
			$userAnswerModel->insert($dataAdd);
		}

		$res['code'] = 0;
		$res['data'] = array(
			'scored' => $scored,
		);

		return $res;
	}


}