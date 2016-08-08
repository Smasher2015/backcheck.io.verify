/* -------------------------------- 		*/

/* Developed & Analyzed By : Rizwan Hidayat	*/

/* -------------------------------- 		*/
var ext_count = 0;
function addmorecheck(th,comp,c,title){
	var d = new Date();
	var n = d.getTime();
	n = parseInt(n);

	
			checks[comp] = checks[comp]+1;
			ccount[c+""+comp] = ccount[c+""+comp]+1;
			//console.log(c+""+comp);
			if(ccount[c+""+comp]>4){
				 proton.dashboard.alerts("You can only add 4 check against each component","Alert!");
				 return false;
			
			}
			var num = checks[comp];
			var main =	$(th).parent().parent();
			var mdiv = $('<div>');
			$(mdiv).addClass('progress-bar-parent');
			
			$(main).after(mdiv);
			
			
			var h4 = $('<h4>');
			$(h4).addClass('section-title');
			$(h4).html(title);

			var input = $('<input>');
			$(input).addClass('parsley-validated parsley-error tickbox');
			$(input).data('parsley-error-message','You must select at least one check');
			$(input).data('parsley-required','true');
			$(input).attr('checked','checked');
			$(input).attr('type','checkbox');
			$(input).attr('value',comp+'_'+ccount[c+""+comp]);
			$(input).attr('name','ischeck'+c+'[]');
			$(input).attr('id',num);
			$(input).css('float','right');
			
			$(h4).append(input);
			
			
			$(mdiv).append(h4);
			
			var indiv = $('<div>');
			$(mdiv).append(indiv);
			
			var imdiv = $('<div>');
			
			$(indiv).append(imdiv);
			
			
			$(imdiv).append('<div id="dprogress'+c+num+n+'" class="progress bulk-upload-prgs" style="width:70%"><div class="progress-bar progress-bar-success"></div></div>');
			

					
			
			var span = $('<span>');
			$(span).attr('href','javascript:void(0);');
			$(span).css('float','right');
			$(span).addClass('btn btn-primary btn-file');
			$(span).html('<span class="fileinput-new">Select file</span>');
			$(imdiv).append(span);
			
			var input = $('<input>');
			$(input).attr('type','hidden');
			$(input).attr('value',comp+'_'+ccount[c+""+comp]);
			$(input).attr('name','checks'+c+'[]');
			$(span).append(input);
			

			var input = $('<input data-check="'+comp+'" data-count="'+c+'" data-id="'+num+'" data-ccounter="_'+ccount[c+""+comp]+'" data-attchid="'+n+'" >');
			$(input).attr('type','file');
			$(input).attr('multiple','multiple');
			$(input).addClass('docs_files');
			$(input).attr('name','files[]');
			$(input).attr('id','docs'+c+num+comp);
			$(span).append(input);
			
			$(indiv).append('<div style="clear:both"></div>');
			$(indiv).append('<div class="files" id="docs_file'+c+num+n+'"></div><input name="see_checks_'+comp+'" value="'+ccount[c+""+comp]+'"  type="hidden" >');
			$(indiv).append('<div style="clear:both"></div>');
			
			
			
				
			set_docs($(input).data('id'),$(input).data('count'),$(input).data('check'),$(input).data('ccounter'),$(input).data('attchid'));	
								
		}
		
