
       <?php
			$data = client_checks_info("as_sent=4  AND as_status='Close'","LIMIT 4");
								?> 
    <!-- Page-specific Plugin CSS: -->
        <link rel="stylesheet" href="styles/vendor/fullcalendar.css" media="screen" />
		<script src="scripts/vendor/fullcalendar.min.js"></script>
        <script src="scripts/vendor/jquery-ui.custom.min.js"></script>
        <script>
		$(document).ready(function() {  
		// fullcalendar
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$('#calendar').each(function() {
			$(this).fullCalendar({
				header: {
					left: 'prev,',
					center: 'title,today,month,agendaWeek,agendaDay',
					right: 'next'
				},
				editable: true,
				droppable: true, 
				drop: function(date, allDay) { // this function is called when something is dropped
					
						// retrieve the dropped element's stored Event Object
						var originalEventObject = $(this).data('eventObject');
						
						// we need to copy it, so that multiple events don't have a reference to the same object
						var copiedEventObject = $.extend({}, originalEventObject);
						
						// assign it the date that was reported
						copiedEventObject.start = date;
						copiedEventObject.allDay = allDay;
						
						// render the event on the calendar
						// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
						
						// is the "remove after drop" checkbox checked?
						if ($('#drop-remove').is(':checked')) {
							// if so, remove the element from the "Draggable Events" list
							$(this).remove();
						}
						
					}
				,
				events: [
				
				<?php if(!empty($data)){
									  while($row = mysql_fetch_assoc($data)){?>
									  
									  
									  {
						title: '<?php echo $row['checks_title'] . ' [' . $row['v_name'] . ']';?>',
						start: '<?php echo $row['as_date'];?>',
						url: 'javascript:downloadPDF("pdf.php?pg=case&ascase=<?=$row['as_id']?>")'
					},
										 <?php  //print_r($row);
										  }
								}?>
				
				
					
					
					
					
				]
				/* , eventClick: function(event) {
        if (event.url) {
            window.open(event.url);
            return false;
				}
			} */
			});
		});
		$('#calendar .fc-button').addClass('btn').addClass('btn-info').addClass('btn-xs');
		});
		
		</script>
        


<section class="retracted scrollable content-body">
<div class="row">
 	<div class="col-md-12">
        <div class="report-sec">
        
			<div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title3">
        		<h2><?php include('include_pages/pages_breadcrumb_inc.php'); ?></h2>
         	</div>
            </div>
            </div>		
        <div class="panel panel-default panel-block">
            <div class="panel-body">
            
                <div id="calendar">&nbsp;</div>
                <div class="legent">
                   
                </div>
            </div>
        </div>
    </div>
	</div>
</div>
</section>


        


		
