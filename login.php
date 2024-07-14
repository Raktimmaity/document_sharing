<?php
session_start();
include ('./db_connect.php');
?>
<?php include ('./header.php'); ?>
<?php
if (isset($_SESSION['login_id']))
	header("location:index.php?page=home");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | DocShare</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<div class="h-screen flex">
		<img class="hidden lg:block w-1/2"
			src="https://img.freepik.com/free-vector/access-control-system-abstract-concept_335657-3180.jpg?t=st=1714302790~exp=1714306390~hmac=f89ddc107240d11dac33f9dc16ff0ede0fa61739948a4c49d73ffd63ffec7508&w=740"
			alt="image" />
		<div class="flex flex-col justify-center items-center w-full lg:w-1/2">
			<div>
				<div class="text-xl font-bold text-center lg:text-left">
					<span class="text-blue-600">&#9650</span>
					<span>Login</span>
				</div>
				<div class="mt-10 font-bold text-3xl lg:text-left">
					<h2>Welcome, to</h2>
					<h2>DocShare</h2>
				</div>
				<form class="mt-10 w-[80%] lg:w-96 mx-auto space-y-4" id="login-form">
					<h4>Login to manage your account</h4>
					<input type="email" name="email" class="border w-full px-4 py-2 outline-none" placeholder="Email" />
					<input type="password" name="password" class="border w-full px-4 py-2 outline-none"
						placeholder="Password" />
					<!-- <div class="text-blue-600 hover:text-blue-400 cursor-pointer">
						Forgot your password
					</div> -->
					<button type="submit" class="w-full mt-2 bg-blue-600 py-2 rounded text-white outline-0 hover:bg-blue-700">
						Login
					</button>
					<!-- <div class="text-center space-y-4 mt-4"> -->
						<!-- <span>OR</span> -->
						<!-- <div class="flex gap-8 justify-center items-center">
							<i class="fa-brands fa-facebook"></i>
							<i class="fa-brands fa-google"></i>
							<i class="fa-brands fa-instagram"></i>
						</div> -->
						<!-- <div class="mt-4 text-sm text-center">
							don't have an account?
							<span class="text-sm text-blue-600 hover:text-blue-400 cursor-pointer"><a href="./register.php">Sign Up here</a> </span>
						</div> -->
					<!-- </div> -->
				</form>
			</div>
		</div>
	</div>
	<script>
		$('#login-form').submit(function (e) {
			e.preventDefault()
			$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
			if ($(this).find('.alert-danger').length > 0)
				$(this).find('.alert-danger').remove();
			$.ajax({
				url: 'ajax.php?action=login',
				method: 'POST',
				data: $(this).serialize(),
				error: err => {
					console.log(err)
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

				},
				success: function (resp) {
					if (resp == 1) {
						location.href = 'index.php?page=home';
					} else {
						$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
						$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
					}
				}
			})
		})
		$('.number').on('input', function () {
			var val = $(this).val()
			val = val.replace(/[^0-9 \,]/, '');
			$(this).val(val)
		})
	</script>
</body>

</html>