function set_image(id){
			$(function () {
		
			var url = 'file_upload.php';
						
			$('#v_image'+id).fileupload({
				url: url,
				dataType: 'json',
				autoUpload: true,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				maxFileSize: 5000000, // 5 MB
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
				previewMaxWidth: 100,
				previewMaxHeight: 100,
				previewCrop: true
			}).on('fileuploadadd', function (e, data) {
				data.context = $('<div/>').appendTo('#files'+id);
				$.each(data.files, function (index, file) {
					//var node = $('<p/>').append($('<span/>').text(file.name));
					//node.appendTo(data.context);
					data.submit();
				});
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress'+id).css('display','block');
				$('#progress'+id+' .progress-bar').css('width',progress+'%');
			}).on('fileuploaddone', function (e, data) {
				$.each(data.result.files, function (index, file) {
					if (file.url) {
						var input = $('<input>')
							.attr('type', 'hidden')
							 .attr('name', 'image'+id)
							.attr('value', file.url);
						$("#files"+id).append(input);
		
						var input1 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','thum'+id)
							.attr('value', file.thumbnailUrl);
						$("#files"+id).append(input1);
		
						var input2 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','file'+id)
							.attr('value', file.name);
						$("#files"+id).append(input1);
		
						/*var span = $('<span class="doxc-style">').html(file.name);
						$("#files"+id).append(span);*/
						
						var span = $('<span class="doxc-style">').html(file.name);
						$('#progress'+id).find('.prg-profile').append(span);
																		
					} else if (file.error) {
						var error = $('<span class="text-danger"/>').text(file.error);
						$("#files"+id).append(error);
					}
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger"/>').text('File upload failed.');
					$("#files"+id).append(error);
				});
			})
		});			
		}

		var real_counter=0;

function set_docs(id,count,check,check_count,attchid){
	
	
	
	//console.log("id: "+id+" count: "+count+" attchid: "+attchid);
	
			$(function () {
		
			var url = 'file_upload.php';
						
			$('#docs'+count+id+check).fileupload({
				url: url,
				dataType: 'json',
				autoUpload: true,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png|docx|doc|pdf)$/i,
				maxFileSize: 5000000, // 5 MB
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
				previewMaxWidth: 100,
				previewMaxHeight: 100,
				previewCrop: true
			}).on('fileuploadadd', function (e, data) {
				
				//data.context = $('<div/>').appendTo('#files'+id);
				$.each(data.files, function (index, file) {
					//var node = $('<p/>').append($('<span/>').text(file.name));
					//node.appendTo(data.context);
					data.submit();
				});
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				
				$('#dprogress'+count+id+attchid).css('display','block');
				$('#dprogress'+count+id+attchid+' .progress-bar').css('width',progress+'%');
			}).on('fileuploaddone', function (e, data) {
				
				
				$.each(data.result.files, function (index, file) {
					
					real_counter++;
					ccount[check] = ccount[check]+1;
					$("#attachment_counter").val(real_counter);
					
					if (file.url) {
						
						var new_div = $('<div class="attachments">');
				
					
						$("#docs_file"+count+id+attchid).append(new_div);
						var newp = $('#dprogress'+count+id+attchid).clone();
						$(newp).removeAttr('id');
						
						$(new_div).append(newp);
						var input = $('<input>')
							.attr('type', 'hidden')
							 .attr('name', 'docxs'+count+id+check+check_count+'[]')
							.attr('value', file.url);
						$(newp).append(input);
		
		
						var input2 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','docxs_name'+count+id+check+check_count+'[]')
							.attr('value', file.name);
						$(newp).append(input2);
						
		
						var span = $('<span class="doxc-style">').html(file.name);
						$(newp).find('.progress-bar').append(span);

						var an = $('<a href="#" class="close fileinput-exists" data-dismiss="fileinput">').html('&times;');
						$(an).click(function(){
								$(this).parent().parent().parent().remove();	
						});
						$(newp).find('.progress-bar').append(an);
						
						$(new_div).append('<div style="clear:both"></div>');
													
					} else if (file.error) {
						var error = $('<span class="text-danger hideme"/>').text(file.error);
						$("#docs_file"+count+id+attchid).append(error);
						
						setInterval(function(){

						$(".hideme").remove(); }, 
						3000); 
					}
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger hideme"/>').text('File upload failed.');
					$("#docs_file"+count+id+attchid).append(error);
					setInterval(function(){

						$(".hideme").remove(); }, 
						3000); 
				});
			})
		});			
		}

