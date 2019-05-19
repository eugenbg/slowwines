;(function($){
/**
 * jqGrid Vietnamese Translation
 * Lê Đình Dũng dungtdc@gmail.com
 * http://trirand.com/blog/ 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "View {0} - {1} of {2}",
		emptyrecords: "Không có dữ liệu",
		loadtext: "Đang nạp dữ liệu...",
		pgtext : "Trang {0} trong tổng số {1}"
	},
	search : {
		caption: "Tìm kiếm...",
		Find: "Tìm",
		Reset: "Khởi tạo lại",
		odata : ['bằng', 'không bằng', 'bé hơn', 'bé hơn hoặc bằng','lớn hơn','lớn hơn hoặc bằng', 'bắt đầu với','không bắt đầu với','trong','không nằm trong','kết thúc với','không kết thúc với','chứa','không chứa'],
		groupOps: [	{ op: "VÀ", text: "tất cả" },	{ op: "HOẶC",  text: "bất kỳ" }	],
		matchText: " đúng",
		rulesText: " quy tắc"
	},
	edit : {
		addCaption: "Thêm bản ghi",
		editCaption: "Sửa bản ghi",
		bSubmit: "Gửi",
		bCancel: "Hủy bỏ",
		bClose: "Đóng",
		saveData: "Dữ liệu đã thay đổi! Có lưu thay đổi không?",
		bYes : "Có",
		bNo : "Không",
		bExit : "Hủy bỏ",
		msg: {
			required:"Trường dữ liệu bắt buộc có",
			number:"Hãy điền đúng số",
			minValue:"giá trị phải lớn hơn hoặc bằng với ",
			maxValue:"giá trị phải bé hơn hoặc bằng",
			email: "không phải là một email đúng",
			integer: "Hãy điền đúng số nguyên",
			date: "Hãy điền đúng ngày tháng",
			url: "không phải là URL. Khởi đầu bắt buộc là ('http://' hoặc 'https://')",
			nodefined : " chưa được định nghĩa!",
			novalue : " giá trị trả về bắt buộc phải có!",
			customarray : "Hàm nên trả về một mảng!",
			customfcheck : "Custom function should be present in case of custom checking!"
			
		}
	},
	view : {
		caption: "Xem bản ghi",
		bClose: "Đóng"
	},
	del : {
		caption: "Xóa",
		msg: "Xóa bản ghi đã chọn?",
		bSubmit: "Xóa",
		bCancel: "Hủy bỏ"
	},
	nav : {
		edittext: "",
		edittitle: "Sửa dòng đã chọn",
		addtext:"",
		addtitle: "Thêm mới 1 dòng",
		deltext: "",
		deltitle: "Xóa dòng đã chọn",
		searchtext: "",
		searchtitle: "Tìm bản ghi",
		refreshtext: "",
		refreshtitle: "Nạp lại lưới",
		alertcap: "Cảnh báo",
		alerttext: "Hãy chọn một dòng",
		viewtext: "",
		viewtitle: "Xem dòng đã chọn"
	},
	col : {
		caption: "Chọn cột",
		bSubmit: "OK",
		bCancel: "Hủy bỏ"
	},
	errors : {
		errcap : "Lỗi",
		nourl : "không url được đặt",
		norecords: "Không có bản ghi để xử lý",
		model : "Chiều dài của colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: ".", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, defaultValue: '0'},
		currency : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0'},
		date : {
			dayNames:   [
				"CN", "T2", "T3", "T4", "T5", "T6", "T7",
				"Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"
			],
			monthNames: [
				"Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", 