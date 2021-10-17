<?php
		//Students action Parameter
	$param["pupilSms"]=[
		'table'=>'students',
		'primary_key'=>'id',
		'page_title'=>'Send Parents SMS',
		'icon'=>'sms',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_sms.php',
		'status_column'=>'status',
		'actionCol'=>'guardian_phone_no',
		/*'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'career Study',
			'component'=>'span',
			]
		],*/
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose SMS to Parents',
					'section_elements'=>[
						[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["pupilEmail"]=[
		'table'=>'students',
		'primary_key'=>'id',
		'page_title'=>'Send Parents Email',
		'icon'=>'email',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_email.php',
		'status_column'=>'status',
		'actionCol'=>'guardian_email',
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose Email to Parents',
					'section_elements'=>[
						[
							'column'=>'subject',
							'description'=>'Subject',
							'type'=>'input',
							'required'=>true,
							'class'=>'col s12 m12'
						],[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["pupilLoad"]=[
		'table'=>'students',
		'primary_key'=>'id',
		'page_title'=>'Load Pupils from File',
		'icon'=>'publish',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_load.php?pageType=pupils&pageTitle=Pupils',
		'status_column'=>'status',
		'submit'=>1,
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Load Pupils From an Excel File',
					'section_elements'=>[
						[
							'column'=>'year',
							'description'=>'Year',
							'type'=>'select',
							'source'=>'session',
							'required'=>true,
							'class'=>'col s12 m6'
						],[
							'column'=>'class',
							'description'=>'Class',
							'type'=>'select_',
							'required'=>true,
							'class'=>'col s12 m6',
							'source'=>'data-table="class" data-column="name" data-sort="level ASC" data-where="this-hierachy"'
						],[
							'column'=>'datafile',
							'description'=>'Select File',
							'type'=>'file',
							'required'=>true,
							'class'=>'col s12 m12',
							'icon'=>'publish'
						]
					]
				]
			]
		]
	];
	//Students action Parameter
	$param["schoolSms"]=[
		'table'=>'schools',
		'primary_key'=>'id',
		'page_title'=>'Send School Heads SMS',
		'icon'=>'sms',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_sms.php',
		'status_column'=>'status',
		'actionCol'=>'phone',
		/*'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'career Study',
			'component'=>'span',
			]
		],*/
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose SMS to School Heads',
					'section_elements'=>[
						[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["schoolEmail"]=[
		'table'=>'schools',
		'primary_key'=>'id',
		'page_title'=>'Send Schools Heads Email',
		'icon'=>'email',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_email.php',
		'status_column'=>'status',
		'actionCol'=>'email',
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose Email to School Heads',
					'section_elements'=>[
						[
							'column'=>'subject',
							'description'=>'Subject',
							'type'=>'input',
							'required'=>true,
							'class'=>'col s12 m12'
						],[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["schoolLoad"]=[
		'table'=>'schools',
		'primary_key'=>'id',
		'page_title'=>'Load Schools From File',
		'icon'=>'publish',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_load.php?pageType=schools&pageTitle=School',
		'status_column'=>'status',
		'submit'=>1,
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Load Schools From an Excel File',
					'section_elements'=>[
						[
							'column'=>'datafile',
							'description'=>'Select File',
							'type'=>'file',
							'required'=>true,
							'class'=>'col s12 m12',
							'icon'=>'publish'
						]
					]
				]
			]
		]
	];
	
	$param["teacherSms"]=[
		'table'=>'teachers',
		'primary_key'=>'id',
		'page_title'=>'Send Teachers SMS',
		'icon'=>'sms',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_sms.php',
		'status_column'=>'status',
		'actionCol'=>'phone',
		/*'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'career Study',
			'component'=>'span',
			]
		],*/
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose SMS to Teachers',
					'section_elements'=>[
						[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["teacherEmail"]=[
		'table'=>'teacher',
		'primary_key'=>'id',
		'page_title'=>'Send Teachers Email',
		'icon'=>'email',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_bulk_email.php',
		'status_column'=>'status',
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Compose Email to Teachers',
					'section_elements'=>[
						[
							'column'=>'subject',
							'description'=>'Subject',
							'type'=>'input',
							'required'=>true,
							'class'=>'col s12 m12'
						],[
							'column'=>'message',
							'description'=>'Message',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	];
	$param["teacherLoad"]=[
		'table'=>'teachers',
		'primary_key'=>'id',
		'page_title'=>'Load Teachers From File',
		'icon'=>'publish',
		'fixed_values'=>"",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"",
		'process_url'=>'process_load.php?pageType=teachers&pageTitle=Teacher',
		'status_column'=>'status',
		'actionCol'=>'email',
		'submit'=>1,
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Load Teachers From an Excel File',
					'section_elements'=>[
						[
							'column'=>'datafile',
							'description'=>'Select File',
							'type'=>'file',
							'required'=>true,
							'class'=>'col s12 m12',
							'icon'=>'publish'
						]
					]
				]
			]
		]
	];
	$param["resultLoad"]=[
		'table'=>'results',
		'primary_key'=>'exam_no',
		'page_title'=>'Upload Result',
		'icon'=>'publish',
		'process_url'=>'process_result.php?pageType=results&pageTitle=Results',
		'status_column'=>'status',
		'submit'=>1,
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Load Results From an Excel File',
					'section_elements'=>[
						[
							'column'=>'class',
							'description'=>'Class',
							'type'=>'select_',
							'required'=>true,
							'class'=>'col s12 m6',
							'source'=>'data-table="class" data-column="name" data-sort="level ASC" data-where="this-hierachy"'
						],[
							'column'=>'level',
							'description'=>'Level',
							'type'=>'select_',
							'required'=>true,
							'disabled'=>true,
							'class'=>'col s12 m6',
							//'source'=>'data-table="students" data-column="first_name" data-where="this-hierachy"'
						],[
							'column'=>'term',
							'description'=>'Term',
							'type'=>'select',
							'required'=>true,
							'class'=>'col s12 m6',
							'source'=>'term'
						],[
							'column'=>'year',
							'description'=>'Year',
							'type'=>'select',
							'required'=>true,
							'class'=>'col s12 m6',
							'source'=>'session'
						],[
							'column'=>'datafile',
							'description'=>'Select File',
							'type'=>'file',
							'required'=>true,
							'class'=>'col s12 m12',
							'icon'=>'publish'
						]
					]
				]
			]
		]
	];
	
//array("_t"=>"students_record","_c"=>"message,Message,i,t",'_idcol'=>'id','filter'=>"",'_page_title'=>'Send SMS','_page'=>'process_bulk_sms.php','_actionCol'=>"guardian_phone_no",'_icon'=>'sms');


	//$param["studentEmail"]=array("_t"=>"students_record","_c"=>"message,Message,i,t",'_idcol'=>'id','filter'=>"",'_page_title'=>'Send Email','_page'=>'process_bulk_email.php','_actionCol'=>"guardian_email",'_icon'=>'email');
	
	//$param["studentLoad"]=array("_t"=>"students_record","_c"=>"year,Year,r,s,year|student_level,Level,r,s,level|student_class,Class,r,s,miniclassname|datafile,Select File,r,u",'_idcol'=>'id','filter'=>"",'_page_title'=>'Load Records','_page'=>'process_load.php?_pageType=student','_actionCol'=>"email",'_icon'=>'publish','_submit'=>1);
	
?>
<?php
	function transferStudent($prm)
	{
		global $link;
		extract($prm);
		$query= "update students_record set student_level=-2, student_class=-2, status ='transfered' where id='$registration_no'";
		$result=mysql_query($query,$link) or die(mysql_error($link));
	}

?>