function validateFileSize(ths) {
	if(ths.files[0].size>10485760){
		alertBox("File should be less than 10MB!");
    }
	return false;
}





function pervFn(tform){

	document.forms[tform].onsubmit = function (){return true;}	

}






function export_excel(url,tform){

		var iframe = document.createElement('iframe');

		iframe.style.display = 'none';

		iframe.src = url;

		document.body.appendChild(iframe);

		if(tform!==undefined) pervFn(tform);

}







function noAccess(msg){



	if(msg===undefined) msg='You Have No Access, Please Contact to Main User!';



	window.top.alertBox(msg);



	return false;



}



					



function updatecity(ths){



	var param="cntid="+ths.value+"&ePage=getcity";



	ajaxServices("actions.php",param,'updatecity');



}







function bookmark(id,ths){



		var callback = function (){



			if(rpsTt!='' || rpsTt!='noAccess'){



				document.getElementById("mk-"+id).src='images/icons/'+rpsTt+'.png';



			}



		}



		ajaxServices("actions.php","bookmark=1&fedit=1&case="+id,"",callback);



}















function UpdateRights(ths){







		var param = 'fedit=1&right='+ths.value;







		ajaxServices("actions.php",param,'msgs');







}















function submitLink(strLink){



	var frm = document.createElement("form");



	frm.method = "post"



	frm.style.display = "none";



	document.body.appendChild(frm);



	var params = strLink.split('&');







	for(var ind=0; ind<params.length;ind++){



		var input = document.createElement("input");



		var iVal = params[ind].split('=')



		input.name=iVal[0];



		if(iVal.length>1){



			  input.value=params[ind].split('=')[1];



		}else input.value='';



		input.type = "hidden"	



		frm.appendChild(input);



	}



	frm.submit();



}















function getCheckData(ths,checkID,checkT){







	var param="ascase="+checkID+"&ePage=checkinfo";







	var imgs = document.getElementById('checkScn').getElementsByTagName("img");







	for(var i=0; i<imgs.length;i++){







		if(imgs.item(i).className.match(/arrow/i)){







			imgs.item(i).style.visibility = 'hidden';







		}







	}







	







	var imgs = ths.getElementsByTagName("img");















	for(var i=0; i<imgs.length;i++){







		if(imgs.item(i).className.match(/arrow/i)){







			imgs.item(i).style.visibility = 'visible';







		}







	}







		







	var callBack = function(){







		document.getElementById('checkT1').innerHTML = checkT;	







		var icallBack = function(){







			document.getElementById('checkT2').innerHTML = checkT;







			var param="ascase="+checkID+"&ePage=checkcmts";







			var iicallBack = function(){







				document.getElementById('checkT3').innerHTML = checkT;	







			}







			







			ajaxServices("actions.php",param,'checkCmts',iicallBack);







		}







		var param="ascase="+checkID+"&ePage=uploaddoc";







		ajaxServices("actions.php",param,'checkDoc',icallBack);	







	}















	ajaxServices("actions.php",param,'checkInfo',callBack);







}















function showAdCheck(uni,cid){







	var param="uni="+uni.value+"&cid="+cid+"&ePage=uni_acd";







	var callBack = function(){







		var frm = document.forms['dataForm'];







		if(rpsTt!='NA'){







			var uniData = rpsTt.split('||');







			frm.website.value=uniData[0].toString();







			frm.acdchk.value=uniData[1].toString();







		}







	}







	ajaxServices("actions.php",param,'',callBack);







}















function tabSwitch(tabs,divs,atd,callBack){







	var atv =  atd.split(',');







	var tbs =  tabs.split(','); 







	var dvs =  divs.split(',');







	for(var ind=0;ind<tbs.length;ind++){







		document.getElementById(tbs[ind]).className = 'normal';







		document.getElementById(dvs[ind]).style.display = 'none';			







	}







	document.getElementById(atv[0]).className = 'current';







	document.getElementById(atv[1]).style.display = 'block';







	if(callBack!==undefined) callBack();







}















