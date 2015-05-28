@extends('_master')

@section('head')
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
@stop

@section('content')
	<form method="post" action="/">
	<label>Club Name:</label>
	    <select name="club">
		<option value="improv">Improv Club</option>
		<option value="four_square">Four Square Club</option>
		<option value="MXTalks">MX Talks</option>
		<option value="comp_sci_club">Computer Science Club</option>
		<option value="math_club">Math Club</option>
		<option value="pot_club">Pottery Club</option>
		<option value="chem_club">Chemistry Club</option>
		<option value="MXTV">MXTV</option>
		<option value="anvil">Anvil</option>
		<option value="artemis_society">Artemis Society</option>
		<option value="fishing_club">Fishing Club</option>
		<option value="literary_appreciation">Literary Appreciation Club</option>
		<option value="astronomy">Astronomy Club</option>
		<option value="mindfulness">Mindfulness Club</option>	
	    </select>
	    <br> <br>
	    <label>Blog Post Name:</label>
	    <input type="text" name="post_name" value="{{$subject}}"/> <br> <br>
	    <label>Blog Post:</label> <br><br>
	    <textarea id="paragraph" type="text" name="post" value="{{$content}}"></textarea> <br> <br>
	    <label>Link to Image (Optional):</label>
	    <input type="text" name="link" value="{{$link}}"/> <br> 
	    <input id="post" type="submit" class="submit" value="Post"/>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        </form>
	<div class="error">
	@if($error)
	    {{$error}}
	@endif
	</div>
@stop
