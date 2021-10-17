<?php
		require_once "../database/connect.php";
		$company_name="";
		$n_cols="name,logo_ref,website,sms_sender,email,email_sender,sms_acount_name,sms_acount_password";
		$query="select $n_cols from company_info where name !='' LIMIT 1";
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			foreach($row as $k => $v)
			{
				${"company_".$k}=$v;
			}
		}else
		{
			$pcol=explode(",",$n_cols);
			foreach($pcol as $k => $v)
			{
				${"company_".$v}="";
			}
		}
		if(empty($company_sms_sender)) $company_sms_sender="Dreams ICT";
		if(empty($company_email_sender)) $company_email_sender="Dreams ICT";
		$con=array($company_sms_acount_name,$company_sms_acount_password);
		$result->free();		

?>