function showSHR(ths,ElM){







	if(ths.title=='Add Reply'){







		disp='block';	







		ths.title = 'Close Reply';







		ths.src='images/icons/small/grey/cross.png';







	} else{







		disp='none';







		ths.title = 'Add Reply';







		ths.src='images/icons/small/grey/pluse.png';







	}







	







	showSH(disp,'com-'+ElM);







	disp  = (disp=='block')?'none':'block';







	document.getElementById('aR-'+ElM).style.display = disp;







}















function showSH(typ,elID,callback){







	if(callback!==undefined){







		callback();







	}







	document.getElementById(elID).style.display = typ;







}















function setFields(ths){







	for(var i=0;i<=1;i++){







		var field = document.getElementById("fld"+i);







		var tds = field.getElementsByTagName('td'); 







		for(var j=0;j<=1;j++){







			if(ths.value==4){







				tds.item(j).removeAttribute('style');







			}else{







				tds.item(j).setAttribute('style',"display:none");







			}







		}







	}







}















var pTab;







function LoadBoxs(title,tab){







	pTab=tab;







	showAjax('tabs_lrc',title,'tab='+tab);	







}























function switchTabs(th){







	if(th.className!='current'){







			th.className='current';







			document.getElementById(pTab).className='normal';







			document.getElementById('lrc'+pTab).style.display='none';







			document.getElementById('lrc'+th.id).style.display='block'; 







			pTab = th.id;







	}







}















function closePDF(){







		document.body.removeChild(document.getElementById('pdfLoader'));







		var loader = document.getElementById('loading_overlay');







		loader.style.display='none';







		loader.getElementsByTagName('div').item(0).style.display='none';







}























function downloadPDF(url){







	try{







		if(document.getElementById('pdfLoader')!= null){







			document.body.removeChild(document.getElementById('pdfLoader'));







		}







  	}catch(err){}







	var ifrm = document.createElement('iframe');







	ifrm.style.display='none';







	ifrm.id = 'pdfLoader';







	ifrm.src = url;







	document.body.appendChild(ifrm);







	ifrm.onload = function() {







			var loader = document.getElementById('loading_overlay');







			loader.style.display='none';







			loader.getElementsByTagName('div').item(0).style.display='none';







		







    }







	







		var loader = document.getElementById('loading_overlay');







		loader.style.display='block';







		loader.getElementsByTagName('div').item(0).style.display='block';







}















function searchDetails(cid,isLgn){







	if(isLgn){







		var dataFrm = document.forms['searchFrom'];







		dataFrm.cid.value= cid;







		dataFrm.submit();







	}else{







		LoadBoxs('User Login','login');







	}







}















function showMoreResults(divID,divClass,btn){







	var divs = document.getElementById(divID).getElementsByTagName('div');







	for(var i=10;i<divs.length;i++){







		if(divs.item(i).className.indexOf(divClass)>=0){







				divs.item(i).style.display = 'block';







		} 







	}







	document.getElementById(btn).innerHTML = '';







}























function showShearches(nameStr,eID,th){







	switch(th.className){







		case'pls':







			function callback(){







				th.className='mns';







				th.src='img/minusIcon.gif';







				document.getElementById('tr'+eID).removeAttribute('style');







			}







			var param="action=ePage&ePage=get_searches&name="+nameStr;







			ajaxServices("actions.php",param,'td'+eID,callback);







		break;







		case'mns':







			th.className='pls';







			th.src='img/plusIcon.gif';







			document.getElementById('tr'+eID).style.display='none';







		break;		







	}







}















function showData(th,param,dvId){







	var cntr = document.getElementById(dvId);







	switch(cntr.style.display){







		case 'none':







			var callback = function (){







							th.src = 'img/minusIcon.gif';



							cntr.removeAttribute('style');



							cntr.setAttribute('style', 'padding:0');







			};







			ajaxServices("actions.php",param,dvId,callback);







		break;







		default:







			th.src = 'img/plusIcon.gif';







			cntr.setAttribute('style', 'display:none');







		break;







	}	







}















