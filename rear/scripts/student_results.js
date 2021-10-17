// JavaScript Document
function calcTd(ths){
	var $this = $(ths);
	var tr = $this.closest('tr');
	updateAverage(tr);
	updateResult(ths);
}
	
function updateAverage(tr){
	var num = tr.find('.td1').length, total = 0;
	tr.find('.td1, .td2, .td3').each(function(){
		var score = $(this).text().trim() || 0;
		total = parseInt(total) + parseInt(score);
	});
	var average = total/num;
	tr.find('td').last().text(average);
	tr.find('td').last().prev().text(total);
}
	
function validate(ths){
	var $this = $(ths), start, $total = 0, value = 0; 
	if($this.hasClass('td3')){
		start = $this.prevUntil(".td1").prev();
	}else if($this.hasClass('td2')){
		start = $this.prev();
	}else{
		start = $this;
	}
	start.prev().nextUntil('.td4').each(function(){
		var value =  $(this).text().trim() || 0;
		$total = parseInt($total) + parseInt(value);
	});
	
	value = parseInt($this.text().trim()) || 0;
	$this.text(value);
	var last = start.nextUntil('.td4').last().next();
	if($total > 100){
		$this.text(0);
		last.text($total - value);
	}else{
		last.text($total);
	}
}
	
function updateResult(ths){
	var $this = $(ths);
	var table = $this.closest('table');
	var id = $this.data('to');
	var grade = $this.text();
	var num = $this.data('td');
	var name = table.find('thead > tr').last().find('td').eq(num).text();
	var obj = {id:id , name:name, grade:grade, updateResult:true};
	//alert(table.find('thead > tr').last().find('td').eq(3).text())
	//return;
	console.log(obj);
	$.post('process_result.php', obj , function(response){
		//alert(response)
		if(response == '1'){
			Materialize.toast(name+': '+grade +' updated',1000,'green');
		}
	});
}

function loadResults(a, ths){
	var form = $(ths).closest('.resultpage').find('form.result-data');
	var title = $('#formData'+a).find('.result-title');
	var formdata = form.serializeArray();
	var school_id = $.grep(formdata, function(obj){return obj.name == 'school_id';})[0];
	var school = $.grep(formdata, function(obj){return obj.name == 'hierachy_name';})[0];
	var classs = $.grep(formdata, function(obj){return obj.name == 'class';})[0];
	var term = $.grep(formdata, function(obj){return obj.name == 'term';})[0];
	var year = $.grep(formdata, function(obj){return obj.name == 'year';})[0];
	if($(ths).hasClass('collection-item')){
		formdata.push({name:'class', value:$(ths).data('id')});
		if(parseInt(school_id.value) != parseInt($('#l_result_class'+a).attr('data-school_id'))){
			formdata.push({name:'getclass', value:school_id.value});
		}
		classs = {name:'class', value:$(ths).text()};
	}else{
		$('#l_result_class'+a).find('option').each(function(){
			if($(this).attr('value') == classs.value){
				classs = {name:'class', value:$(this).text()};
			}
		})
	}
	formdata.push({name:'loadresults', value:true});
	//console.log(formdata);
	$('.progress').removeClass('hide');
	$.post('process_result.php', formdata, function(response){
		$('.progress').addClass('hide');
		var data = isJson(response);
		if(data === false){
			console.log(response);
		}else{
			console.log(data);
			if(data.classes){
				$('#l_result_class'+a).empty().attr({'data-school_id':school_id.value});
				for(var i in data.classes){
					$('<option>').val(data.classes[i].id).text(data.classes[i].name).appendTo($('#l_result_class'+a))
				}
			}
			var table = $('#spreadsheet'+a+' > table');
			
			if(data.result.length !== 0){
				var results = data.result, sumtotal = 0;
				var thead1 = $('<tr>').addClass('turnup').attr({'height':110}), thead = $('<tr>'), count = 1, tbody = $('<tbody>');
				title.find('.title').text('Showing Results for');
				title.find('.school').text(school.value);
				title.find('.class').text(classs.value);
				title.find('.term').text(term.value);
				title.find('.year').text(year.value);
				//each row
				for(i in results){
					var $_t = 0, numSubject = 0, sumtotal= 0;
					if(count == 1){
						thead.append($('<th>').attr({'rowspan':2}).text('S/N')).append($('<th>').attr({'rowspan':2}).css({padding:'0 40px'}).text('PUPIL NAME')).append($('<th>').attr({'rowspan':2}).text('EXAM NO'));
						for(var o in results[i].course){
							var course = results[i].course[o];
							var C_c = 0;
							$.each(course.grade, function(k,v){
								thead1.append($('<td>').text(k));
								C_c++;
							});
							thead.append($('<th>').attr({'colspan':C_c}).text(o));
						}
						thead.append($('<th>').attr({'rowspan':2}).text('TOTAL')).append($('<th>').attr({'rowspan':2}).text('AVERAGE'));
					}
					//each course
					var tr = $('<tr>');
					tr.append($('<td>').text(count)).append($('<td>').text(results[i].name)).append($('<td>').text(results[i].exam_no));
					for(o in results[i].course){
						course = results[i].course[o];
						var $c = 1, total = 0, gradekeys = [];
						//each grade
						for(var gr in course.grade){gradekeys.push(gr);}
						var last = gradekeys.length - parseInt(1);
						$.each(course.grade, function(j,v){
							var td = $('<td>');
							if(j != gradekeys[last]){
								td.attr({'data-to':course.id, 'contentEditable':true,'data-td':$_t,title:o+', '+j+', '+results[i].name}).addClass('td'+$c).keyup(function(){validate(this)}).blur(function(){calcTd(this);}).text(v);
								total = parseInt(total) + parseInt(v);
							}else{
								td.addClass('td4').attr({title:o+', '+j+', '+results[i].name}).text(total); 
							}
							tr.append(td);
							if(j == gradekeys[last]){$c = 0;}
							$c++;$_t++;
						});
						sumtotal = parseInt(sumtotal) +  parseInt(total);
						numSubject ++;
					}
					tr.append($('<td>').text(sumtotal)).append($('<td>').text(sumtotal/numSubject));
					tbody.append(tr);
					count++;
				}
				table.empty().append($('<thead>').append(thead).append(thead1)).append(tbody);
			}else{
				title.find('.title').text('No Results found for');
				title.find('.school').text(school.value);
				title.find('.class').text(classs.value);
				title.find('.term').text(term.value);
				title.find('.year').text(year.value);
				table.empty();
			}
		}
		$('#open_form'+a).swapDiv($('#new_form'+a));
	});
}

