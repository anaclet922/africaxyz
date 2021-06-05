<?php
	include 'config.php';

	$amount = isset($_POST['amount']) == true ? $_POST['amount'] : 0;
	$custom_amount = isset($_POST['custom_amount']) == true ? $_POST['custom_amount'] : 0;

	$amount_ = 0;
	if($custom_amount != 0 && $custom_amount > 0){
		$amount_ = $custom_amount;
	}else{
		if($amount != 0 && $amount > 0){
			$amount_ = $amount;
		}else{
			echo '<script>location.href="'. $base_url .'?error=zero"</script>';
		}
	}

	$amount_ = (int) $amount_;

	if(!is_int($amount_)){
			echo '<script>location.href="'. $base_url .'?error=nun"</script>';
	}


	if(isset($_POST['fees'])){
		if($_POST['fees'] == 'yes'){
			$amount_ = $amount_ + ($amount_ * 5 / 100);
		}
	}

		$start=mt_rand();
		$tx_ref = uniqid(srand($start), true);
		$callbackUrl= $base_url . "/payment_callback_flutterwave.php";
		

		$request = [
            'tx_ref' => $tx_ref,
            'amount' => $amount_,
            'currency' => 'RWF',
            'payment_options' => 'card',
            'redirect_url' => $callbackUrl,
            'customer' => [
                'email' => 'a.anaclet920@gmail.com',// I would use $_POST['email']...
                'name' =>  'Anonymous Anaclet', // as no form to enter names exists
            ],
            'meta' => [
                'price' => $amount_
            ],
            'customizations' => [
                'title' => $web_title,
                'description' => $site_desc,
                'logo' => $logo
            ]
        ];

		

	    $flutterwave_secrety_key = $flutterwave_keys['flutterwave_secret_key'];

	    $curl = curl_init();

	    curl_setopt_array($curl, array(
	    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => '',
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 0,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => 'POST',
	    CURLOPT_POSTFIELDS => json_encode($request),
	    CURLOPT_HTTPHEADER => array(
	        'Authorization: Bearer ' . $flutterwave_secrety_key,
	        'Content-Type: application/json'
	         ),
	    ));


	    $response = curl_exec($curl);

	    curl_close($curl);
	    
	    $res = json_decode($response);
	    if($res->status == 'success'){   
	        $link = $res->data->link;
	        header('Location: '.$link);
	    }
	    else{	    	
			echo '<script>location.href="'. $base_url .'?error=canceled"</script>';
	    }


?>