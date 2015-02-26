@section('title')
Log In
@stop

{{ Form::open(array('action'=>'AbyssalArts\SteamApi\Controllers\AdminController@DoLogin', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Please Log In</h2>
 	<div class="form-group">
 	{{ Form::label('username', 'Username') }}
    {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}
    </div>
    <div class="form-group">
 	{{ Form::label('password', 'Password') }} 
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    </div>
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary'))}}
{{ Form::close() }}