<?php
function money($number){
	return '&#8358;'.number_format($number,2);
}
function sanitize($dirty){
	return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}
function dnd($var){
	echo "<pre" . var_dump($var). "</pre>";
}
function display_errors($errors){
	$display = "";
	echo "<div style='position:absolute'>";
	foreach($errors as $error){
			$display .= "<div class='alert alert-success alert-dismissible' style='absolute'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>".$error."</strong></div>"; // class="text-white"
		}
		echo "</div>";
		return $display;
	}

	function quest($page, $limit, $questions){
		global $db; $arr = [];
		$no_of_records_per_page =. $limit;
		$offset = ($page-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM questions";
		$result = mysqli_query($db,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		$ctsQ = $db->query("SELECT * FROM questions LIMIT $offset, $no_of_records_per_page");
		while ($row = $ctsQ->fetch_assoc()){
			$row['total'] = $total_pages;
			$arr[] = $row;
		}
		setcookie('total',$total_pages,time()+3600,'/');
		$encoded = json_encode($arr);
		return $encoded;
	}

	function users(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM customer");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$row['total_rows'] = $num;
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function books()
	{
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM content ORDER by date DESC");
		//$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function questions(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM questions ORDER by date DESC");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function questionCodes(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM question_codes ORDER by date DESC");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function comprehension(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM admin where cId = '1'");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function games(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM game where p1_result = '1' or p2_result='1' ORDER by date DESC limit 10");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function publications(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM content ORDER by date DESC");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$row['total'] = $num;
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function genre(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM genre");
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}
	function getGenre($id){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM genre WHERE id = '$id'");
		//$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function get_question($id){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM questions WHERE id = '$id'");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function get_question_code($id){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM question_codes WHERE id = '$id'");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}

	function get_ans($id){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM answers WHERE qu_id = '$id'");
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}
	
	function game(){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM game ORDER by date DESC");
		$num = $ctsQ->num_rows;
		while($row = $ctsQ->fetch_assoc()){
			$arr[] = $row;
		}
		$encoded = json_encode($arr);
		return $encoded;
	}



	function mess($id){
		global $db; $arr=[];$code = "";
		$limit = 5;
		$sql = $db->query("SELECT * FROM message WHERE rid = $id ORDER BY tim DESC LIMIT $limit");
		if ($sql->num_rows > 0) {
			while ($row = $sql->fetch_assoc()){
				$arr[]= $row;
			}
			$code = json_encode($arr);
			return $code;
		}
	}
	function dashmess(){
		global $db; $arr=[];$code = "";
		$sql = $db->query("SELECT * FROM message WHERE rid ='0' ORDER BY tim DESC");
		if ($sql->num_rows > 0) {
			while ($row = $sql->fetch_assoc()){
				$arr[]= $row;
			}
			$code = json_encode($arr);
		}
		return $code;
	}
	function package($package){
		global $db; $arr = [];
		$ctsQ = $db->query("SELECT * FROM customer where type  = '$package'");
		$num = $ctsQ->num_rows;
		$arr[] = $num;
		$encoded = json_encode($arr);
		return $encoded;
	}

	function ans($id){
		global $db; $arr = [];$total_ans;$d = [];$dd = '';
		$offset = 4;
		$ctsQ = $db->query("SELECT * FROM questions WHERE question = '$id'");
		if ($ctsQ->num_rows > 0) {
			while ($row = $ctsQ->fetch_assoc()){
				$dd = $row['id'];
			}
			$ctsQ = $db->query("SELECT * FROM answers WHERE qu_id = '$dd'");
			while ($row = $ctsQ->fetch_assoc()){
				$d[] = $row;
			}
		}
		
		$encoded = json_encode($d);
		return $encoded;
	}

	// str_replace(search, replace, subject)
	function get_page_identifier_from_url(){
		$request = str_replace(basename(dirname(ROOT)), '', $_SERVER['REQUEST_URI']);
		$parts = explode('/', $request);
		// print_r($parts);die();
		foreach($parts as $key=>$value){
			if(empty($value)){
				unset($parts[$key]);
			}
		}
		if(count($parts) > 1){
			return false;
		}
		$identifier = array_pop($parts);
		if(empty($identifier)){
			$identifier = 'home';
		}
		return $identifier;
	}
	// ______________________________________________
	
	function tpGetNav(){
		global $db;$nav=[];
		$pSql = $db->query("SELECT * FROM category_type WHERE parent=0 AND category = 2");
		while($parentFetch = $pSql->fetch_assoc()){
			$id = intval($parentFetch['typeid']);
			$child_links = [];
			$childQ = $db->query("SELECT * FROM category_type WHERE parent='{$id}' and category=2");
			while($childFetch = $childQ->fetch_assoc()){
				$child_links[] = $childFetch;
			}
			if(count($child_links)){$parentFetch['child'] = $child_links;}
			$nav[] = $parentFetch;
		}
		$parentJson = json_encode($nav);
		return $parentJson;
	}
	function getCrumbs($id){
		global $db;$nav=[];
		$pSql = $db->query("SELECT name FROM category_type WHERE name = '$id'");
		$parentFetch = $pSql->fetch_assoc();
		$nav[] = $parentFetch;
		$parentJson = json_encode($nav);
		return $parentJson;
	}
	function get_categories($child){
		global $db; $prepEnc = [];
		$limit = 12;
		$cat_id = (int)sanitize($child);
		$ctsQ = $db->query("SELECT * FROM item WHERE categories = '{$cat_id}' LIMIT $limit");
		while ($row = $ctsQ->fetch_assoc()){
			$row['picture'] = json_decode($row['picture']);
			$prepEnc[] = $row;
		}
		$encoded = json_encode($prepEnc);
		return $encoded;
	}
	function get_product($product_id){
		global $db;$pArray=[];
		$prod_id = (int)$product_id;
		$pQ=$db->query("SELECT * FROM item WHERE pcategories='{$prod_id}'");
		while($prodFetch=$pQ->fetch_assoc()){
			$pBrand_id=$prodFetch['brand'];
			$brandQ=$db->query("SELECT * FROM category_type WHERE typeid='$pBrand_id'");
			$brandFetch=$brandQ->fetch_assoc();
			$prodFetch['brand']=$brandFetch['name'];
			$prodFetch['picture']=json_decode($prodFetch['picture']);
			$pArray[] = $prodFetch;
		}
		$pJson = json_encode($pArray);
		return $pJson;
	}
	function sget_categories($id, $limit, $page){ // $child
		global $db; $prepEnc = []; $where = ''; $total = [];
		if($id){
			preg_replace("/[^a-zA-Z]/", " ", $id);
			$where = "WHERE item_type='{$id}'";
		}
		$no_of_records_per_page = $limit;
		$offset = ($page-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM item $where";
		$result = mysqli_query($db,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		$ctsQ = $db->query("SELECT * FROM item $where AND publish='0' ORDER BY date_created DESC LIMIT $offset, $no_of_records_per_page" );
		while ($row = $ctsQ->fetch_assoc()){
			$row['total'] = $total_pages;
			$row['picture'] = json_decode($row['picture']);
			$prepEnc[] = $row;
		}
		$encoded = json_encode($prepEnc);
		return $encoded;
	}
	function get_products($product_id){
		global $db;$dArray=[];
		$prod_id = $product_id;
		$limit = 4;
		$pQ=$db->query("SELECT * FROM item WHERE item_type='{$prod_id}' AND publish='0' LIMIT $limit");
		while($prodFetch=$pQ->fetch_assoc()){
			$prodFetch['picture']=json_decode($prodFetch['picture']);
			$dArray[] = $prodFetch;
		}
		$pJson = json_encode($dArray);
		return $pJson;
	}
	function get_recommended(){
		global $db;$dArray=[];
		$limit = 4;
		$pQ=$db->query("SELECT * FROM item ORDER BY date_created DESC LIMIT $limit");
		while($prodFetch=$pQ->fetch_assoc()){
			$pBrand_id=$prodFetch['brand'];
			$brandQ=$db->query("SELECT * FROM category_type WHERE typeid='$pBrand_id'");
			$brandFetch=$brandQ->fetch_assoc();
			$prodFetch['brand']=$brandFetch['name'];
			$prodFetch['picture']=json_decode($prodFetch['picture']);
			$dArray[] = $prodFetch;
		}
		$pJson = json_encode($dArray);
		return $pJson;
	}
	function product_details($product_id){
		global $db;$cArray=[];
		$prod_id = (int)$product_id;
		$pQ=$db->query("SELECT * FROM item WHERE tid='{$prod_id}'");
		while($prodFetch=$pQ->fetch_assoc()){
			$pBrand_id=$prodFetch['pcategories'];
			$pBrand_id2=$prodFetch['categories'];
			$brandQ=$db->query("SELECT * FROM category_type WHERE parent='$pBrand_id'");
			$brandFetch=$brandQ->fetch_assoc();
			$prodFetch['brand']=$brandFetch['name'];
			$prodFetch['picture']=json_decode($prodFetch['picture']);
			$cArray[] = $prodFetch;
		}
		$pJson = json_encode($cArray);
		return $pJson;
	}
	function cart_num($cart_items){ //echo array_sum(array_column($_SESSION['products'], 'p_qty'));
	$count_items = json_decode($cart_items,true);
	$sum=0;
	foreach($count_items as $k=>$v){$sum += $v;}
	return $sum;
}
function custLogin($user_id,$remember_me){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE customer SET last_login='$date' WHERE cId='$user_id'");
	if($remember_me === 'on'){
			$rem = array('email'=>$email,'password'=>$pass); // ereteteydsumaioahxiul // ptrsiuaziiswsdwrfoyr6d
			$rem = json_encode($rem);
			$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']: false);
			$T=time()+315360000; //10years time
			setcookie('qblog',$rem,$T,'/',$domain);
		}
		if(isset($_SESSION['cout_login_redir'])){
			unset($_SESSION['cout_login_redir']);
			header('Location: cart.php?checkout=c1v8c3');
		}
		else{
			if (isset($_COOKIE['myShoppingCart'])){
				echo "<script>window.location.replace('checkout.php?order_id=c1v8c3') </script>";
				$_SESSION['success_flash'] = "You are now logged in";
			}else{
				echo "<script>window.location.replace('index.php')</script>";
				$_SESSION['success_flash'] = "You are now logged in";
			}
		}
	}
	function logDir(){
		$logDir = [];
		if(isset($_COOKIE['qblog']) && !empty($_COOKIE['qblog'])){
			$d = json_decode($_COOKIE['qblog']);
		}
		$logDir['mail'] = ((isset($_COOKIE['qblog']))?$d->email:'');
		$logDir['pass'] = ((isset($_COOKIE['qblog']))?$d->password:'');
		$logZip = json_encode($logDir);
		return $logZip;
	}
	function tp_custLogin($user_id){
		$_SESSION['SBUser'] = $user_id;
		global $db;
		$date = date("Y-m-d H:i:s");
		$db->query("UPDATE customer SET last_login='$date' WHERE id='$user_id'");
		// $_SESSION['success_flash'] = "You are now logged in";
		// header('Location: index.php');
	}
	function display_cart(){
		global $db;
		$a=[];
		$sum_total=0;
		$item_count = 0;
		if(isset($_COOKIE['myShoppingCart'])){
			$cart_items = $_COOKIE['myShoppingCart'];
			$cookieQ = json_decode($cart_items, true);
			foreach($cookieQ as $k =>$v){
				$k= $k;
				$item_count += $v['qty'];
				$cartQ = $db->query("SELECT tid, description, price1, picture, quantity_on_hand FROM item WHERE tid='{$v['product']}'") or die($db->error('display_cart_error'));
				if($cartQ->num_rows){
					while($cart_fetch = $cartQ->fetch_assoc()){
						$cart_fetch['brand'] = $bF['name'];
						$cart_fetch['picture'] = json_decode($cart_fetch['picture']);
						$cart_fetch['cart_qty'] = $v['qty'];
						$cart_fetch['k'] = $k;
						$cart_fetch['item_total_price'] = $cart_fetch['price1'] * $cart_fetch['cart_qty'];
						$sub_total[] = $cart_fetch['item_total_price'];
						$a['cart'][] = $cart_fetch;
						$sum_total += $cart_fetch['item_total_price'];
					}
				}
			}
		}
		else{
			$a['cart'] = array();
		}
		$a['item_count']=$item_count;
		$a['sub_total']=$sum_total;
		$q = json_encode($a);
		return $q;
	}
	function display_fav(){
		global $db;
		$a=[];
		if(isset($_COOKIE['FAV_COOKIE'])){
			$cart_items = $_COOKIE['FAV_COOKIE'];
			$cookieQ = json_decode($cart_items, true);
			foreach($cookieQ as $k =>$v){
				$k= (int)$k;
				$cartQ = $db->query("SELECT * FROM item WHERE tid='{$k}'") or die($db->error('display_cart_error'));
				if($cartQ->num_rows){
					while($fav = $cartQ->fetch_assoc()){
						$b_id=$fav['pcategories'];
						$bQ = $db->query("SELECT name FROM category_type WHERE typeid = '{$b_id}'");
						$bF = $bQ->fetch_assoc();
						$fav['brand'] = $bF['name'];
						$fav['picture'] = json_decode($fav['picture']);
						$a[] = $fav;
					}
				}
			}
		}
		else{
			$a['cart'] = array();
		}
		$q = json_encode($a);
		return $q;
	}
	function sub($email){
		global $db;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$mess = 'You must enter a valid email.';
		}else{
			$sub = $db->query("INSERT INTO subscribers (email) VALUES ('$email')");
			if ($sub) {
				toasts('signup success');
			}
		}
	}

	function totalscore($id, $amount)
	{
		global $db;
		$tally = array();
		$d = isset($_SESSION['scores'])?json_decode($_SESSION['scores'], true):0;
		$result = $d;
		foreach($result as $v) { 
			if ($v == '1') {
				$tally[] = $v;
			}
			
		}
		$totaltally = count($tally);
		$amt = (int)$amount/2;
		$p = $db->query("UPDATE customer SET prospect = '$totaltally' WHERE cId = '$id'");
		if ($p == true) {
			$c = $db->query("SELECT * FROM customer WHERE cId = '$id'");
			$row = $c->fetch_assoc();
			$bal = $row['current_balance'];
			$newbal = $bal + ($totaltally * $amount);
			$p = $db->query("UPDATE customer SET current_balance = '$newbal' WHERE cId = '$id'");
		}	
		return $totaltally;
	}

	function get_cust(){
		global $db;
		$cid = isset($_COOKIE['uid'])?$_COOKIE['uid']:$cid = "";
		$uQ = $db->query("SELECT * FROM customer WHERE cId='{$cid}'");
		$cust = $uQ->fetch_assoc();
		$c=[];
		$c['cout_tid'] = ((isset($_COOKIE['uid']))?$cust['cId']:'');
		$c['cout_fname'] = ((isset($_COOKIE['uid']))?$cust['ship_to_name']:'');
		$c['cout_email'] = ((isset($_COOKIE['uid']))?$cust['email']:'');
		$c['cout_address1'] = ((isset($_COOKIE['uid']))?$cust['address']:'');
		$c['cout_shipping'] = ((isset($_COOKIE['uid']))?$cust['ship_to_address1']:'');
		$c['cout_phone'] = ((isset($_COOKIE['uid']))?$cust['telephone']:'');
		$c['cout_city'] = ((isset($_COOKIE['uid']))?$cust['city']:'');
		$c['cout_state'] = ((isset($_COOKIE['uid']))?$cust['state']:'');
		$c['cout_country'] = ((isset($_COOKIE['uid']))?$cust['country']:'');
		$c['cout_pass'] = ((isset($_COOKIE['uid']))?$cust['customer_password']:'');
		$c['bal'] = ((isset($_COOKIE['uid']))?$cust['current_balance']:'');
		$c['prospect'] = ((isset($_COOKIE['uid']))?$cust['prospect']:'');
		$c['ref'] = ((isset($_COOKIE['uid']))?$cust['transcid']:'');
		$c['bonus'] = ((isset($_COOKIE['uid']))?$cust['clientid']:'');
		$c['benchmark'] = ((isset($_COOKIE['uid']))?$cust['due_days']:'');
		$c['picture'] = ((isset($_COOKIE['uid']))?$cust['picture']:'');
		return json_encode($c);
	}

	function get_cust1($id){
		global $db;
		$uQ = $db->query("SELECT * FROM customer WHERE cId='$id'");
		$cust = $uQ->fetch_assoc();
		$c=[];
		$c[] = $cust;
		return json_encode($c);
	}
	
	function user_data(){
		if(isset($user_data)){
			$user_data = $user_data['first'];
		}
		return $user_data;
	}
	function is_logged_in(){
		if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
			return true;
		}else{
			return false;
		}
	}
	function login_error_redirect(){
		e_msg("You have no permission to access that page yet.");
		header('Location:login.php');
	}
	function crm($crm){
		if(isset($_COOKIE['myShoppingCart'])){
			$ck = json_decode($_COOKIE['myShoppingCart'],true);
			foreach($ck as $k=>$v){
				if($k == $crm){
					unset($ck[$crm]);
					$ck = json_encode($ck);
					$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']: false);
					setcookie('myShoppingCart',$ck,myShoppingCart_EXPIRE,'/',$domain,false);
					header('Location:cart.php?removed=91vgdhg345682');
				}
				if(empty($k)){
					setcookie('myShoppingCart',"",1,'/',$domain,false);
					header('Location:cart.php?removed=91vgdhg345682');
					die();
				}
			}
			// header('Location: cart.php');
			if(empty($_COOKIE['myShoppingCart'])){
				$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']: false);
				setcookie('myShoppingCart','',time()-60*60,'/',$domain,false);
			}
		}
		if(isset($_COOKIE['myShoppingCart']) && empty($_COOKIE['myShoppingCart'])){
			$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']: false);
			setcookie('myShoppingCart','',time()-60*60,'','','',$domain,false);
		}
	}
	function show_search($search, $limit, $page){
		$ss = [];
		global $db;
		$where = " WHERE itemID LIKE '%".$search."%' OR description LIKE '%".$search."%' OR sales_desc LIKE '%".$search."%'";
		$no_of_records_per_page = $limit;
		$offset = ($page-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM item $where";
		$result = mysqli_query($db,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$sQ = "SELECT * FROM item";
		if(!empty($search)){
			$sQ .= " WHERE itemID LIKE '%".$search."%' OR description LIKE '%".$search."%' OR sales_desc LIKE '%".$search."%' ORDER BY date_created DESC LIMIT ".$offset.", ".$no_of_records_per_page;
		}
		$query = $db->query($sQ);
		if($query->num_rows >0){
			while($fetch = $query->fetch_assoc()){
				$fetch['total'] = $total_pages;
				$fetch['picture'] = json_decode($fetch['picture']);
				$fetch['cname'] = json_decode($fetch['pcategories']);
				$ss[] = $fetch;
			}
		}
		return json_encode($ss);
	}
	
	function c_out_err_log(){
		$_SESSION['cout_login_redir'] = 'yes';
	}
	function botAgent(){
		$uagent = $_SERVER['HTTP_USER_AGENT'];
		$regx = '/\/[a-zA-Z0-9.]+/';
		$newString = preg_replace($regx, '', $uagent);
		echo $newString;
	}
	function pc_out_clean(){
		if(isset($_SESSION['pc_yes'])){
			unset($_SESSION['pc_yes']);
		}
	}
	function isCat(){
		if(isset($_COOKIE['myShoppingCart']) && !empty($_COOKIE['myShoppingCart'])){
			return true;
		}return false;
	}
	function trans_redir(){
		if(isset($_SESSION['user'.$user_id])){
			return true;
		}
		else{return false;}
	}
	function transBack(){
		header('Location:cart.php');
	}
	function update_password($id, $op, $np, $np2){
		//echo $id; die();
		global $db;
		$message = "";
		$errors = [];
		$sql = $db->query("SELECT customer_password from customer WHERE cId = '$id'");
		$pass = $sql->fetch_assoc();
		$hash = $pass['customer_password'];
		if(password_verify($op, $hash)){
			if(strlen($np) < 6){
				$errors[] = 'Your password must be up to six characters or more';
			}else if(strlen($np2) < 6){
				$errors[] = 'Your Confirm password must be up to six characters or more';
			}else if($np !== $np2){
				$errors[] = "Your two passwords do not match";
			}else{
				$hashed = password_hash($np, PASSWORD_DEFAULT);
				$sql = $db->query("UPDATE customer SET customer_password = '$hashed' WHERE cId = '$id'");
				if($sql){
					$message = 'Saved Sucessfully';
				} else{
					$message = $db->error;
				}
			}
		}else{
			$errors[] = "Password entered is incorrect";
		}
	}