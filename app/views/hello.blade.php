<h1>Hello World!</h1>
{{ 'test' }}


<form name="input" action="{{ URL::action('CartController@addProduct') }}" method="POST">
Username: <input type="text" name="user">
<input type="submit" value="Submit">
</form>