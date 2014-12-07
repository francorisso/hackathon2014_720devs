/**
The purpose of this library is to make easy calls to REST apis from javascript
@depends jquery>1.7
*/
var RESTrequests = {
	get: function(url, params){

	}

	_request: function(method, url, params){
		$.ajax({
			type: "POST",
			url: "some.php",
			data: { name: "John", location: "Boston" }
		})
		.done(function( objects ) {
			
		});
	}
};