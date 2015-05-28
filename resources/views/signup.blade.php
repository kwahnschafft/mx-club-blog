@extends('_master')

@section('content')
    <form id="signUp" method="post" action="/signup">
        <h3>Sign up for an account</h3>
        <table class="log">
            <tr>
                <td><label>First Name:</label></td>
                <td><input type="text" name="fname" value="{{$firstName}}"/></td> 
            </tr>
            <tr>
                <td><label>Last Name:</label></td>
                <td><input type="text" name="lname" value="{{$lastName}}"/></td> 
            </tr>
            <tr>
                <td><label>Email:</label></td>
                <td><input type="text" name="email" value="{{$email}}"/></td> 
            </tr>
            <tr>
                <td><label>Username:</label></td>
                <td><input type="text" name="username"  value="{{$username}}"/></td> 
            </tr>
            <tr>
                <td><label>Password:</label></td>
                <td><input type="password" name="password" value="{{$password}}"/></td> 
            </tr>
            <tr>
                <td><label> Confirm Password:</label></td>
                <td><input type="password" name="cpassword" value="{{$cpassword}}"/></td> 
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="submit" value="Sign Up"/></td>
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