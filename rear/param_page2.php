<?php
$param = [
	'organization' => [//The current organization using the code
		'table'=>'company_info',
		'primary_key'=>'id',
		'page_title'=>'Settings',
		'fixed'=>'id=1',
		'form'=>[
			'left' => [//left side of the page
				'Basic Company Info'=>[
					[
						'column' =>'name',
						'description' => 'Business Name',
						'required' => true,
						'type' => 'input',
						'class' => 'col s12 m12'
					],[
						'column' =>'email',
						'description' => 'Email Address',
						'required' => true,
						'type' => 'input',
						'class' => 'col s12 m12'
					],[
						'column' =>'website',
						'description' => 'Website',
						'required' => false,
						'type' => 'input',
						'class' => 'col s12 m12'
					]
				]
			],
			'right' => [//right side of the page
				'Company Logo'=>[
					[
						'column' =>'logo_ref',
						'description' => 'Logo',
						'required' => true,
						'type' => 'picture',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'role'=>[//roles for the the authorized users
		'table'=>'roles',
		'display_fields'=>[
			[
				'column' =>'rolename',
				'description' => 'Role Name',
				'component' => 'boldSpan'
			]
		],
		'primary_key'=>'roleid',
		'page_title'=>'Roles',
		'form'=>[
			'center'=>[
				'Role Info'=>[
					[
						'column' =>'rolename',
						'description' => 'Role Name',
						'type' => 'input',
						'required' => true,
						'class' => 'col s12 m12'
					],[
						'column' =>'roledesc',
						'required' => true,
						'type' => 'roles',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'users' => [
		'table'=>'users',
		'display_fields'=>[
			[
				'column' =>'name',
				'description' => 'Users',
				'component' => 'span'
			]

		],
		'primary_key'=>'id',
		'page_title'=>'Users',
		'form'=>[
			'left'=>[
				'User Info'=>[
					[
					'column' =>'name',
					'description' => 'Name',
					'required' => true,
					'type' => 'input',
					'class' => 'col s12 m12'
					]
					
				],
				'Contact Info'=>[
					[
						'column' =>'phone',
						'description' => 'Phone Number',
						'class' => 'col s12 m12',
						'type' => 'input'
					],[
						'column' =>'email',
						'description' => 'Email',
						'class' => 'col s12 m12',
						'type' => 'input'
					]
				],
				'Access'=>[
					[
						'column' =>'username',
						'description' => 'Username',
						'class' => 'col s12 m12',
						'type' => 'input'
					],[
						'column' =>'password',
						'description' => 'Password',
						'type' => 'password',
						'class' => 'col s12 m12',
						'type' => 'input'
					],[
						'column' =>'roleid',
						'description' => 'Role',
						'type' => 'select',
						'class' => 'col s12 m12',
						'source' => 'role',
					],[
						'column' =>'accesslevel',
						'description' => 'Access Level',
						'type' => 'select',
						'class' => 'col s12 m12',
						'source' => 'accessLevel',
					]
				]
			],
			'right'=>[
				'Picture'=>[
					[
						'column' =>'picture',
						'description' => "User's image",
						'type' => 'picture',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'industry'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'Page',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'Industries',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='industry'",
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Article Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => ' Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'business'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'Page',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'Businesses',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='business'",
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Article Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => ' Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'category'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'Page',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'Categories',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='category'",
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Article Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Title',
						'required' => true,
						'type' => 'richtext-title',
	
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => ' Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'article'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'Article',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'Article',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='article'",
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Article Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => ' Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'news'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'News',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'News',
		'fixed_values'=>"type='news'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'News Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'News Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => 'News Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				],
				'modal'=>[
					[
						'column' =>'status',
						'description' => 'Publish',
						'required' => true,
						'type' => 'switch',
						'class' => 'col s12 m12'
					],[
						'column' =>'industry',
						'description' => 'Industry',
						'required' => true,
						'type' => 'select',
						'source' => 'industry',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => 'News Body',
						'required' => true,
						'type' => 'textarea',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'page'=>[
		'table'=>'',
		'display_fields'=>[
			[
				'column' =>'title',
				'description' => 'Pages',
				'component' => 'span',
			]/*,[
				'column' =>'date_updated',
				'description' => 'Updated at',
				'component' => 'rightbold',
			]*/
		],
		'primary_key'=>'id',
		'page_title'=>'Pages',
		'fixed_values'=>"type='page'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Page Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Page Title',
						'required' => true,
						'type' => 'input',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => 'Page ',
						'required' => true,
						'type' => 'textarea',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'career'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'career Study',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'career',
		'fixed_values'=>"type='career'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Case Study Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Case Study Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => 'Case Study Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	],
	'caseStudy'=>[
		'table'=>'',
		'display_fields'=>[
			[
			'column' =>'title',
			'description' => 'Case Study',
			'component' => 'boldSpan',
			]
		],
		'primary_key'=>'id',
		'page_title'=>'Case Study',
		'fixed_values'=>"type='caseStudy'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'form'=>[
			'center'=>[
				''=>[
					[
						'column' =>'image',
						'description' => 'Case Study Image',
						'required' => true,
						'type' => 'richtext-picture',
						'class' => 'col s12 m12'
					],[
						'column' =>'title',
						'description' => 'Case Study Title',
						'required' => true,
						'type' => 'richtext-title',
						'class' => 'col s12 m12'
					],[
						'column' =>'body',
						'description' => 'Case Study Body',
						'required' => true,
						'type' => 'richtext-body',
						'class' => 'col s12 m12'
					]
				]
			]
		]
	]
];
?>