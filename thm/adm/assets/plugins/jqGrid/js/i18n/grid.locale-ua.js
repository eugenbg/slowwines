;(function($){
/**
 * jqGrid Ukrainian Translation v1.0 02.07.2009
 * Sergey Dyagovchenko
 * http://d.sumy.ua
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = $.jgrid || {};
$.extend($.jgrid,{
	defaults : {
		recordtext: "Перегляд {0} - {1} з {2}",
	  emptyrecords: "Немає записів для перегляду",
		loadtext: "Завантаження...",
		pgtext : "Стор. {0} з {1}"
	},
	search : {
    caption: "Пошук...",
    Find: "Знайти",
    Reset: "Скидання",
    odata : ['рівно', 'не рівно', 'менше', 'менше або рівне','більше','більше або рівне', 'починається з','не починається з','знаходиться в','не знаходиться в','закінчується на','не закінчується на','містить','не містить'],
    groupOps