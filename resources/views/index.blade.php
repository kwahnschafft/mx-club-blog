@extends('_master')

@section('head')
	
@stop

@section('content')
    <div id="navbar">
        <ul>
            <li><input type="checkbox" id="all" value="all"/> <label>All Clubs</label></li>
            <?php $i = 0; ?>
            @foreach($clubs as $club=>$v)
                <li><input class="box" type="checkbox" value="{{$club}}" name="{{$club}}"/>
                <label for="{{$club}}">{{$v}}</label></li>
            <?php $i++; ?>
            @endforeach
        </ul>
    </div>
    @if(Session::get('username'))
        <h2>Welcome, {{Session::get('username')}}.</h2>
    @endif
    
    @foreach($blogs as $blog)
        <div class="new" id="{{$blog->club}}">
            <h3 id="subject">{{$blog->subject}}</h3>
            <hr> 
            <p id="content">{{$blog->content}}</p>
            @if(!(strlen($blog->link) < 1))
                <img class="image" src="{{$blog->link}}"/>
            @endif
            <hr>
            <div id="post-foot">
                <div id="club">{{$clubs[$blog->club]}}</div>
                <div id="user">Posted by: {{$blog->user}}</div>
            </div>
        </div>
    @endforeach
@stop