function dataActions(asID,title){







	 var acFunc = function(){







		 var frm =document.forms['dataFrm'];







		 frm.datav.value = asID;







		 frm.submit();







	 }







	 confirmBox("Do you want to delete [ "+title+" ] !",acFunc);







}















function LoadData(asID){







	var cnt = document.getElementById('asck_'+asID);







	var img = document.getElementById('img_'+asID);







	switch(cnt.style.display){







		case 'block':







			document.getElementById('asck_'+asID).style.display='none';







			img.src = "img/expand.png";







			img.title = "Maximize";







		break;







		case 'none':







			var calback = function(){ 







				img.src = "img/condense.png";







				img.title = "Minimize";







				document.getElementById('asck_'+asID).style.display='block';







			}







			var param = 'ePage=list_checks&ascase='+asID;







			ajaxServices("actions.php",param,'asck_'+asID,calback);







		break;







	}







}















function updateData(frm){







	var dFrm = document.forms[frm];







	var key = dFrm.fldKey.value;







	var typ = dFrm.typ.value;







	var fkey = key+dFrm.fkey.value;







	Encoder.EncodeType = "entity";







	var param='';







	switch(typ){







		case'date':







			var val = dFrm.year.value+'-'+dFrm.month.value+'-'+dFrm.day.value;







		break;







		case'multy':







			var val = dFrm.val1.value.replace('&','||');







			var mtt1 = dFrm.mtt1.value.replace('&','||');







			var stt1 = dFrm.stt1.value.replace('&','||');







			param="mtt1="+mtt1+"&stt1="+stt1+"&";







			fkey='';







		break;		







		default:







			var val = dFrm.keyVal.value.replace('&','||');







		break;







	}







	var cas = dFrm.casev.value;



	var ascas = dFrm.ascasev.value;



	var data = dFrm.data.value;



	var calback = function (){



					document.getElementById('lightBoxBg').style.display = 'none';



					document.getElementById('showAjax').style.display = 'none';



					if(typ=='multy'){







						if(rpsTt!='u error' || rpsTt!=''){







							rpsTt = rpsTt.split('||');







							fkey = dFrm.fkey.value;







							document.getElementById('mtt1'+fkey).innerHTML=rpsTt[0];







							document.getElementById('stt1'+fkey).innerHTML=rpsTt[1];







							document.getElementById('val1'+fkey).innerHTML=rpsTt[2];







						}







					}







				}







	param =param+"fedit=1&key="+key+"&val="+val+"&typ="+typ;







	







	if(ascas!=0) param = param+"&ascase="+ascas;







	if(cas!=0)   param = param+"&case="+cas;







	if(data!=0)   param = param+"&data="+data;







	







	ajaxServices("actions.php",param,fkey,calback);







	return false;







}















function showEdit(url,heaser,param,width,height){







	if(width === undefined) width=500;







	if(height === undefined) height=250;







	height = height+50;







	if(heaser=='') heaser='Edit Field(s)';







	showAjax(url,heaser,param,width,height);







}















function showAuto(url,header,param,auto){







	var wSize=windowSize();







	if(auto === undefined) auto=8;







	var width=wSize[0]-(wSize[0]*(auto/100));







	var height=wSize[1]-(wSize[1]*(8/100));







	document.getElementById('showContent').style.height=(height-100)+'px'







	showAjax(url,header,param,width,height);



	



	document.getElementById('showContent').style.overflow = 'hidden';







}















