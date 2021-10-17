<?php
$user_id = isset($_COOKIE['Generic-Login']) ? $_COOKIE['Generic-Login'] : 0;
$richtext_editors = [
	'position'=>'center',
	'section_title'=>'',
	'section_elements'=>[
		[
			'column'=>'image',
			'description'=>'Article Image',
			'required'=>true,
			'type'=>'generic-slider',
			'class'=>'col s12 m12'
		],[
			'column'=>'title',
			'description'=>'Title',
			'required'=>true,
			'type'=>'richtext-title',
			'class'=>'col s12 m12'
		],[
			'column'=>'body',
			'description'=>' Body',
			'required'=>true,
			'type'=>'richtext-body',
			'class'=>'col s12 m12'
		]
	]
];

$modal_section = [
	'position'=>'modal',
	'section_title'=>'Publish Settings',
	'section_elements'=>[
		[
			'column'=>'status',
			'source'=>'publish',
			'type'=>'switch',
			'class'=>'col s12'
		],[
			'column'=>'industry',
			'description'=>'Tag Industry',
			'required'=>true,
			'type'=>'select',
			'source'=>'industry',
			'class'=>'col s12 m6'
		],[
			'column'=>'business',
			'description'=>'Tag Business',
			'required'=>true,
			'type'=>'select',
			'source'=>'business',
			'class'=>'col s12 m6'
		],[
			'column'=>'product',
			'description'=>'Tag a Product',
			'required'=>true,
			'type'=>'select',
			'source'=>'product',
			'class'=>'col s12 m6'
		]
	]
];

$modal_section2 = [
	'position'=>'modal',
	'section_title'=>'Publish Settings',
	'section_elements'=>[
		[
			'column'=>'parent',
			'description'=>'Add to a Page',
			'required'=>true,
			'type'=>'select',
			'source'=>'page',
			'class'=>'col s12 m6'
		],[
			'column'=>'label',
			'description'=>'Add to Label',
			//'required'=>true,
			'type'=>'select',
			'source'=>'label',
			'class'=>'col s12 m6'
		]
	]
];

