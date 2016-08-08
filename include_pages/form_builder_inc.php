<!--  <meta name="description" content="">-->
<?php
$checkid = base64_decode($_GET['checkid']);
// $Q = mysql_query("select * from inputs");
  
	$Q = $db->select("inputs","*");
  
  $data = getInfo('checks',"checks_id=$checkid");
 
 /*$fields_maping = mysql_query("select * from fields_maping as fm INNER JOIN inputs as inp ON fm.in_id=inp.in_id where fm.checks_id = ".$checkid." ORDER BY fm.t_id ASC ");
*/ 
	$tbls = "fields_maping as fm INNER JOIN inputs as inp ON fm.in_id=inp.in_id"; 
 		$fields_maping = $db->select($tbls,"*","fm.checks_id = ".$checkid." ORDER BY fm.fl_ord ASC ");

	$tbls2 = "fields_maping as fm INNER JOIN inputs as inp ON fm.in_id=inp.in_id"; 
 		$fields_maping2 = $db->select($tbls2,"*","fm.checks_id = ".$checkid." ORDER BY fm.t_id ASC ");



 //$titles = mysql_query("select * from titles where checks_id=".$checkid."");

 //$titles = mysql_query("select * from titles where checks_id=".$checkid."");

	$titles = $db->select("titles","*","checks_id=".$checkid."");


//$results = mysql_fetch_array($fields_maping);

//print_r($results);
/*while($getCheckfieldss = mysql_fetch_array($fields_maping))
{
 
 print_r($getCheckfieldss);
}

while($result = mysql_fetch_array(getInputs()))
{
echo $result['in_name'];
}
*/?>
  <link rel="stylesheet" href="<?php echo SURL; ?>/formbuilder/vendor/css/vendor.css" />
  <link rel="stylesheet" href="<?php echo SURL; ?>/formbuilder/dist/formbuilder.css" />
  <style>
  * {
    box-sizing: border-box;
  }

  .fb-main {
    background-color: #fff;
    border-radius: 5px;
    min-height: 600px;
  }

  input[type=text] {
    height: 26px;
    margin-bottom: 3px;
  }

  select {
    margin-bottom: 5px;
    font-size: 40px;
  }
  </style>
</head>
<body>
<div id="responsediv"></div>
  <div class='fb-main'></div>

 <h1><?php echo $data['checks_title']; ?></h1>
  <script src="<?php echo SURL; ?>/formbuilder/vendor/js/vendor.js"></script>
  <script src="<?php echo SURL; ?>/formbuilder/dist/formbuilder.js"></script>
   <script>

  <?php
  // while($getCheckfields2 = mysql_fetch_array($fields_maping2))
		// {  
  ?>  this["Formbuilder"]["templates"]["view/base"] = function(obj) {
obj || (obj = {});
var __t, __p = '', __e = _.escape;
with (obj) {
__p += '<div class=\'subtemplate-wrapper\'>\n  <div class=\'cover\'></div>\n  ' +
((__t = ( Formbuilder.templates['view/label']({rf: rf}) )) == null ? '' : __t) +
'\n\n  ' +
((__t = ( Formbuilder.fields[rf.get(Formbuilder.options.mappings.FIELD_TYPE)].view({rf: rf}) )) == null ? '' : __t) +
'\n\n  ' +
((__t = ( Formbuilder.templates['view/description']({rf: rf}) )) == null ? '' : __t) +
'\n  ' +
((__t = ( Formbuilder.templates['view/duplicate_remove']({rf: rf}) )) == null ? '' : __t) +
'\n</div>\n';

}
return __p
};

			this["Formbuilder"]["templates"]["view/duplicate_remove"] = function(obj) {
obj || (obj = {});
var __t, __p = '', __e = _.escape;
with (obj) {
__p += '<div class=\'actions-wrapper\'>\n  <a class="js-duplicate ' +
((__t = ( Formbuilder.options.BUTTON_CLASS )) == null ? '' : __t) +
'" title="Duplicate Field"><i class=\'fa fa-plus-circle\'></i></a>\n  <a class="js-clear ' +
((__t = ( Formbuilder.options.BUTTON_CLASS )) == null ? '' : __t) +
'" title="Remove Field"><i class=\'fa fa-minus-circle\'></i></a>\n</div>';

}
return __p
}; 			 

<?php
		