function showAjax(url,header,param,width,height){







	if(width === undefined) width=500;







	if(height === undefined) height=400;







	document.getElementById('lblAjax').style.height= height+'px'



	



	document.getElementById('showContent').style.overflow = 'auto';



	document.getElementById('showContent').style.height= (height-100)+'px'







	document.getElementById('lblAjax').style.width= width+'px';







	document.getElementById('showHeader').innerHTML=header;







	var calback = function(){







		var divID='showAjax';







		showdeadcenterdiv(width,height,divID);







		showBg();







		document.getElementById(divID).style.display='block';







		if(url=='showproof'){







			shwHidLdig('block');	







		}







	}







	param = param+'&ajax=1&ePage='+url







	ajaxServices("actions.php",param,'showContent',calback);







	return false;







}















function windowSize(){







	var hwAry= Array(1);







	if (document.body && document.body.offsetWidth) {







	 	hwAry[0] = document.body.offsetWidth;







	 	hwAry[1] = document.body.offsetHeight;







	}







	if (document.compatMode=='CSS1Compat' &&







		document.documentElement &&







		document.documentElement.offsetWidth ) {







		 hwAry[0] = document.documentElement.offsetWidth;







		 hwAry[1] = document.documentElement.offsetHeight;







	}







	if (window.innerWidth && window.innerHeight) {







		 hwAry[0] = window.innerWidth;







		 hwAry[1] = window.innerHeight;







	}







	return hwAry;	







}















function confirmBox(msg,acFunc,iconType) {   







		showdeadcenterdiv(400,200,'showConfirm');







		document.getElementById('confirmContent').innerHTML=msg;







		document.getElementById('btnYes').onclick= function(){







														closeBox(this.parentNode.parentNode,true);







														acFunc();







													};







		showBg();







		document.getElementById('showConfirm').style.display='block'; 







}















function alertBox(msg) {    







		showdeadcenterdiv(400,200,'showalerts');







		document.getElementById('alertContent').innerHTML=msg;







		showBg();







		document.getElementById('showalerts').style.display='block'; 







}















function showNotific(){







		showdeadcenterdiv(600,200,'showNotific');







		showBg();







		document.getElementById('showNotific').style.display='block';







}















function showBg(){







	document.getElementById('lightBoxBg').style.height = getHight()+'px';







	document.getElementById('lightBoxBg').style.display = 'block';	







}















function getHight(){







    var D = document;







    return Math.max(







        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),







        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),







        Math.max(D.body.clientHeight, D.documentElement.clientHeight)







    );







}	















function showdeadcenterdiv(Xwidth,Yheight,divid,fx) {







	// First, determine how much the visitor has scrolled







	var scrolledX = 0;







	var scrolledY = 0;







	if( self.pageYOffset ) {







		scrolledX = self.pageXOffset;







		scrolledY = self.pageYOffset;







	} else if(document.documentElement) {







		scrolledX = document.documentElement.scrollLeft;







		scrolledY = document.documentElement.scrollTop;







	} else if( document.body ) {







		scrolledX = document.body.scrollLeft;







		scrolledY = document.body.scrollTop;







	}







	if(typeof(scrolledY) == 'undefined') scrolledY = 0;







	// Next, determine the coordinates of the center of browser's window







	var centerX = 0;







	var centerY = 0;







	if( self.innerHeight ) {







		centerX = self.innerWidth;







		centerY = self.innerHeight;







	} else if( document.documentElement && document.documentElement.clientHeight ) {







		centerX = document.documentElement.clientWidth;







		centerY = document.documentElement.clientHeight;







	} else if( document.body ) {







		centerX = document.body.clientWidth;







		centerY = document.body.clientHeight;







	}







	// Xwidth is the width of the div, Yheight is the height of the







	// div passed as arguments to the function:







	var leftoffset = scrolledX + (centerX - Xwidth) / 2;







	var topOffset = scrolledY + (centerY - Yheight) / 2;







	// The initial width and height of the div can be set in the







	// style sheet with display:none; divid is passed as an argument to // the function







	var o=document.getElementById(divid);







	var r=o.style;







	if(fx===undefined){







		r.position='absolute';







		r.top = topOffset + 'px';







	}else{







		r.position='fixed';







		r.top = topOffset + 'px';







	}







	r.left = (leftoffset) + 'px';







	r.display = "block";







}















