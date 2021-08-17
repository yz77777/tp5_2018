$(function () {
	$('form').submit(function () {
		register();
		return false;
	});

	// 注册
	function register() {
		const nickname = $('form').find('input[name=nickname]').val();
		const pwd = $('form').find('input[name=pwd]').val();
		const email = $('form').find('input[name=email]').val();
		const verifyCode = $('form').find('input[name=verifyCode]').val();
		const param = {nickname, pwd, email, verifyCode};
		ajaxRequest(param);
	}

	function ajaxRequest(param) {
		$.ajax({
			url: '/user/registerSave',
			type: 'POST',
			data: param,
			success: function (res) {
				console.log(res);
			}
		});
	}
});