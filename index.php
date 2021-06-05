<?php
	include 'config.php';
 ?>
<!DOCTYPE html>v
<html>
<head>
	<meta charset="utf-8">
	<title>Donation Page</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h3 class="text-center">How much do you want to donate?</h3>
				<hr>
				<?php
					if(isset($_GET['error'])){
						if($_GET['error'] == 'zero'){
							?>
						<p class="alert alert-danger">
							You can't donate zero francs!!
						</p>
				<?php		
						}elseif($_GET['error'] == 'cancelled'){
							?>
						<p class="alert alert-danger">
							Payment canceled!; Try again if you want!
						</p>
				<?php
						}elseif($_GET['error'] == 'nun'){
							?>
						<p class="alert alert-danger">
							Amount must be number!
						</p>
				<?php
						}elseif($_GET['error'] == 'donated'){
							?>
						<p class="alert alert-success">
							Thank you for your donation! 
						</p>
				<?php
						}

					}
				 ?>
				<form class="form" method="post" action="<?= $base_url ?>/pay.php" id="donation_form_id">
					<div class="row">
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_10" value="10"><label for="amount_10">Rwf 10</label></div>
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_25" value="25"><label for="amount_25">Rwf 25</label></div>
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_50" value="50"><label for="amount_50">Rwf 50</label></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_100" value="100"><label for="amount_100">Rwf 100</label></div>
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_250" value="250"><label for="amount_250">Rwf 250</label></div>
						<div class="col-md-4">
					<input type="radio" name="amount" id="amount_500" value="500"><label for="amount_500">Rwf 500</label></div>
					</div>

					<br>

					<div class="row">
						<div class="col-md-12">
							<input type="number" name="custom_amount" placeholder="Name your amount, maybe 44.." class="form-control">
						</div>
					</div>
					<br>
					<input type="checkbox" name="fees" value="yes"><label>I'll cover transaction fees</label>
					<br><br>
					<button class="btn btn-primary" type="submit">Donate</button>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>


	<style type="text/css">
		input, label{
			font-size: 17px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){

			// $('#donation_form_id').on('submit', function(e){
			// 	e.preventDefault();

			// });

		});
	</script>
</body>
</html>