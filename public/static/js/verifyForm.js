(function (w, $) {
	function VerifyForm(ele, opt) {
		this.ele = ele;
		this.errorFromTip = "errorFromTip";
		// this.errorFromTipTxt = "";
		// this.errorTxtMap = {"notEmpty":"不能为空","min":"最小值"};
	}

	VerifyForm.prototype.verify = function () {
		let inputList = $(this.ele).find('input');

		let len = inputList.length;

		for (let i=0; i<len; i++) {
			let thisInput = $(inputList[i]);
			let typeForm = thisInput.attr("data-check");
			if (typeForm === "notVerify") {
				continue;
			}
			let title = thisInput.siblings("label").text();
			let min = thisInput.attr("min");
			let max = thisInput.attr("max");
			let value = thisInput.val();

			thisInput.parent().find("span[tag=errorTxt]").remove();

			// console.log("============= " + i);
			// console.log("min == " + min);
			// console.log("max == " + max);
			// console.log("value == " + value);
			switch (typeForm) {
				case "notEmpty":
					thisInput.addClass(this.errorFromTip);
					errorMsg(thisInput, title + getCodeName(typeForm));
					break;
			}

			if (!isNaN(value)) {
				if (!isNaN(min) && parseInt(min) > parseInt(value)) {
					thisInput.addClass(this.errorFromTip);
					errorMsg(thisInput, title + getCodeName("min") + min);
					continue;
				}
				if (!isNaN(max) && parseInt(max) < parseInt(value)) {
					thisInput.addClass(this.errorFromTip);
					errorMsg(thisInput, title + getCodeName("max") + max);
					continue;
				}
			}

		}

		return false;
	}

	function getCodeName(code) {
		const errorTxtMap = {"notEmpty":"不能为空","min":"最小值"};
		return errorTxtMap[code] ? errorTxtMap[code] : "";
	}

	function errorMsg(ele, errorMsg) {
		if (ele.parent().children('span[tag=errorTxt]').length <= 0) {
			ele.after("<span class='errorFromTip' tag='errorTxt'></span>");
		}
		ele.siblings("span[tag=errorTxt]").html(errorMsg);
	}

	$.fn.verifyForm= function (opt) {
		const v = new VerifyForm(this, opt);
		return v.verify();
	}
})(window, jQuery);