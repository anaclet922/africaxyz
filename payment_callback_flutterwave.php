<?php
	include 'config.php';

	if($_GET['status'] == 'cancelled'){
			echo '<script>location.href="'. $base_url .'?error=cancelled"</script>';
    }else if($_GET['status'] == 'successful'){

    	 $txid = $_GET['transaction_id'];

	    $flutterwave_secrety_key = $flutterwave_keys['flutterwave_secret_key'];

       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/". $txid ."/verify",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $flutterwave_secrety_key 
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        if($response['status'] == 'success'){        	
			echo '<script>location.href="'. $base_url .'?error=donated"</script>';
        }	

    }
