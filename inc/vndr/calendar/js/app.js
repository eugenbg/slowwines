Date.prototype.yyyymmdd	=	function()
							{         
								var yyyy	= this.getFullYear().toString();                                    
								var mm		= ( this.getMonth() + 1 ).toString();
								var dd		= this.getDate().toString();             

								return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]);
							}; 

	
function unbindDailyMode() 
{
	$( '*[data-cal-date]' ).unbind( "click" );
	$( '.cal-cell' ).unbind( "dblclick" );
}

$( document ).ready
(
function()
{
	d = new Date();

	"use strict";

	var options = {
		events_source: '/jb/99.tour.date.php',
		q23: $( "#shortCode" ).html(),
		view: 'year',
		tmpl_path: '/inc/vndr/calendar/tmpls/',
		tmpl_cache: false,
		day: d.yyyymmdd(),
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.calendar-display h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	unbindDailyMode();

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
			unbindDailyMode();
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
});