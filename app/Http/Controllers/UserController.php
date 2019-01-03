<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController{
	public function home(){
		$user = Auth::user();
		// $books = Book::where('user_id','=',$user->id)->get();

		
		$books = Book::get();

		return View::make('home',compact('user'), compact('books'));
	}

	public function getLogin(){
		return View::make('login');
	}

	public function postLogin(){
		$rules = array(
			'username' => 'required',
			'password' => 'required|min:4'
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('login')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'username' =>Input::get('username'),
				'password' =>Input::get('password')
			);

			$remember = Input::has('remember') ? true: false;

			if(Auth::attempt($userdata,$remember)){
				return Redirect::route('home');
			} else{
				return Redirect::to('login')->with('message','Invalide username/password combination')->with('alert-class','alert-danger');
			}
		}
	}

	public function getRegister(){
		return View::make('register');
	}

	public function postRegister(){
		$validator = User::validate(Input::all());

		if($validator->passes()){
			User::create(
				array(
					'username'=>Input::get('username'),
					'email'=>Input::get('email'),
					'password'=>Input::get('password'),
					)
				);
			
			return Redirect::to('login')->withMessage('You have successfully registered!');
		}

		return Redirect::to('register')->withErrors($validator);
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('login')->with('message', 'You have successfully logged out!');
	}

	public function postBorrow($book_id, $boolean){
		$user = Auth::user();
		$books = Book::find($book_id);


		if($boolean=='true'){
			$books->user_id = $user->id;
		} else{
			$books->user_id = 0;
		}

		$books->save();
		return Redirect::route('home');
	}

	public function getAddBook(){
		return View::make('addbook');
	}

	public function postAddBook(){
		$validator = Book::validate(Input::all());

		if($validator->passes()){
			Book::create(
				array(
					'title'=>Input::get('title'),
					'writer'=>Input::get('writer'),
					'user_id'=>0,
					)
				);
			
			return Redirect::to('addbook')->withMessage('You have added a new book to the library!');
		}

		return Redirect::to('addbook')->withErrors($validator);
	}
}