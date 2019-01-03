@extends ('layout.main')

@section('content')
<h2 style="text-align:center;">New Book</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			{{Form::open(array('url'=>'/addbook','method'=>'post'))}}
			<div class="form-group">
				{{Form::label('title','Title')}}
				{{Form::text('title',null,array('class'=>'form-control'))}}

				@if($errors->has('title'))
					{{$errors->first('title')}}
				@endif
			</div>
            <div class="form-group">
				{{Form::label('writer','Writer')}}
				{{Form::text('writer',null,array('class'=>'form-control'))}}

				@if($errors->has('writer'))
					{{$errors->first('writer')}}
				@endif
			</div>
			{{Form::submit('Add Book', array('class'=>'btn btn-primary'))}}
		</div>
		{{Form::close()}}
	</div>
@stop