function closeBox(th,isBg,dcid){







		if(isBg === undefined) isBg = true;







		th.parentNode.parentNode.style.display = 'none';







		if(dcid !== undefined){







			document.getElementById(dcid).innerHTML='';







		}







		var disp = document.getElementById('showAjax').style.display;







		if(disp!='block'){







			if(isBg){







				document.getElementById('lightBoxBg').style.display = 'none';	







			}







		}







		shwHidLdig('none');







}























function validateSrc(srcfrm){







		if((srcfrm.search_str.value!='') && (srcfrm.search_str.value!='Search By Emp ID / Emp Name')){







				return true;







		}else{







			alertBox("Please Input Emp ID or Emp Name to Conduct a Search");







		}







		return false;		







}























function validatePrf(f1){







	if(f1!=''){







		var exc = getExc(f1);







		if((exc=='jpg')){







			return false;







		} 	







	}







	return true;







}























function getExc(file){







		return file.split('.').pop().toLowerCase();







}















function updateFields(frm){







	var inputTxt = Array();







	inputTxt = frm.auto_select.value.split('||');







	Encoder.EncodeType = "entity";







	frm.website.value     = trim(Encoder.htmlDecode(inputTxt[0]));







	frm.information.value = trim(Encoder.htmlDecode(inputTxt[1]));







}















function gotoLink(strLink){







	window.location = strLink;







}















function closeMsg(ths){







	var child = ths.parentNode;







	child.parentNode.removeChild(child);







}















function loadTitle(){







	var inputs = document.getElementsByTagName('input');







	var tAreas = document.getElementsByTagName('textarea');







	var part=/auto/g;







	for(var i=0; i<inputs.length;i++){







		var input = inputs.item(i);







		if(part.test(input.className)){







			input.onfocus = function(){







					if(this.value==this.title){







						this.value='';







					}







			};















			input.onblur = function(){







					if(this.value==''){







						this.value=this.title;







					}







			};







						







			input.value =input.title;







		}







	}	







	







	for(var i=0; i<tAreas.length;i++){







		var tArea = tAreas.item(i);







		if(part.test(tArea.className)){







		 	tArea.value =tArea.title;







		}







	}







}























function vFBg(){







	this.style.backgroundColor = '#FAFAFA';	







}















function submitFrm(frm){







	document.forms[frm].submit();







}















function shwHidLdig(BN){



	document.getElementById('ajaxLoader').style.display = BN;	



}







function getChecks(ths){



	var param='ePage=getchecks&pkg='+ths;



	ajaxServices('actions.php',param,'showChecks');



}







                                        function showDiv(frm){







											var ap;







											document.getElementById(frm).style.display='block';







											







											if(frm=='app') ap='upl';else ap='app';







											document.getElementById(ap).style.display='none';







											







											







										}







function addMore(divid){



	var param='ePage=applicantinfo&divid='+(divid+1);



	ajaxServices('actions.php',param,'div-'+divid);



}







function remove1(){



	var parent = document.getElementById('apList');



	var rmlist = parent.getElementsByTagName('span');



	var cnt=0; var ind=0;



	for(var i=0;i<rmlist.length;i++){



		if(rmlist.item(i).className=='rList'){



			cnt=cnt+1;ind=i;	



		}	



	}



	if(cnt>1){



		rmlist.item(ind).parentNode.removeChild(rmlist.item(ind));



	}



	if(cnt<=2){



		document.getElementById('remove').parentNode.removeChild(document.getElementById('remove'));	



	}



}



	







function closeForm(frm){







document.getElementById(frm).style.display='none';







document.getElementById('crpkg').style.display='block';







document.getElementById('normForm').style.display='block';







return false;







}







var checkBName='';



var count=0;







