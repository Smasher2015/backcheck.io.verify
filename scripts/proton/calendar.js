$(document).ready(function() {

	!verboseBuild || console.log('-- starting proton.calendar build');

    

    proton.calendar.build();

});



proton.calendar = {

	build: function () {

		// Initiate calendar events

		proton.calendar.events();

		proton.calendar.makeCalendar();

		proton.calendar.bindDragEvent();



		!verboseBuild || console.log('            proton.calendar build DONE');



	},

	events: function () {

		!verboseBuild || console.log('            proton.calendar binding events');



	},

	makeCalendar: function (template) {

		!verboseBuild || console.log('            proton.calendar.makeCalendar()');

		

		// fullcalendar

		var date = new Date();

		var d = date.getDate();

		var m = date.getMonth();

		var y = date.getFullYear();



		$('.calendar').each(function() {

			

		});

		$('.calendar .fc-button').addClass('btn').addClass('btn-info').addClass('btn-xs');

	},

	addDragEvent: function($this){

		// Documentation here:

		// http://arshaw.com/fullcalendar/docs/event_data/Event_Object/

		var eventObject = {

			title: $.trim($this.text()), // use the element's text as the event title

		};

		

		$this.data('eventObject', eventObject);

		

		$this.draggable({

			zIndex: 999,

			revert: true,

			revertDuration: 0  

		});

	},

	bindDragEvent: function () {

		$('.custom-events .bootstrap-tagsinput span').each(function() {

			proton.calendar.addDragEvent($(this));

		});

		$('.custom-events .bootstrap-tagsinput input').on('keyup', function(event, element) {

			// console.log('change: ' + element.val());

		});

	}

}