$param = [
	'organization'=>[//The current organization using the code
		'table'=>'company_info',
		'primary_key'=>'id',
		'page_title'=>'Settings',
		'fixed'=>'id=1',
		'display_fields'=>[
			[
				'column'=>'name',
				'description'=>'This Company',
				'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'left',
					'section_title'=>'Basic Company Info',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Business Name',
							'required'=>true,
							'type'=>'input',
							'class'=>'col s12 m12'
						],[
							'column'=>'email',
							'description'=>'Email Address',
							'required'=>true,
							'type'=>'input',
							'class'=>'col s12 m12'
						],[
							'column'=>'website',
							'description'=>'Website',
							'required'=>false,
							'type'=>'input',
							'class'=>'col s12 m12'
						]/*,[
							'column'=>'phone',
							'description'=>'Phone',
							'required'=>false,
							'disabled'=>true,
							'type'=>'select',
							'required'=>true,
							'class'=>'col s12 m12',
							'source'=>'bool',
							
						]*/
					]
				],[
					'position'=>'right',
					'section_title'=>'Company Logo',
					'section_elements'=>[
						[
							'column'=>'logo_ref',
							'description'=>'Logo',
							'required'=>true,
							'type'=>'picture',
							'class'=>'col s12 m12'
						]
					]
				],[
					'position'=>'left',
					'section_title'=>'Branch Offices',
					'section_elements'=>[
						[
							'column'=>'branches',
							'description'=>'',
							'type'=>'description',
							'class'=>'col s12 m12 hidename '
						]
					]
				]
			]
		]
	],//new page
	'role'=>[
		'table'=>'roles',
		'primary_key'=>'roleid',
		'page_title'=>'Roles',
		'display_fields'=>[
			[
				'column'=>'rolename',
				'description'=>'Role Name',
				'component'=>'boldSpan'
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Role Info',
					'section_elements'=>[
						[
							'column'=>'rolename',
							'description'=>'Role Name',
							'type'=>'input',
							'required'=>true,
							'class'=>'col s12 m12'
						],[
							'column'=>'roledesc',
							'required'=>true,
							'type'=>'roles',
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],//new page
	'subscribers'=>[
		'table'=>'subscribers',
		'primary_key'=>'id',
		'page_title'=>'Subscribers',
		'ModalForm'=>true,
		'listFAB'=>['delete'],
		'display_fields'=>[
			[
				'column'=>'email',
				'description'=>'Email',
				'component'=>'span'
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Subscriber Info',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Subscriber Name',
							'type'=>'text',
							'required'=>true,
							'class'=>'col s12 m12'
						],[
							'column'=>'email',
							'description'=>'Email',
							'type'=>'email',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],
	'users'=>[
		'table'=>'users',
		'primary_key'=>'id',
		'page_title'=>'Users',
		'display_fields'=>[
			[
				'column'=>'name',
				'description'=>'Users',
				'component'=>'span'
			]/*,[
				'column'=>'username',
				'description'=>'username',
				'component'=>'span'
			]*/

		],
		'form'=>[
			'sections'=>[
			[
				'position'=>'left',
				'section_title'=>'User Info',
				'section_elements'=>[
					[
					'column'=>'name',
					'description'=>'Name',
					'required'=>true,
					'type'=>'input',
					'class'=>'col s12 m12'
					],[
						'column'=>'bio',
						'description'=>'250 character bio',
						'class'=>'col s12 m12',
						'type'=>'textarea'
					]
				]
			],[
				'position'=>'left',
				'section_title'=>'Contact Info',
				'section_elements'=>[
					[
						'column'=>'phone',
						'description'=>'Phone Number',
						'class'=>'col s12 m12',
						'type'=>'input'
					],[
						'column'=>'email',
						'description'=>'Email',
						'class'=>'col s12 m12',
						'type'=>'input'
					],[
						'column'=>'website',
						'description'=>'LinkedIN profile Address',
						'class'=>'col s12 m12',
						'type'=>'input'
					]
				]
			],[
				'position'=>'left',
				'section_title'=>'Security Settings',
				'section_elements'=>[
					[
						'column'=>'username',
						'description'=>'Username',
						'class'=>'col s12 m12',
						'type'=>'input',
						'required'=>true
					],[
						'column'=>'password',
						'description'=>'Password',
						'type'=>'password',
						'required'=>true,
						'class'=>'col s12 m12'
					],[
						'column'=>'roleid',
						'description'=>'Role',
						'type'=>'select',
						'required'=>true,
						'class'=>'col s12 m12',
						'source'=>'role',
					],[
						'column'=>'accesslevel',
						'description'=>'Access Level',
						'type'=>'select',
						'required'=>true,
						'class'=>'col s12 m12',
						'source'=>'accessLevel',
					]
				]
			],[
				'position'=>'right',
				'section_title'=>'Company Logo',
				'section_elements'=>[
					[
						'column'=>'picture_ref',
						'description'=>'Logo',
						'required'=>true,
						'type'=>'picture',
						'class'=>'col s12 m12'
					]
				]
			]]
		]
	],
	'industry'=>[//industry page
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Industries',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'retrieve_filter'=>"type='industry'",
		'fixed_values'=>"type='industry',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'front_end'=>[
			'extra'=>"(type='article' OR type='news' OR type='caseStudy' OR type='career') AND industry='content_id'  AND status='1' ORDER BY date_uploaded DESC",
			'view'=>'read_three', 
			'reader'=>true
		],
		'display_fields'=>[
			[
				'column'=>'title',
				'description'=>'Industries',
				'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section2
			]
		]
	],
	'business'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Businesses',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='business',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='business'",
		'front_end'=>[
			'extra'=>"(type='article' OR type='news' OR type='caseStudy' OR type='career') AND business='content_id' AND status='1'  ORDER BY date_uploaded DESC",
			'view'=>'read_three', 
			'reader'=>true
		],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'Businesses',
			'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section2
			]
		]
	],
	'category'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Categories',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='category',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='category'",
		'front_end'=>['where'=>"category='content_id' AND type='article' AND status='1'",'view'=>'list_one'],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'Insight Categories',
			'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section2
			]
		]
	],
	'article'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Article',
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'fixed_values'=>"type='article',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='article'",
		'front_end'=>['extra'=>'related articles','reader'=>'true'],
		'display_fields'=>[
			[
				'column'=>'title',
				'description'=>'Article',
				'component'=>'span',
			],[
				'column'=>'status',
				'description'=>'Published ?',
				'component'=>'span',
				'action'=>'select',
				'source'=>'bool',
			],[
				'column'=>'category',
				'description'=>'Insight',
				'component'=>'span',
				'action'=>'select',
				'source'=>'category',
			]
		],
		'category'=>[
			[
				'column'=>'',
				'name'=>'All Articles',
				'type'=>'select',
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Drafts',
				'value'=>'0'
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Published',
				'value'=>'1'
			],[
				'column'=>'category',
				'type'=>'select',
				'name'=>'By Category',
				'source'=>'category'
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				[
					'position'=>'modal',
					'section_title'=>'Publish Settings',
					'section_elements'=>[
						[
							'column'=>'status',
							'source'=>'publish',
							'type'=>'switch',
							'class'=>'col s12 m12'
						],[
							'column'=>'category',
							'description'=>'Tag Insight Category',
							'required'=>true,
							'type'=>'select',
							'removeEmpty'=>true,
							'source'=>'category',
							'class'=>'col s12 m6',
							'onChange'=>[]
						],[
							'column'=>'industry',
							'description'=>'Tag Industry',
							//'required'=>true,
							'type'=>'select',
							'source'=>'industry',
							'class'=>'col s12 m6'
						],[
							'column'=>'business',
							'description'=>'Tag Business',
							//'required'=>true,
							'type'=>'select',
							'source'=>'business',
							'class'=>'col s12 m6'
						],[
							'column'=>'product',
							'description'=>'Tag a Product',
							//'required'=>true,
							'type'=>'select',
							'source'=>'product',
							'class'=>'col s12 m6'
						]
					]
				]
			]
		]
	],
	'news'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'News',
		'fixed_values'=>"type='news',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='news'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'front_end' =>['where'=>"type='news'",'view'=>'list_view'],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'News',
			'component'=>'span',
			],[
				'column'=>'status',
				'description'=>'Published ?',
				'component'=>'span',
				'action'=>'s',
				'source'=>'bool',
			]
		],
		'category'=>[
			[
				'column'=>'',
				'name'=>'All Articles',
				'type'=>'select',
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Drafts',
				'value'=>'0'
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Published',
				'value'=>'1'
			]
		],
		
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section
			]
		]
	],
	'page'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Pages',
		'fixed_values'=>"type='page',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='page'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'display_fields'=>[
			[
				'column'=>'title',
				'description'=>'Pages',
				'component'=>'span',
			]
		],
		
		'form'=>[
			'sections'=>[
				$richtext_editors,
				[
				'position'=>'modal',
				'section_title'=>'Page Ordering',
				'section_elements'=>[
						[	
						'column'=>'label',
						'description'=>'Numeric values only from 1',
						'required'=>true,
						'type'=>'number',
						'class'=>'col s12 m6'
						]
					]
				]
			]
		]
	],
	'career'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'career',
		'fixed_values'=>"type='career',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='career'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'front_end' =>['where'=>"type='career'",'view'=>'list_two'],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'career Study',
			'component'=>'span',
			],[
				'column'=>'status',
				'description'=>'Published ?',
				'component'=>'span',
				'action'=>'s',
				'source'=>'bool',
			]
		],
		'category'=>[
			[
				'column'=>'',
				'name'=>'All Articles',
				'type'=>'select',
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Drafts',
				'value'=>'0'
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Published',
				'value'=>'1'
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section
			]
		]
	],
	'caseStudy'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Case Study',
		'fixed_values'=>"type='caseStudy',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='caseStudy'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'front_end' =>['where'=>"type='caseStudy'",'view'=>'list_three'],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'Case Study',
			'component'=>'span',
			],[
				'column'=>'status',
				'description'=>'Published ?',
				'component'=>'span',
				'action'=>'s',
				'source'=>'bool',
			]
		],
		'category'=>[
			[
				'column'=>'',
				'name'=>'All Articles',
				'type'=>'select',
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Drafts',
				'value'=>'0'
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Published',
				'value'=>'1'
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section
			]
		]
	],
	'subPage'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'page_title'=>'Sub Pages',
		'fixed_values'=>"type='subPage',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='subPage'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'Sub Pages',
			'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				$richtext_editors,
				[
					'position'=>'modal',
					'section_title'=>'Publish Settings',
					'section_elements'=>[
						[
							'column'=>'parent',
							'description'=>'Add to a Page',
							'required'=>true,
							'type'=>'select',
							'source'=>'page',
							'class'=>'col s12 m6'
						],[
							'column'=>'label',
							'description'=>'Add to Label',
							'required'=>true,
							'type'=>'select',
							'source'=>'label',
							'class'=>'col s12 m6'
						],[
							'column'=>'url',
							'description'=>'Override a url',
							'type'=>'input',
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],
	'label'=>[
		'table'=>'content',
		'primary_key'=>'id',
		'ModalForm'=>true,
		'page_title'=>'Group Label',
		'fixed_values'=>"type='label',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='label'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'display_fields'=>[
			[
				'column'=>'title',
				'description'=>'Label',
				'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Add / Edit Label',
					'section_elements'=>[
						[
							'column'=>'title',
							'description'=>'Label Name',
							'required'=>true,
							'type'=>'input',
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],
	'product'=>[
		'table'=>'content',
		
		'primary_key'=>'id',
		'page_title'=>'Products',
		'fixed_values'=>"type='product',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='product'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'front_end'=>['view'=>'read_two', 'reader'=>true, 'extra'=>"(type='article' OR type='news' OR type='caseStudy' OR type='career') AND product='content_id' AND status='1' ORDER BY date_uploaded DESC "],
		'display_fields'=>[
			[
			'column'=>'title',
			'description'=>'Products',
			'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				[
				'position'=>'center page_1',
				'section_title'=>'',
				'section_elements'=>[
					[
						'column'=>'image',
						'description'=>'Article Image',
						'required'=>true,
						'type'=>'generic-slider',
						'class'=>'col s12 m12'],
						[
						'column'=>'title',
						'description'=>'Title',
						'required'=>true,
						'type'=>'richtext-title',
						'class'=>'col s12 m12'
						],[
						'column'=>'body',
						'description'=>' Body',
						'required'=>true,
						'type'=>'richtext-body',
						'class'=>'col s12 m12'
						]
					]
				],[
					'position'=>'left page_2',
					'section_title'=>'',
					'section_elements'=>[
						[
							'column'=>'product_desc',
							'description'=>'',
							'required'=>true,
							'type'=>'description',
							'class'=>'col s12 m12'
						]
					]
				],[
					'position'=>'right page_2',
					'section_title'=>'Publish Settings',
					'section_elements'=>[
						[
							'column'=>'status',
							'source'=>'publish',
							'type'=>'switch',
							'class'=>'col s12'
						],[
							'column'=>'parent',
							'description'=>'Add to a Page',
							'required'=>true,
							'type'=>'select',
							'source'=>'page',
							'class'=>'col s12 m12'
						],[
							'column'=>'label',
							'description'=>'Add to Label',
							'required'=>true,
							'type'=>'select',
							'source'=>'label',
							'class'=>'col s12 m12'
						]/*,[
							'column'=>'url',
							'description'=>'Re-route page',
							'type'=>'input',
							'class'=>'col s12 m12
						]*/
					]
				]
			]
		]
	],
	// Valentine's __________________

	'brands'=>[//The current organization using the code
		'table'=>'category_type',
		'primary_key'=>'typeid',
		'page_title'=>'Brands',
		// 'fixed'=>'id=1',
		'retrieve_filter'=>'category=3',
		'fixed_values'=>'category=3',
		'ModalForm'=>true,
		'display_fields'=>[
			[
				'column'=>'name',
				'description'=>'Brands',
				'component'=>'span'
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Add/Edit Brand',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Add/Edit Brand',
							'required'=>true,
							'type'=>'text',
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],

	'parent_categories'=>[//The current organization using the code
		'table'=>'category_type',
		'primary_key'=>'typeid',
		'page_title'=>'Parent Category',
		'retrieve_filter'=>'parent=0 and category=2',
		'fixed_values'=>'parent=0, category=2',
		'ModalForm'=>true,
		'display_fields'=>[
			[	
				'column'=>'name',
				'description'=>'Parent Category',
				'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Add/Edit Parent Category',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Parent Category Name',
							'required'=>true,
							'type'=>'text',
							'class'=>'col s12 m12'
						]/*,
						[
							'column'=>'menu_image',
							'description'=>'Menu Image',
							'type'=>'picture',
							'class'=>'col s12 m12'
						]*/
					]
				]
			]
		]
	],


	'sub_categories'=>[//The current organization using the code
		'table'=>'category_type',
		'primary_key'=>'typeid',
		'page_title'=>'Sub Category',
		'retrieve_filter'=>'category=2 and parent !=0',
		'fixed_values'=>'category=2',
		'ModalForm'=>true,
		'display_fields'=>[
			[	
				'column'=>'name',
				'description'=>'Sub Category',
				'component'=>'span',
			],
			[	
				'column'=>'parent',
				'description'=>'Parent Category',
				'component'=>'span',
				'source'=>'parent_categories',
				'action'=>'select',
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Add/Edit Sub Category',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Edit/Add Sub Category',
							'required'=>true,
							'type'=>'text',
							'class'=>'col s12 m12'
						],[
							'column'=>'parent',
							'description'=>'Select a parent Category',
							'required'=>true,
							'type'=>'select',
							'source'=>'parent_categories',
							'class'=>'col s12 m12'
						]
					]
				]	
			]
		]
	],



	'item'=>[
		'table'=>'item',
		'primary_key'=>'tid',
		'page_title'=>'Products',
		'fixed_values'=>"date_created=now(), created_by='$user_id', sold=0",
		// 'extra_values'=>''
		'display_fields'=>[
			[
				'column'=>'description',
				'description'=>'Product Items',
				'component'=>'span'
			],
			[
				'column'=>'price1',
				'description'=>'(&#8358;) Price',
				'component'=>'span'
			],
			[
				'column'=>'price2',
				'description'=>'(&#8358;) List Price',
				'component'=>'span'
			],
			[
				'column'=>'quantity_on_hand',
				'description'=>'Quantity',
				'component'=>'span',
			],
			[
				'column'=>'sold',
				'description'=>'SOLD',
				'component'=>'span'
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Edit/Add Product',
					'section_elements'=>[
						[	
							'column'=>'description',
							'description'=>'Product Title',
							'type'=>'text',
							'required'=>true,
							'class'=>'col s6 m6'
						],
						[	
							'column'=>'brand',
							'description'=>'Brands',
							'type'=>'select',
							'source'=>'brands',
							'required'=>true,
							'class'=>'col s6 m6'
						],
						[	
							'column'=>'pcategories',
							'description'=>'Parent Category',
							'type'=>'select',
							'source'=>'parent_categories',
							'required'=>true,
							'class'=>'col s6 m6',
							'onChange'=>['source'=>'sub_categories','filter'=>'parent','name'=>'categories', 'function'=>''],
							 'empty'=> false
						],
						[	
							'column'=>'categories',
							'description'=>'Sub Category',
							'type'=>'select',
							'source'=>'sub_categories',
							'required'=>true,
							'class'=>'col s6 m6',
						],
						[	
							'column'=>'price1',
							'description'=>'Price',
							'type'=>'number',
							'required'=>true,
							'class'=>'col s4 m4'
						],
						[	
							'column'=>'price2',
							'description'=>'List Price',
							'type'=>'number',
							'class'=>'col s4 m4'
						],
						[	
							'column'=>'quantity_on_hand',
							'description'=>'Quantity',
							'type'=>'number',
							'required'=>true,
							'class'=>'col s2 m2'
						],
						[
							'column'=>'threshold',
							'description'=>'Threshold',
							'type'=>'number',
							'class'=>'col s2 m2'
						],
						[
							'column'=>'taxable',
							'description'=>'Taxable',
							'type'=>'select',
							'class'=>'col s2 m2'
						]
					]
				],
				[

					'position'=>'left',
					'section_title'=>'Product Description',
					'section_elements'=>[
						[
							'column'=>'sales_desc',
							'description'=>'Description',
							'type'=>'textarea',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				],
				[

					'position'=>'right',
					'section_title'=>'Product Picture',
					'section_elements'=>[
						[	
							'column'=>'picture',
							'description'=>'Image',
							'type'=>'items',
							'required'=>true,
							'class'=>'col s12 m12'
						]
					]
				]
			]
		]
	],


	'archive'=>[//The current organization using the code
		'table'=>'',
		'primary_key'=>'id',
		'page_title'=>'Archive',
		'fixed'=>'id=1',
		'retrieve_filter'=>'archive=1',
		'display_fields'=>[
			[
				'column'=>'archive',
				'description'=>'Archived Products',
				'component'=>'span',
			]
		],
		'form'=>[
			'sections'=>[
				[
					'position'=>'center',
					'section_title'=>'Basic Company Info',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Business Name',
							'required'=>true,
							'type'=>'input',
							'class'=>'col s12 m12'
						]	
					]
				],
				[
					'position'=>'left',
					'section_title'=>'Basic Company Info',
					'section_elements'=>[
						[
							'column'=>'name',
							'description'=>'Business Name',
							'required'=>true,
							'type'=>'input',
							'class'=>'col s12 m12'
						]
					]
				],
				// [
				// 	'position'=>'right',
				// 	'section_title'=>'Company Logo',
				// 	'section_elements'=>[
				// 		[
				// 			'column'=>'logo_ref',
				// 			'description'=>'Logo',
				// 			'required'=>true,
				// 			'type'=>'picture',
				// 			'class'=>'col s12 m12'
				// 		]
				// 	]
				// ],[
				// 	'position'=>'left',
				// 	'section_title'=>'Branch Offices',
				// 	'section_elements'=>[
				// 		[
				// 			'column'=>'branches',
				// 			'description'=>'',
				// 			'type'=>'description',
				// 			'class'=>'col s12 m12 hidename '
				// 		]
				// 	]
				// ]
			]
		]
	],


	'change_password'=>[
		'table'=>'',
		'primary_key'=>'id',
		'page_title'=>'News',
		'fixed_values'=>"type='news',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		'extra_values'=>"last_updated=now()",
		'retrieve_filter'=>"type='news'",
		'process_url'=>'process_generic.php',
		'status_column'=>'status',
		'front_end' =>['where'=>"type='news'",'view'=>'list_view'],
		'display_fields'=>[
			[
			'column'=>'Change Password',
			'description'=>'change_pass',
			'component'=>'span',
			],[
				'column'=>'status',
				'description'=>'Published ?',
				'component'=>'span',
				'action'=>'s',
				'source'=>'bool',
			]
		],
		'category'=>[
			[
				'column'=>'',
				'name'=>'All Articles',
				'type'=>'select',
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Drafts',
				'value'=>'0'
			],[
				'column'=>'status',
				'type'=>'select',
				'name'=>'Published',
				'value'=>'1'
			]
		],
		
		'form'=>[
			'sections'=>[
				$richtext_editors,
				$modal_section
			]
		]
	] 

]


?>