function valdateForums(frm){



		checkBName='';



		count=0;



		var ifNot = false;



		var cbNot = false;



		if(this.className.match(/confirm/i)){



			var callBack = function(frm){ 



				return function (){



					frm.submit();



				} 



			}(this);



 			confirmBox(this.confirmMsg.value,callBack);



 			return false;



		}else{



			var elmnts = this.elements;



			var eTitle = '';



			for(var j=0;j<elmnts.length;j++){



				var typ = elmnts.item(j).type;



				if((typ=='text') || (typ=='select-one') || (typ=='select-multiple') || (typ=='file' || typ=='textarea') || typ=='password'){



					if(elmnts.item(j).className.match(/req/i)){



						try {



							var title = elmnts.item(j).title;



						}catch(err){



							var title = '[NA]';



						}







						var val = elmnts.item(j).value.replace(/^\s+|\s+$/g,'');



						if(val=='' || val=='0' || val==title){



							elmnts.item(j).style.backgroundColor = '#FFC';



							elmnts.item(j).onclick = vFBg;



							ifNot = true;



							if(elmnts.item(j).className.match(/title/i)){



								eTitle = title;				



							}



							count=count+1;



						}	



						



						if(typ=='file'){



							if(!ifNot){



								ifNot = validatePrf(elmnts.item(j).value);



								if(ifNot) {



									if(elmnts.item(j).className.match(/title/i)){



										eTitle = title;				



									}							



								}



								count=count+1;



							}



						}				



					}



				}







				if(typ=='checkbox'){



					if(elmnts.item(j).className.match(/req/i)){



						if(!elmnts.item(j).checked && checkBName!=elmnts.item(j).name){



							checkBName=elmnts.item(j).name;



							cbNot = true;



							elmnts.item(j).style.backgroundColor = '#FFC';



							elmnts.item(j).onclick = vFBg;



							count=count+1;



							if(elmnts.item(j).className.match(/title/i)){



								eTitle = elmnts.item(j).title;				



							}								



						}else if(elmnts.item(j).checked && checkBName!=elmnts.item(j).name){



							checkBName=elmnts.item(j).name;



							cbNot = false;



						}



					}



				}



				



				if(typ=='radio'){



					if(elmnts.item(j).className.match(/req/i)){



						if(!elmnts.item(j).checked){



							ifNot = true;



							elmnts.item(j).style.backgroundColor = '#FFC';



							elmnts.item(j).onclick = vFBg;



							count=count+1;



							if(elmnts.item(j).className.match(/title/i)){



								eTitle = elmnts.item(j).title;				



							}							



						}



					}



				}



			}



			



			if(cbNot) ifNot = true;



			



			if(ifNot){



				if(eTitle!='' && count<=1) 



					 alertBox('Please ' + eTitle+'!');



				else alertBox("Please Input/Select Required Fields!"); 



				return false;



			}



			return true;



		}



}



function updateMsgStatus(msg_id){
 
 var param = 'fedit=1&updateMsgStatus=1&id='+msg_id;
 ajaxServices('actions.php',param,'');

	
 //ajaxServices(SITE_URL+'ajax/update_msg_status/',param,'');
 
 /*$(".chk_"+msg_id).removeAttr("onclick");
 $(".lbl_"+msg_id).removeAttr("style");*/
 
}



function setObject(eObj){



	for(var i=0;i<eObj.length;i++){



		if(eObj.item(i).className.match(/auto/i)){



			eObj.item(i).onfocus =	function(){



											var val =this.value.replace(/^\s+|\s+$/g,'');



											if(val==this.title)	this.value = '';



										}; 



			eObj.item(i).onblur  = 	function(){



											var val =this.value.replace(/^\s+|\s+$/g,'');



											if(val=='')	this.value = this.title;



										};



		}



	}	



}


function downloadAttachedFile(fileName){

	document.location=SURL+"files/"+fileName;
	
}


function addMoreAttach(check_id){
	
	$(".more_attachemnts_"+check_id).toggle('slow');
	
	
}








  																																	