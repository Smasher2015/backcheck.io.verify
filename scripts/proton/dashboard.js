$(document).ready(function() {

    !verboseBuild || //console.log('-- starting proton.dashboard build');

    proton.dashboard.build();

});



proton.dashboard = {

	build: function () {

		proton.dashboard.events();

		proton.dashboard.quickLaunchSort();

		proton.dashboard.loadWidgetPositions()

		proton.dashboard.setBlankWidgets();

		proton.dashboard.widgetSort();

		proton.dashboard.drawCharts();

		proton.dashboard.select2();

		proton.dashboard.lightUp();

	},

	events : function () {

		// toggle dashboar menu

		$(document).on('click', '.dashboard-menu', function(event) {

			event.preventDefault();

			$(this).toggleClass('expanded');

			$('.menu-state-icon').toggleClass('active');

		});

		// toggle widget setup state

		$(document).on('click', '.toggle-widget-setup', function(event) {

			event.preventDefault();

			$(this).parents('.proton-widget').toggleClass('setup');

		});

	},

	quickLaunchSort : function () {

		!verboseBuild || //console.log('            proton.dashboard.quickLaunchSort()');



		proton.dashboard.isDragActive = false;

		$( ".quick-launch-bar ul" ).sortable({

		    containment: 'parent',

		    tolerance: 'pointer',

		    start: function(event, ui) {

		        proton.dashboard.isDragActive = true;

		        $('.tooltip').tooltip('hide');

		    },

		    stop: function(event, ui) {

		        proton.dashboard.isDragActive = false;

		    }

		});

	},

	lightUp : function () {

		!verboseBuild || //console.log('            proton.dashboard.lightUp()');



		var numWidgets = $('.proton-widget').length;

		var currentWidget = 0;

		setTimeout(showWidget, 200);



		function showWidget () {

			$('.proton-widget').eq(currentWidget).addClass('lit');

			if(currentWidget == numWidgets) return;

			currentWidget++;

			setTimeout(showWidget, 100);

		}

	},

	widgetPositions : [],

	loadWidgetPositions : function () {

		!verboseBuild || //console.log('            proton.dashboard.loadWidgetPositions()');

		var positionArray = proton.dashboard.widgetPositions;

		var positionsFromCookie = $.cookie('proton_widgetPositions') || false;

		if(positionsFromCookie){

			positionArray = positionsFromCookie.split(',');

			$.each(positionArray, function(index, val) {

				$('#' + val).appendTo('.widget-group');

			});

		}

		else proton.dashboard.saveWidgetPositions();

	},

	saveWidgetPositions : function () {

		!verboseBuild || //console.log('            proton.dashboard.saveWidgetPositions()');

		

		var positionArray = proton.dashboard.widgetPositions = [];

		$('.proton-widget').not('.placeholder').each(function(index, el) {

			var wid = $(el).attr('id');

			positionArray.push(wid);

		});

		$.cookie('proton_widgetPositions', positionArray, {

	        expires: 365,

	        path: '/'

	    });

	},

	widgetSort : function () {

		!verboseBuild || //console.log('            proton.dashboard.widgetSort()');



		proton.dashboard.isDragActive = false;

		$( ".widget-group" ).sortable({

		    cancel: '.placeholder, .flip-it',

		    placeholder: 'drag-placeholder',

		    start: function(event, ui) {

		        proton.dashboard.isDragActive = true;

		        $('.tooltip').tooltip('hide');

		    },

		    stop: function(event, ui) {

		        proton.dashboard.saveWidgetPositions();

		        proton.dashboard.isDragActive = false;

		    },

		    tolerance: 'pointer',

		    handle: ".panel-heading"

		});

	},

	setBlankWidgets: function () {

		!verboseBuild || //console.log('            proton.dashboard.setBlankWidgets()');



		var realWidgetNum = $('.proton-widget').not('.placeholder').length;

		var placeholderNum = $('.proton-widget.placeholder').length;



		var availableWidth = $('.widget-group').width();

		var widgetWidth = $('.proton-widget').outerWidth(true);

		var widgetsPerRow = Math.floor(availableWidth / widgetWidth);

		var widgetRows = Math.ceil(realWidgetNum / widgetsPerRow);



		var newPlaceholderNum = (widgetRows * widgetsPerRow) - realWidgetNum;



		$('.proton-widget.placeholder').appendTo('.widget-group');

		if(newPlaceholderNum === placeholderNum){

			return;

		}

		if(newPlaceholderNum <= placeholderNum){

			for (var i = placeholderNum - newPlaceholderNum; i > 0; i--) {

			    $('.proton-widget.placeholder').last().remove();

			}

			return;

		}

		if(newPlaceholderNum >= placeholderNum){

			for (var i = newPlaceholderNum - placeholderNum; i > 0; i--) {

			    $('<div class="proton-widget placeholder lit"></div>').appendTo('.widget-group');

			}

			return;

		}

	},

	graph : {},

	drawCharts : function () {

		!verboseBuild || //console.log('            proton.dashboard.drawCharts()');



		/*proton.dashboard.graph.Donut = Morris.Donut({

		    element: 'hero-donut',

		    data: [

		      {label: 'Production', value: 30 },

		      {label: 'R&D', value: 40 },

		      {label: 'Marketing', value: 25 },

		      {label: 'Sales', value: 5 }

		    ],

		    formatter: function (y) { return y + "%" },

		    colors : ['#428bca', '#5cb85c', '#d9534f', '#5bc0de']

		});*/



		/*proton.dashboard.graph.Bar = Morris.Bar({

		    element: 'hero-bar',

		    data: [

		      {year: '2008', income: 5346},

		      {year: '2009', income: 11437},

		      {year: '2010', income: 22475},

		      {year: '2011', income: 33840},

		      {year: '2012', income: 32655},

		      {year: '2013', income: 95471}

		    ],

		    xkey: 'year',

		    ykeys: ['income'],

		    labels: ['Income'],

		    barRatio: 0.1,

		    xLabelAngle: 90,

		    hideHover: 'auto'

		});*/

	},
	
	drawByRisk : function (amber,red,green) {

		!verboseBuild || //console.log('            proton.dashboard.drawCharts()');



		proton.dashboard.graph.Donut = Morris.Donut({

		    element: 'hero-donut',

		    data: [

		      {label: 'Potential Risk', value: amber },

		      {label: 'High Risk', value: red },

		      {label: 'No Risk', value: green }

		    ],

		    formatter: function (y) { return y  },

			colors : ['#F57C00', '#E53935', '#388E3C']

		});

	},
	
	drawByRiskReport : function (amber,red,green) {

		!verboseBuild || //console.log('            proton.dashboard.drawByRiskReport()');



		if($('#hero-donut-report').length)

		proton.dashboard.graph.Donut = Morris.Donut({

		    element: 'hero-donut-report',

		    data: [

		      {label: 'Potential Risk', value: amber },

		      {label: 'High Risk', value: red },

		      {label: 'No Risk', value: green }

		    ],

		    formatter: function (y) { return y + "" },
			
			colors : ['#F57C00', '#E53935', '#388E3C']

		});
	},

	
	drawByStatus : function (completed,inprogress,needattention,discrepancy) {

		!verboseBuild || //console.log('            proton.dashboard.drawCharts()');


		proton.dashboard.graph.Bar = Morris.Bar({

		    element: 'hero-bar',

		    data: [

		      {year: 'Completed', income: completed},

		      {year: 'In Progress', income: inprogress},

		      {year: 'Need Attention', income: needattention},

		      {year: 'Discrepancy', income: discrepancy},

		    ],

		    xkey: 'year',

		    ykeys: ['income'],

		    labels: ['Checks'],

		    barRatio: 0.1,

		    xLabelAngle: 90,

		    hideHover: 'auto'

		});

	},
	drawByStatusReport : function (completed,inprogress,needattention,discrepancy) {
		
		!verboseBuild || //console.log('            proton.dashboard.drawByStatusReport()');	
		
		if($('#hero-bar-report').length)

		proton.dashboard.graph.Bar = Morris.Bar({

		    element: 'hero-bar-report',

		    data: [

		      {device: 'Completed', geekbench: completed, colors: '#FFC943'},

		      {device: 'In Progress', geekbench: inprogress, colors: '#e8511a'},

		      {device: 'Need Attention', geekbench: needattention, colors: '#8DC655'},

		      {device: 'Discrepancy', geekbench: discrepancy, colors: '#83C655'}

		    ],
			
			//colors : ['#FFC943', '#e8511a', '#8DC655',  '#83C655'],
			
		    xkey: 'device',

		    ykeys: ['geekbench'],

		    labels: ['Checks'],
		
		    barRatio: 0.4,

		    xLabelAngle: 35,

		    hideHover: 'auto'
			
			
			


		});


	
	},
	drawHeroArea : function (jsonL) {
		
		var json = JSON.stringify(eval("(" + jsonL + ")"));
 		//JSON.parse(json)
		//console.log(json);
		
		!verboseBuild || //console.log('proton.dashboard.drawHeroArea()');
		if($('#hero-area').length)

		proton.dashboard.graph.Area = Morris.Area({

		    element: 'hero-area',

		    data: JSON.parse(json),

		    xkey: 'period',

		    ykeys: ['amber', 'red', 'green'],

		    labels: ['Potential Risk', 'High Risk', 'No Risk'],

		    pointSize: 2,

		    hideHover: 'auto'
			
		});
	},
	
	drawBasicChart : function (loopV) {
		var jsonl = JSON.stringify(eval("(" + loopV + ")"));

		!verboseBuild || //console.log('proton.dashboard.drawBasicChart()');
		if($('#myfirstchart').length)

		proton.dashboard.graph.Line = Morris.Line({

			// ID of the element in which to draw the chart.

			element: 'myfirstchart',

			// Chart data records -- each entry in this array corresponds to a point on

			// the chart.
			data: JSON.parse(jsonl),

			// The name of the data record attribute that contains x-values.

			xkey: 'year',

			// A list of names of data record attributes that contain y-values.

			ykeys: ['value'],

			// Labels for the ykeys -- will be displayed when you hover over the

			// chart.

			labels: ['Value']

		});
		
	},
	select2 : function () {

		!verboseBuild || //console.log('            proton.dashboard.select2()');

		

        $('.select2').select2({ maximumSelectionSize: 6 });

	},

	alerts : function (notification,heading,nclass,time) {

		if(nclass===undefined) nclass = 'info';
		if(time===undefined) time = 15000;
		$.pnotify.defaults.delay = time;

		$.pnotify.defaults.shadow = false;

		$.pnotify.defaults.cornerclass = 'ui-pnotify-sharp';

		$.pnotify.defaults.stack = {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 5, "spacing2": 5};

		setTimeout((function(notification,heading,nclass){
			return function(){
				$.pnotify({
		        title: heading,
		        type: nclass,
		        history: false,
		        text: notification
		    });				
			} 
		}(notification,heading,nclass)),5000);
	}
}