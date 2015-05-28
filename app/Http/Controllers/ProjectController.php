<?php namespace App\Http\Controllers;

use Request;
use App\User;
use App\Blog;
use Session;
use DB;
use Hash;

class ProjectController extends Controller {

	public function getIndex() {
		$clubs = ['improv'=>'Improv Club', 'four_square'=>'Four Square Club', 'MXTalks'=>'MX Talks', 'comp_sci_club'=>'Comp Sci Club', 'math_club'=>'Math Club', 'pot_club'=>'Pottery Club', 'chem_club'=>'Chemistry Club', 'MXTV'=>'MXTV', 'anvil'=>'Anvil', 'artemis_society'=>'Artemis Society', 'fishing_club'=>'Fishing Club', 'literary_appreciation'=>'Lit. Club', 'astronomy'=>'Astronomy Club', 'mindfulness'=>'Mindfulness'];
		$blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
		return view('index')->with('clubs',$clubs)->with('blogs',$blogs);
	}
	
	public function getSignUp() {
		$error = "";
		$firstName = "";
		$lastName = "";
		$email = "";
		$username = "";
		$password = "";
		$cpassword = "";
		if(Session::get('username')) {
			Session::forget('username');
		}
		return view('signup')->with('error',$error)->with('firstName',$firstName)->with('lastName',$lastName)->with('email',$email)->with('username',$username)->with('password',$password)->with('cpassword',$cpassword);
	}
	public function postSignUp() {
		$clubs = ['improv'=>'Improv Club', 'four_square'=>'Four Square Club', 'MXTalks'=>'MX Talks', 'comp_sci_club'=>'Comp Sci Club', 'math_club'=>'Math Club', 'pot_club'=>'Pottery Club', 'chem_club'=>'Chemistry Club', 'MXTV'=>'MXTV', 'anvil'=>'Anvil', 'artemis_society'=>'Artemis Society', 'fishing_club'=>'Fishing Club', 'literary_appreciation'=>'Lit. Club', 'astronomy'=>'Astronomy Club', 'mindfulness'=>'Mindfulness'];
		$error = "";
		$firstName = Request::input('fname');
		$lastName = Request::input('lname');
		$email = Request::input('email');
		$username = Request::input('username');
		$password = Request::input('password');
		$cpassword = Request::input('cpassword');
		$users = DB::table('users')->get();
		$errors = false;
		if($firstName == "" || $lastName == "" || $email == "" || $username == "" || $password == "") {
			$error = "Please fill in all fields.";
			$errors = true;
		}
		elseif(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$error = "Please use a valid email.";
			$errors = true;
		}
		elseif(in_array($username, $users)) {
			$error = "User already exists.";
			$errors = true;
		}
		elseif(strlen($password) < 6) {
			$error = "Your password must be at least 6 letters.";
			$errors = true;
		}
		elseif(!(preg_match('#[0-9]#', $password)) || !(preg_match('#[a-zA-Z]#', $password))) {
			$error = "Your password must contain a letter and a number.";
			$errors = true;
		}
		elseif(!($password == $cpassword)) {
			$error = "Please make sure your passwords match.";
			$errors = true;
		}
		
		if(!$errors) {
			$blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
			Session::set('username',$username);
			$passhash = Hash::make($password);
			$user = new User;
			$user->firstName = $firstName;
			$user->lastName = $lastName;
			$user->email = $email;
			$user->username = $username;
			$user->password = $passhash;
			
			$user->push();
			
			return redirect('/');
		}
		else{
			return view('signup')->with('error',$error)->with('firstName',$firstName)->with('lastName',$lastName)->with('email',$email)->with('username',$username)->with('password',$password)->with('cpassword',$cpassword);
		}
		
		
	}
	
	public function getLogIn() {
		$error = "";
		if(Session::get('username')) {
			Session::forget('username');
		}
		return view('login')->with('error',$error);
	}
	
	public function postLogIn() {
		$clubs = ['improv'=>'Improv Club', 'four_square'=>'Four Square Club', 'MXTalks'=>'MX Talks', 'comp_sci_club'=>'Comp Sci Club', 'math_club'=>'Math Club', 'pot_club'=>'Pottery Club', 'chem_club'=>'Chemistry Club', 'MXTV'=>'MXTV', 'anvil'=>'Anvil', 'artemis_society'=>'Artemis Society', 'fishing_club'=>'Fishing Club', 'literary_appreciation'=>'Lit. Club', 'astronomy'=>'Astronomy Club', 'mindfulness'=>'Mindfulness'];
		$username = Request::input('username');
		$password = Request::input('password');
		if(!$username || !$password) {
			$error = "Please fill in all fields";
			return view('login')->with('error',$error);
		}
		else {
			$userArray = DB::table('users')->where('username',$username)->get();
			if(!$userArray){
				$error = "Incorrect Username and Password Combination";
				return view('login')->with('error',$error);
			}
			else {
				$user = $userArray[0];
				$dbpassword = $user->password;
				if(!Hash::check($password, $dbpassword)) {
					$error = "Incorrect Username and Password Combination";
					return view('login')->with('error',$error);
				}
				else {
					Session::set('username',$username);
					$blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
					return redirect('/');
				}
			}
		}
	}
	
	public function getNew() {
		if(!Session::get('username')) {
			$error = "Please log in before you post";
			return view('login')->with('error',$error);
		}
		else {
			$error = "";
			$subject = "";
			$content = "";
			$link = "";
			return view('newpost')->with('link',$link)->with('error',$error)->with('subject',$subject)->with('content',$content);
		}
	}
	
	public function postNew() {
		$link = Request::input('link');
		$club = Request::input('club');
		$subject = Request::input('post_name');
		$content = Request::input('post');
		$user = Session::get('username');
		if(!$subject || !$content) {
			$error = "Please fill in all fields";
			return view('newpost')->with('link',$link)->with('error',$error)->with('subject',$subject)->with('content',$content);
		}
		else {
		    $blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
			$blog = new Blog;
			$blog->club = $club;
			$blog->link = $link;	
			$blog->user = $user;
			$blog->subject = $subject;
			$blog->content = $content;
			$blog->push();
			
			return redirect('/');
		}
	}
	
	public function logout() {
		if(Session::get('username')) {
			Session::forget('username');
		}
		$blogs = DB::table('blogs')->orderBy('created_at', 'desc')->get();
		return redirect('/');
	}
	
	
	/*************************************
	 *This is really bad! Separate this in
	 *the future into it's own class.
	**************************************/

	
}