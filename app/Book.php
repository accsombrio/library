<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Book extends Model{
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'writer',
    ];

	public function user(){
		return  $this->belongsTo('App\User');
	}

	public static function validate($input){
        $rules = array(
            'title'=>'required|unique:books',
            'writer'=>'required',

        );
        return Validator::make($input, $rules);
    }
}
