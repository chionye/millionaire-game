<?php
	$curdate =!isset($_COOKIE["_today"]) ? $curdate= date("Y-m-d") : $_COOKIE["_today"]; 
// Dashboard Report starts here
	$param["dashboardOne"]=array("t"=>"transactions",'idcol'=>'tid',"sort_col"=>"ref","page_title"=>"dashboard",'report_type'=>0,
	"group"=>"description,Item","condition"=>"sub<>0 and type is null ",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Dashboard');
	
	
	
	$param["dashboardOne"]["graphCol"]="amount,Amount,N|quantity,Quantity,";
	// Dashboard report ends here
// Income Statement starts here
	$param["incomeStatement"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Income Statement",'report_type'=>0,
	"condition"=>"sub=0 and type is null and trans_type='INV'",'datecol'=>'date','idatacol'=>'amount|amount_paid|net_due','page_label'=>'Income Statement');
	$param["incomeStatement"]["_form"]="account_name,account_name,Account Name,v,i,s,k,1|amount,sum(amount),Amount,v,n,s,k,1";
	$param["incomeStatement"]["group"]="net_income,(21),Revenue,1,s,1|expenses,(24),Expenses,-1,s,-1";
	$param["incomeStatement"]["group_filter"]="description,Item Description,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customer,Customer,r,minicustomer";
	$param["incomeStatement"]["graphCol"]="amount,Amount,N|amount_paid,Amount Paid,N|net_due,Net Due,N";
	// Income Statemnt ends here

// Balance Sheet starts here
	$param["balanceSheet"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Balance Sheet",'report_type'=>0,
	"condition"=>"sub=0 and type is null and trans_type='INV'",'datecol'=>'date','idatacol'=>'amount|amount_paid|net_due','page_label'=>'Income Statement');
	$param["balanceSheet"]["_form"]="account_name,account_name,Account Name,v,i,s,k,1|amount,sum(gl_amount),Amount,v,n,s,k,1";
	$param["balanceSheet"]["group"]="cash,(0,2),Current Asset,1,s,1|fixed_asset,(5),Property & Equipment,1,s,1|other_asset,(4),Other Current Asset,1,s,1|payable,(10),Current Liability,-1,s,-1|liability,(12),Other Current Liability,-1,s,-1|long_liability,(10),Long Term Liability,-1,s,-1";
	$param["balanceSheet"]["group_filter"]="description,Item Description,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customer,Customer,r,minicustomer";
	$param["balanceSheet"]["graphCol"]="amount,Amount,N|amount_paid,Amount Paid,N|net_due,Net Due,N";
	// Income Statemnt ends here

// Invoice Report starts here
	$param["invoiceReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Invoice Report",'report_type'=>0,
	"group"=>"description,Item","condition"=>"sub=0 and type is null and trans_type='INV'",'datecol'=>'date','idatacol'=>'amount|amount_paid|net_due','page_label'=>'Invoice');
	$param["invoiceReport"]["_form"]="date,date(date),Date,v,i,s,k,1|reference,ref,Reference,v,i,s,k,1|customerid,cref,Customer ID,v,i,s,k,1|customername,customer,Customer Name,v,i,s,k,0|amount,sum(amount),Amount,v,n,s,k,0|amount_paid,sum(applied_credit),Amount Paid,v,n,s,k,0|net_due,sum(net_due),Net Due,v,n,s,k,0|warehouse,warehouse,Location,v,i,s,k,1|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["invoiceReport"]["group_others"]="it_id,Item ID|warehouse,Location|reference,Reference|customerid,Customer ID|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["invoiceReport"]["group_filter"]="description,Item Description,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customer,Customer,r,minicustomer";
	$param["invoiceReport"]["graphCol"]="amount,Amount,N|amount_paid,Amount Paid,N|net_due,Net Due,N";
	// Sales report ends here

// Sales Report starts here
	$param["salesReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Sales Report",'report_type'=>0,
	"group"=>"description,Item","condition"=>"sub<>0 and type is null and (trans_type='INV' OR trans_type='RCP' OR trans_type='CDM')",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Sales');
	$param["salesReport"]["_form"]="date,date(date),Date,v,i,s,k,1|reference,ref,Reference,v,i,s,k,1|productid,itemid,Item ID,v,i,s,k,1|description,description,Item Description,v,i,s,k,0|customerid,cref,Customer ID,v,i,s,k,1|customername,customer,Customer Name,v,i,s,k,0|quantity,sum(quantity),Quantity,v,n,s,k,0|unit_price,avg(rate),Average Price,v,n,s,k,0|amount,sum(amount),Amount,v,n,s,k,0|warehouse,warehouse,Location,v,i,s,k,1|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["salesReport"]["group_others"]="it_id,Item ID|warehouse,Location|reference,Reference|customerid,Customer ID|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["salesReport"]["group_filter"]="description,Item Description,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customer,Customer,r,minicustomer";
	$param["salesReport"]["graphCol"]="amount,Amount,N|quantity,Quantity,";
	// Sales report ends here

// Purchase Report starts here
	$param["purchaseReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Purchase Report",'report_type'=>0,
	"group"=>"description,Item","condition"=>"sub<>0 and type is null ",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Purchase');
	$param["purchaseReport"]["_form"]="date,date(date),Date,v,i,s,k,1|reference,ref,Reference,v,i,s,k,1|productid,itemid,Item ID,v,i,s,k,1|description,description,Item Description,v,i,s,k,0|customerid,cref,Customer ID,v,i,s,k,1|customername,customer,Customer Name,v,i,s,k,0|quantity,sum(quantity),Quantity,v,n,s,k,0|unit_price,avg(rate),Average Price,v,n,s,k,0|amount,sum(amount),Amount,v,n,s,k,0|warehouse,warehouse,Location,v,i,s,k,1|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["purchaseReport"]["group_others"]="it_id,Item ID|warehouse,Location|reference,Reference|customerid,Customer ID|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["purchaseReport"]["group_filter"]="description,Item Description,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customer,Vendor,r,minivendor";
	$param["purchaseReport"]["graphCol"]="amount,Amount,N|quantity,Quantity,";
	// Purchase report ends here

// Receipt Report starts here
	$param["receiptReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Receipt Report",'report_type'=>0,
	"group"=>"customer,Customer","condition"=>"sub<>0 and type is null and trans_type='RCP' $_wd ",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Receipt');
	$param["receiptReport"]["_form"]="date,date(date),Date,v,i,s,k,1|reference,ref,Reference,v,i,s,k,1|productid,itemid,Item ID,v,i,s,k,1|description,description,Item Description,v,i,s,k,0|customerid,cref,Customer ID,v,i,s,k,1|customername,customer,Customer Name,v,i,s,k,0|quantity,sum(quantity),Quantity,v,n,s,k,0|unit_price,avg(rate),Average Price,v,n,s,k,0|amount,sum(amount),Amount,v,n,s,k,0|warehouse,warehouse,Location,v,i,s,k,1|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["receiptReport"]["group_others"]="it_id,Item ID|warehouse,Location|reference,Reference|customerid,Customer ID|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["receiptReport"]["group_filter"]="description,Item Description,r,item|account,Account,r,accounts|warehouse,Location,r,warehouse|customer,Customer,r,minicustomer";
	$param["receiptReport"]["graphCol"]="amount,Amount,N|quantity,Quantity,";
	// Recieipt report ends here

// Payment Report starts here
	$param["paymentReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Payment Report",'report_type'=>0,
	"group"=>"account_name,Account Name","condition"=>"sub<>0 and type is null and trans_type='PYT' $_wd ",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Payments');
	$param["paymentReport"]["_form"]="date,date(date),Date,v,i,s,k,1,d|ref,ref,Reference,v,i,s,k,1,d|tid,description, Description,v,i,s,k,1|customername,customer,Name,v,i,s,k,0|account,account_name,Account Name,v,i,s,k,1|warehouse,warehouse,Location,v,i,s,k,1|method,method,Payment Mode,v,i,s,k,1|amount,sum(amount),Amount,v,n,s,k,0|quantity,sum(quantity),Quantity,h,n,s,k,0|unit_price,avg(rate),Average Price,h,n,s,k,0|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["paymentReport"]["group_others"]="account_name,Account|it_id,Item ID|warehouse,Location|reference,Reference|customer,Vendor|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["paymentReport"]["group_filter"]="description,Item Description,r,item|account,Account,r,accounts|warehouse,Location,r,warehouse|customer,Vendor,r,minivendor|method,Payment Mode,s,paymentMode";
	$param["paymentReport"]["graphCol"]="amount,Amount,N";
	// Payment report ends here

// Disbursement starts here
	$param["disbursementReport"]=array("t"=>"transactions",'idcol'=>'trans_no',"sort_col"=>"date","page_title"=>"Disbursement Report",'report_type'=>0,
	"group"=>"account_name,Account Name","condition"=>"sub=0 and type is null and trans_type='PYT' $_wd ",'datecol'=>'date','idatacol'=>'amount|quantity','page_label'=>'Disbursement');
	$param["disbursementReport"]["_form"]="date,date(date),Date,v,i,s,k,1,d|ref,ref,Reference,v,i,s,k,1,d|tid,description, Description,v,i,s,k,1|customername,customer,Name,v,i,s,k,0|account,account_name,Account Name,v,i,s,k,1|warehouse,warehouse,Location,v,i,s,k,1|amount,sum(amount),Amount,v,n,s,k,0|quantity,sum(quantity),Quantity,h,n,s,k,0|unit_price,avg(rate),Average Price,h,n,s,k,0|year,year(date),Year,h,i,s,k,1|month,monthname(date),Month,h,i,s,k,1|item_count,count(tid),Number of Items,h,i,s,k,0";
	$param["disbursementReport"]["group_others"]="account_name,Account|it_id,Item ID|warehouse,Location|reference,Reference|customer,Vendor|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["disbursementReport"]["group_filter"]="method,Mode Of Payment,r,paymentMode|account,Account,r,accounts|warehouse,Location,r,warehouse|customer,Vendor,r,minivendor";
	$param["disbursementReport"]["graphCol"]="amount,Amount,N";
	// Payment report ends here


// Inventory Report starts here
	$param["inventoryReport"]=array("t"=>"item",'idcol'=>'tid',"sort_col"=>"description","page_title"=>"Inventory Report",'report_type'=>0,
	"group"=>"","noTrans"=>1);
	$param["inventoryReport"]["_form"]="itemid,itemid,Item ID,v,i,s,k|description,description,Item Description,v,i,s,k|upc,upc,UPC Code,v,i,s,k|item_type,item_type,Item Type,v,i,s,k|unit,unit,Unit,v,i,s,k|weight,weight,Weight,v,i,s,k|unit_cost,sum(unit_cost),Unit Cost,v,i,s,k|price,sum(price1),Price,v,i,s,k|quantity_on_hand,sum(quantity_on_hand),Quantity on Hand,v,i,s,k|blank,'',Number Counted,h,i,s,k|counted,count(*),Number of Items,h,i,s,k|present_value,(sum(unit_cost)*sum(quantity_on_hand)),Current Value,h,i,s,k|gl_sales_account,gl_sales_account,GL Sales Account,h,i,s,k|gl_inventory_account,gl_inventory_account,GL Inventory Account,h,i,s,k|vendor_id,vendor_id,Prefered Vendor,h,i,s,k|buyer_id,buyer_id,Prefered Buyer,h,i,s,k";
	$param["inventoryReport"]["group_others"]="warehouse,Location|reference,Reference|productid,Item ID|customerid,Customer ID|unit_price,Unit Price|year(date),Year|monthname(date),Months|time(date),Time";
	$param["inventoryReport"]["group_filter"]="itemid,Item ID,r,item|item_type,Item Type,r,productType|warehouse,Location,r,warehouse|customerid,Customer,r,customer";
	$param["inventoryReport"]["graphCol"]="quantity,Quantity,|amount,Amount,N";
	// Inventory report ends here
	
// Customer Report starts here
	$param["customerReport"]=array("t"=>"customer",'idcol'=>'cid',"sort_col"=>"customername",'datecol'=>'date',"page_title"=>"Customer Report",'report_type'=>0,"group"=>"","condition"=>"type=1","noTrans"=>1);
	$param["customerReport"]["_form"]="customerid,customerid,Customer ID,v,i,s,k|customername,customername,Customer Name,v,i,s,k|address,address,Address,v,i,s,k|telephone,telephone,Telephone,v,i,s,k|email,email,Email,v,i,s,k|current_balance,current_balance,Current Balance,h,i,s,k";
	$param["customerReport"]["group_others"]="city,City|state,State|country,Country|zipcode,Zip Code|sales_representative_id,Sales Representative|ship_via,Ship Via|type,Customer Type|prospect,Prospect|referal,Referal|inactive,Inactive";
	$param["customerReport"]["group_filter"]="customerid,Customer ID,r,customer|type,Customer Type,s,customerType|current_balance,Current Balance,i,";
	$param["customerReport"]["graphCol"]="quantity,Quantity,|amount,Amount,N";
	// Customer report ends here

// Vendor Report starts here
	$param["vendorReport"]=array("t"=>"customer",'idcol'=>'cid',"sort_col"=>"customername","page_title"=>"Vendor Report",'report_type'=>0,"group"=>"","condition"=>"type=2","noTrans"=>1);
	$param["vendorReport"]["_form"]="customerid,customerid,Vendor ID,v,i,s,k|customername,customername,Vendor Name,v,i,s,k|address,address,Address,v,i,s,k|telephone,telephone,Telephone,v,i,s,k|email,email,Email,v,i,s,k|current_balance,current_balance,Current Balance,h,i,s,k";
	$param["vendorReport"]["group_others"]="city,City|state,State|country,Country|zipcode,Zip Code|sales_representative_id,Sales Representative|ship_via,Ship Via|type,Customer Type|prospect,Prospect|referal,Referal|inactive,Inactive";
	$param["vendorReport"]["group_filter"]="customerid,Customer ID,r,customer|type,Customer Type,s,customerType|current_balance,Current Balance,i,";
	$param["vendorReport"]["graphCol"]="quantity,Quantity,|amount,Amount,N";
	// Vendor report ends here

	//Account Register
	$param["accountRegister"]=array("t"=>"account_chart","c"=>"account_name,Account Name,b,l|account_id,Account ID,s,l|account_type,Account Type,s,s,accountType",'idcol'=>'account_id',"page_title"=>"Account Register",'report_type'=>1,'filter'=>'account_type=0',"sort_col"=>"account_id","form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'trans_no',"form_filter"=>"account","form_action"=>"gl_amount","_category"=>"date,Date,period,today|warehouse,Location,warehouse");
		$param["accountRegister"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customerid,cref,Customer ID,i,s,k|customername,customer,Customer Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["accountRegister"]['extra']["coldesc"]=array("Debit","Credit","Balance");

	// Account Register Ends Here	
	// Inventor Balance starts here
	$param["inventoryBalance"]=array("t"=>"item","c"=>"description,Description,b,a|itemid,Item ID,s,a",'idcol'=>'tid',"page_title"=>"Item Balance Report",'report_type'=>1,"form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'tid',"form_filter"=>"it_id","form_action"=>"gl_quantity","_category"=>"date,Date,period,today|warehouse,Location,warehouse");
		$param["inventoryBalance"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customername,customer,Customer Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["inventoryBalance"]['extra']["coldesc"]=array("Debit","Credit","Balance");
	// Inventory Balance Ends here

	// Customer Balance starts here
	$param["customerBalance"]=array("t"=>"customer","c"=>"customername,Customer Name,b,a|customerid,Customer ID,s,a",'idcol'=>'cid',"page_title"=>"Customer Balance Report",'report_type'=>2,'filter'=>"type=1 $_wd ","form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'trans_no',"form_filter"=>"cid","form_debit"=>"amount_due","form_credit"=>"amount_paid","sign"=>1,"form_condition"=>"sub=0","_category"=>"date,Date,period,today|warehouse,Location,warehouse");
		$param["customerBalance"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customername,customer,Customer Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["customerBalance"]['extra']["coldesc"]=array("Debit","Credit","Balance");
	// Customer Balance Ends here

	// Customer Activity starts here
	$param["customerActivity"]=array("t"=>"customer","c"=>"customername,Customer Name,b,a|customerid,Customer ID,s,a",'idcol'=>'cid',"page_title"=>"Customer Activity Report",'report_type'=>2,'filter'=>"type=1 $_wd ","form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'tid',"form_filter"=>"cid","form_debit"=>"amount_due","form_credit"=>"amount_paid","sign"=>1,"form_condition"=>"sub<>0");
		$param["customerActivity"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customername,customer,Customer Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["customerActivity"]['extra']["coldesc"]=array("Debit","Credit","Balance");
	// Customer Activity Ends here
	
	// Vendor Balance starts here
	$param["vendorBalance"]=array("t"=>"customer","c"=>"customername,Vendor Name,b,a|customerid,Vendor ID,s,a",'idcol'=>'cid',"page_title"=>"Vendor Balance Report",'report_type'=>2,'filter'=>"type=2 $_wd ","form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'tid',"form_filter"=>"cid","form_credit"=>"amount_due","form_debit"=>"amount_paid","sign"=>-1,"form_condition"=>"sub=0","_category"=>"date,Date,period,today|warehouse,Location,warehouse");
		$param["vendorBalance"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customername,customer,Vendor Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["vendorBalance"]['extra']["coldesc"]=array("Debit","Credit","Balance");
	// Vendor Balance Ends here

	// Vendor Activity starts here
	$param["vendorActivity"]=array("t"=>"customer","c"=>"customername,Vendor Name,b,a|customerid,Vendor ID,s,a",'idcol'=>'cid',"page_title"=>"Vendor Activity Report",'report_type'=>2,'filter'=>"type=2 $_wd ","form_sort_col"=>"date,tid","form_table"=>'transactions',"form_idcol"=>'tid',"form_filter"=>"cid","form_credit"=>"amount_due","form_debit"=>"amount_paid","form_condition"=>"sub<>0");
		$param["vendorActivity"]["_form"]="date,date(date),Date,i,s,k|reference,ref,Reference,i,s,k|description,description,Description,i,s,k|customername,customer,Vendor Name,i,s,k|warehouse,warehouse,Location,i,s,k";
		$param["vendorActivity"]['extra']["coldesc"]=array("Debit","Credit","Balance");
	// Vendor Activity Ends here
// Job Order Report starts here
	$param["joborderReport"]=array("t"=>"joborder",'idcol'=>'jid',"sort_col"=>"joborderid","page_title"=>"Job Order Report",'report_type'=>0,"group"=>"itemid","condition"=>"","noTrans"=>1);
	$param["joborderReport"]["_form"]="joborderid,joborderid,Job Order ID,v,i,s,k|itemid,itemid,Item,v,i,s,k|customer_name,customer_name,Customer Name,v,i,s,k|current_balance,count(*),Quantity,v,i,s,k|description,description, Description,v,i,s,k";
	$param["joborderReport"]["group_others"]="city,City|state,State|country,Country|zipcode,Zip Code|sales_representative_id,Sales Representative|ship_via,Ship Via|type,Customer Type|prospect,Prospect|referal,Referal|inactive,Inactive";
	$param["joborderReport"]["group_filter"]="customerid,Customer ID,r,customer|type,Customer Type,s,customerType|current_balance,Current Balance,i,";
	$param["joborderReport"]["graphCol"]="quantity,Quantity,|amount,Amount,N";
	// Job Order report ends here
 //Asset Report starts here
	$param["assetReport"]=array("t"=>"item",'idcol'=>'tid',"sort_col"=>"tid","page_title"=>"Asset Report",'report_type'=>0,"group"=>"itemid","condition"=>"asset_type=2","noTrans"=>1);
	$param["assetReport"]["_form"]="itemid,itemid,Item,v,i,s,k|description,description,Description,v,i,s,k|unit_cost,unit_cost, Unit Cost,v,n,s,k|price1,price1, Depreciation,v,n,s,k|dep_balance,sum((month('$curdate')-month(date_purchased)+1)*price1*unit_cost/1200),Depreciation Value,v,n,s,k|current_balance,sum(unit_cost - (month('$curdate')-month(date_purchased)+1)*price1*unit_cost/1200),Current Value,v,n,s,k";
	$param["assetReport"]["group_others"]="item_type,Item Type|inactive,Inactive";
	$param["assetReport"]["group_filter"]="item_type,Item Type,r,productType";
	$param["assetReport"]["graphCol"]="current_value,Current Value,|unit_cost,Unit Cost,N";
	// Asset report ends here
	
?>