<!DOCTYPE html>
<html>
<head>
	<title>programmerPrep</title>
</head>

@extends('layouts.master')
	@section('content')




<body id="landingBody">
	<div class="container"> 
		<div class="whiteBox">			
			<div class="title"> programmerPrep </div>
			<p class="definition"> defintion defintion defintion defintion defintion defintion defintion defintion defintion defintion defintion</p>

			<!-- login -->
			<form method="POST" id="signupForm">
			<div class="loginField">
				<input id="username" name="username" type="text" Placeholder="username"><br>
        		<input id="password" name="password" type="password" placeholder="password"></br>
        		<div class="registration">
		    		<input id="confirmPassword" name="confirmPassword" type="password" placeholder="confirmPassword"></br>
          			<input id="email" name="email" type="email" placeholder="emailAddress">
          		</div>
          			<div class="loginFormButtons">
        				<button type="button" id="registerButton" class="loginFormButton">Register</button>
        				<button type="submit" id="loginButton" class="loginFormButton">Login</button>
      				</div>
          	</form>
          


	<!-- wide ruled written @ bototm of page in div/css style -->
	<script>
	$("#registerButton").click(function() {
    	$(".registration").slideToggle("invisible");
			// Toggle Register/Un-Register
    		$(this).text(function(i,v) {
        		return v === 'Oops' ? 'Register' : 'Oops'
    		});
	});
	</script>
@stop

