@extends('_master')

@section('head')
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
@stop

@section('content')
	<form id="logIn" method="post" action="/login">
		<h3>Log in to your account</h3> 
		<table class="log">
			<tr>
				<td><label>Username:</label></td> 
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td><label>Password:</label></td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="submit" value="Log In"/></td>
			</tr>
		<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</table>
	</form>
		<div class="error">
			@if($error)
				{{$error}}
			@endif
		</div>
@stop