function get_annual(a, ths){
	var form = $(ths).closest('.resultpage').find('form.result-data');
	var title = $('#formData'+a).find('.result-title');
	var formdata = form.serializeArray();
	var school_id = $.grep(formdata, function(obj){return obj.name == 'school_id';})[0].value;
	var school = $.grep(formdata, function(obj){return obj.name == 'hierachy_name';})[0].value;
	var classs = $.grep(formdata, function(obj){return obj.name == 'class';})[0].value;
	var year = $.grep(formdata, function(obj){return obj.name == 'year';})[0].value;
	formdata.push({name:'getAnnual', value:true});
	var $page = $('#annual_page'+a);
	$(ths).questionBox('Load annual result for this class',function(){
		$('#new_form'+a).swapDiv($page);
		$('.progress').removeClass('hide');
		$.post('process_result.php', formdata, function(response){
			$('.progress').addClass('hide');
			var data = isJson(response);
			if(data === false){
				console.log(response);
			}else{
				console.log(data);
				//return;
				var table = $page.find('table.annual_table');
				var ptitle = $page.find('.result-title');
				var clasS = $('#l_result_class'+a).find('option[value='+classs+']').text();
				ptitle.find('.schoolName').text(school);
				ptitle.find('.class').text(clasS);
				ptitle.find('.year').text(year);
				table.empty();
				if(data.length !== 0){
					var thead1 = $('<tr>'), thead = $('<tr>'), count = 1, tbody = $('<tbody>');
					var count = 1, numSubject = 0;
					//each row
					for(var o in data){
						var terms = data[o];
						if(count == 1){
							thead1.append($('<th>').attr({colspan:3}).addClass('term').text('Details'))
							thead.append($('<th>').text('S/N')).append($('<th>').css({padding:'0 60px'}).text('PUPIL NAME')).append($('<th>').addClass('endterm').text('EXAM NO'));
							
							for(var term in terms){//loop terms
								var courses = terms[term];
								for(var course in courses){
									var sub = courses[course];
									thead.append($('<th>').text(sub.subject));
								}
								thead.find('th').last().addClass('endterm');
								thead1.append($('<th>').addClass('term').attr({colspan:courses.length}).text(term));
							}
							thead1.append($('<th>').attr({colspan:2}).addClass('term').text('Cumulatives'))
							thead.append($('<th>').text('TOTAL')).append($('<th>').text('AVERAGE'));
							table.append($('<thead>').append(thead1).append(thead));
						}
						var tr = $('<tr>');
						tr.append($('<td>').text(count)).append($('<td>').text(o.split('|')[1])).append($('<td>').addClass('endterm').text(o.split('|')[0]));
						var $total = 0,  $num_courses = 0;
						for(var term in terms){//loop terms
							var courses = terms[term];
							for(var course in courses){
								var sub = courses[course];
								tr.append($('<td>').attr({title:sub.subject+', '+sub.subject}).text(sub.grade));
								$total = parseInt($total) + parseInt(sub.grade);
								$num_courses++;
							}
							tr.find('td').last().addClass('endterm');
						}
						tr.append($('<td>').text($total)).append($('<td>').text(($total/$num_courses).toFixed(2)));
						count++;
						tbody.append(tr);
					}
					table.append(tbody);	
				}else{
					alert('No result found');
				}
			}
		});
	})
}

function deleteResult(a, ths){
	var form = $(ths).closest('.resultpage').find('form.result-data');
	var title = $('#formData'+a).find('.result-title');
	var formdata = form.serializeArray();
	var school_id = $.grep(formdata, function(obj){return obj.name == 'school_id';})[0].value;
	var school = $.grep(formdata, function(obj){return obj.name == 'hierachy_name';})[0].value;
	var classs = $.grep(formdata, function(obj){return obj.name == 'class';})[0].value;
	var year = $.grep(formdata, function(obj){return obj.name == 'year';})[0].value;
	formdata.push({name:'deleteResult', value:true});
	var $page = $('#annual_page'+a);
	$(ths).questionBox('Delete this result',function(){
		$('.progress').removeClass('hide');
		$.post('process_result.php', formdata, function(response){
			$('.progress').addClass('hide');
			if(response == '1'){
				loadResults(a, ths);
				Materialize.toast('Done', 4000, 'green');
			}else{
				console.log(response);
				Materialize.toast(response, 4000, 'red');
			}
		});
	});
}