?>
   function enableTxt(elem) {
	//var id = getElementById("123");
//var name_element = document.getElementById('123');
    var id = $(elem).attr("id");
    alert(id);
}

  (function() {
 	  
	  
/*	  
  Formbuilder.registerField('address', {
    order: 50,
    view: "<div class='input-line'>\n  <span class='street'>\n    <input type='text' />\n    <label>Address</label>\n  </span>\n</div>\n\n<div class='input-line'>\n  <span class='city'>\n    <input type='text' />\n    <label>City</label>\n  </span>\n\n  <span class='state'>\n    <input type='text' />\n    <label>State / Province / Region</label>\n  </span>\n</div>\n\n<div class='input-line'>\n  <span class='zip'>\n    <input type='text' />\n    <label>Zipcode</label>\n  </span>\n\n  <span class='country'>\n    <select><option>United States</option></select>\n    <label>Country</label>\n  </span>\n</div>",
    edit: "",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-home\"></span></span> Address"
  });
*/  
<?php  $i=0;
 while($result = mysql_fetch_array($Q))
 // for($i=0; $totalinputs > $i; $i++)
  {	
	if($result['in_type'] == "textarea")
	{
	?>
	  Formbuilder.registerField('textarea', {
    order: 5,
    view: "<textarea class='rf-size '></textarea>",
    edit: " ",
    addButton: "<span class=\"symbol\">&#182;</span> TextArea" 
 });
	<?php
	}
	else if($result['in_type'] == "radio")
	{
	?>
	 Formbuilder.registerField('radio', {
    order: 15,
    view: "<% for (i in (rf.get(Formbuilder.options.mappings.OPTIONS) || [])) { %>\n  <div>\n    <label class='fb-option'>\n      <input type='radio' <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].checked && 'checked' %> onclick=\"javascript: return false;\" />\n      <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].label %>\n    </label>\n  </div>\n<% } %>\n\n<% if (rf.get(Formbuilder.options.mappings.INCLUDE_OTHER)) { %>\n  <div class='other-option'>\n    <label class='fb-option'>\n      <input type='radio' />\n      Other\n    </label>\n\n    <input type='text' />\n  </div>\n<% } %>",
    edit: "<%= Formbuilder.templates['edit/options']({ includeOther: true }) %>",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-circle-o\"></span></span> Multiple Choice",
    defaultAttributes: function(attrs) {
      attrs.field_options.options = [
        {
          label: "",
          checked: false
        }, {
          label: "",
          checked: false
        }
      ];
      return attrs;
    }
  });
	<?php
	}
	else if($result['in_type'] == "select")
	{
	?>
	  Formbuilder.registerField('select', {
    order: 24,
    view: "<select>\n  <% if (rf.get(Formbuilder.options.mappings.INCLUDE_BLANK)) { %>\n    <option value=''></option>\n  <% } %>\n\n  <% for (i in (rf.get(Formbuilder.options.mappings.OPTIONS) || [])) { %>\n    <option <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].checked && 'selected' %>>\n      <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].label %>\n    </option>\n  <% } %>\n</select>",
    edit: "<%= Formbuilder.templates['edit/options']({ includeBlank: true }) %>",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-caret-down\"></span></span> Dropdown",
    defaultAttributes: function(attrs) {
      attrs.field_options.options = [
        {
          label: "",
          checked: false
        }, {
          label: "",
          checked: false
        }
      ];
      attrs.field_options.include_blank_option = false;
      return attrs;
    }
  });
	<?php
	}
	else if($result['in_type'] == "checkbox")
	{
?>
  
Formbuilder.registerField('checkbox', {
    order: 10,
    view: "<% for (i in (rf.get(Formbuilder.options.mappings.OPTIONS) || [])) { %>\n  <div>\n    <label class='fb-option'>\n      <input type='checkbox' <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].checked && 'checked' %> onclick=\"javascript: return false;\" />\n      <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].label %>\n    </label>\n  </div>\n<% } %>\n\n<% if (rf.get(Formbuilder.options.mappings.INCLUDE_OTHER)) { %>\n  <div class='other-option'>\n    <label class='fb-option'>\n      <input type='checkbox' />\n      Other\n    </label>\n\n    <input type='text' />\n  </div>\n<% } %>",
    edit: "<%= Formbuilder.templates['edit/options']({ includeOther: true }) %>",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-square-o\"></span></span> Checkboxes",
    defaultAttributes: function(attrs) {
      attrs.field_options.options = [
        {
          label: "",
          checked: false
        }, {
          label: "",
          checked: false
        }
      ];
      return attrs;
    }
  });<?php
	}
	else
	{
?>
  
   Formbuilder.registerField('<?=$result['in_type']?>', {
    order: <?=$i?>,
    view: "<<?=$result['in_name']?> type='<?=$result['in_type']?>'  />\n",
    edit: "",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-envelope-o\"></span></span> <?=$result['in_type']?>"
  });
 // }
<?php
	}
 $i++;
 }
?>
 Formbuilder.registerField('section_break', {
    order: 0,
    type: 'non_input',
    view: "<label class='section-name'><%= rf.get(Formbuilder.options.mappings.LABEL) %></label>\n<p><%= rf.get(Formbuilder.options.mappings.DESCRIPTION) %></p>",
    edit: "<div class='fb-edit-section-header'>Label</div>\n<input type='text' data-rv-input='model.<%= Formbuilder.options.mappings.LABEL %>' />\n<textarea data-rv-input='model.<%= Formbuilder.options.mappings.DESCRIPTION %>'\n  placeholder='Add a longer description to this field'></textarea>",
    addButton: "<span class='symbol'><span class='fa fa-minus'></span></span> Section Break"
  });
/*
 Formbuilder.registerField('number', {
    order: 30,
    view: "<input type='text' />\n ",
    edit: "",
    addButton: "<span class=\"symbol\"><span class=\"fa fa-number\">123</span></span> Number"
  });


  Formbuilder.registerField('textarea', {
    order: 5,
    view: "<textarea class='rf-size '></textarea>",
    edit: " ",
    addButton: "<span class=\"symbol\">&#182;</span> TextArea" 
	/*,
    defaultAttributes: function(attrs) {
      attrs.field_options.size = 'small';
      return attrs*/
    
 /* });*/


}).call(this);

   
  
  
  
  
  
    $(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
       
	   
	    bootstrapData: [
		 
		  <?php /*?> {
            "label": "Check ID(Dont Change It)",
            "field_type": "hidden",
            "checkID":  "<?=$checkid?>",
             
          },<?php */?>
		  

		  // {
//            "label": "section break",
//            "field_type": "section_break",
//             
//             
//          },
		  <?php
		  
		  
		//if($checkid == 47)
		//{
			?>
<?php /*?>          {
            "label": "Select Company",
            "field_type": "select",
             
            "field_options": {},
            "cid": "c10"
          },
<?php */?>			<?php
			
		//}
		  
		  
		  
		  $i = 1;
		while($getCheckfields = mysql_fetch_array($titles))
		{
 		?>
		
          {
            "label": "<?php echo $getCheckfields['t_title']; ?>",
            "field_type": "<?php echo "submit"; ?>",
             "field_id": <?php echo $getCheckfields['t_id']; ?>,
            "field_options": {"description":"<?=$getCheckfields['t_btn']?>",},
            "cid": "<?=$cid?>"
          },
		  <?php
 		$i++;
		}
		
		  ?>
		  <?php
		  $i = 1;
		while($getCheckfields = mysql_fetch_array($fields_maping))
		{
			
			//print_r($getCheckfields);
			if($getCheckfields['is_req'] == 1)
			{
				$is_required = "true";
			}
			else
			{
				$is_required = "false";
			}

			if($getCheckfields['fl_show'] == 1)
			{
				$fl_show = "true";
			}
			else
			{
				$fl_show = "false";
			}

			if($getCheckfields['is_multy'] == 1)
			{
				$is_multy = "true";
			}
			else
			{
				$is_multy = "false";
			}


		if($getCheckfields['in_type'] == "text" || $getCheckfields['in_type'] == "email")
		{	
		$cid = "c6";
		}
		else if($getCheckfields['in_type'] == "select")
		{	
		$cid = "c10";
		}
		else if($getCheckfields['in_type'] == "file")
		{	
		$cid = "c14";
		}
		else 
		{	
		$cid = "c1";
		}
		
		$field_type = $getCheckfields['in_type'];
		 //if($field_type == "checkbox" )
		// {
		//	 $field_type = "checkboxes";
		// }
		// if($field_type = "submit")
		// {
		?>
		 <?php /*?> {
            "label": "<?php echo $getCheckfields['t_title'].$field_type." xxx"; ?>",
            "field_type": "<?php echo $field_type; ?>",
            "field_id": <?php echo $getCheckfields['t_id']; ?>,
            "field_options": {  },
            "cid": "<?=$cid?>"
          },<?php */?>
		<?php
		// }
		// else
		// {
		?>
		
          {
            "label": "<?php echo $getCheckfields['fl_title'] ; ?>",
            "field_type": "<?php echo $field_type; ?>",
            "required": <?=$is_required?>,
            "visibleinreport": <?=$fl_show?>,
            "is_multy": <?=$is_multy?>,
            "orderby": <?=$i?>,
            "field_id": <?php echo $getCheckfields['fl_id']; ?>,
            "field_options": {
				<?php /*$getCheckfields['in_type'] == "radio" || $getCheckfields['in_type'] == "checkboxes" ||*/
				 if( $getCheckfields['in_type'] == "select" || $getCheckfields['in_type'] == "radio")
		 {
			if($getCheckfields['fl_op'] == 5)
			{
			//$Qs = mysql_query("select uni_Name from uni_info");
 
			}
			else
			{ 
			$Qs = mysql_query("select * from fldoptions where (fl_op = ".$getCheckfields['fl_op']." and fl_key= '".$getCheckfields['fl_key']."')");
			?> 
				
				"options": [
				<?php
				 while($fl_op = mysql_fetch_array($Qs))
				 { //print_r($fl_op);
				?>
				{
                    "label": "<?php echo $fl_op['op_val']; ?>",
                    "optionid": "<?php echo $fl_op['op_id']; ?>",
                    "checked": false
                },/*{
                    "label": "No",
                    "checked": false
                },*/
				<?php
				 }
				?> 
				/*{
                    "label": "No",
                    "checked": false
                }*/],
                "include_other_option": true
				<?php
			}
			//$Qs = mysql_query("SELECT * FROM fldoptions WHERE (fl_op = 1 AND fl_key= 'as_vstatus')");
 			
			
			//	$Q = mysql_query("select * from fields_maping as fm INNER JOIN fldoptions as flop ON fm.fl_op=flop.fl_op where fm.fl_id = ".$getCheckfields['fl_id']." ");

			
		}
				?>
				
				},
            "cid": "<?=$cid?>"
          },
		  <?php
		 //} 
		//}
		$i++;
		}
		
		  ?> 
		 
        ]
		
		
		
      });

      fb.on('save', function(payload){
     //  console.log(payload);//console.log(fb);
	 
	 
	  /*,
          {
            "label": "Please enter your clearance number",
            "field_type": "text",
            "required": true,
            "field_options": {},
            "cid": "c6"
          },
          {
            "label": "Security personnel #82?",
            "field_type": "radio",
            "required": true,
            "field_options": {
                "options": [{
                    "label": "Yes",
                    "checked": false
                }, {
                    "label": "No",
                    "checked": false
                }],
                "include_other_option": true
            },
            "cid": "c10"
          },
          {
            "label": "Medical history",
            "field_type": "file",
            "required": true,
            "field_options": {},
            "cid": "c14"
          }*/
	 
/* var texst = 
'{"fields":[ {"label":"ssss","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c2"}]}';
*/

 var texst = payload;



obj = JSON.parse(texst );
/*document.getElementById("test").innerHTML =
obj.fields[0].label+ " " + obj.fields[0].field_type;	 
*/	  // var json_arr = JSON.stringify(payload);
	 // $("#test").append(payload.fields);
document.getElementById("test").innerHTML =
"Record Save Successfully";	 


for(i=0; obj.fields.length>i; i++)
{
	 
}

//$(document).ready(function(){
 // $(':submit').on('click', function() { // This event fires when a button is clicked
   // var button = $(this).val();
   // $.ajax({ // ajax call starts
//      url: 'form_builder_submit.php', // JQuery loads serverside.php
//      data: obj, // Send value of the clicked button
//      dataType: 'json', // Choosing a JSON datatype
//    })
//    .done(function(data) { // Variable data contains the data we get from serverside
//       // Clear #wines div
//			$("#test").append(data);	
//     
//    });
//    return false; // keeps the page from not refreshing 
  //});
//});















      }) 
    });
	
	
	
	 function submitformbuilderx()
	{ //console.log(obj.fields);
	 $.ajax({ // ajax call starts
	 method: "POST",
      url: '<?php echo SURL; ?>/form_builder_submit_inc.php?checkid=<?=$checkid?>', // JQuery loads serverside.php
      data: obj, // Send value of the clicked button
     // type: "POST", // Send value of the clicked button
      dataType: 'JSON', // Choosing a JSON datatype
    })
    .done(function(data) { // Variable data contains the data we get from serverside
       // Clear #wines div
			$("#test").append("Record Save Successfully");	
     
    });
    return false;  
	}
	
	
  </script>
  <?php
  
//$arr = json_decode($_POST['payload']);
 // print_r($arr);
  ?>
<div id="test"></div>