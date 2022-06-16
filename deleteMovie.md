## delete movie

To implement the delete functionality, we need to deal with a few things:
- routing
- controller
- view

To deal with route we need to register new route in web.php with appropriate method, url and method from MovieController
- url should be /movies/{id}
- method in controller should be named destroy
- to delete movie in your controller you can call $movie->delete(); instead of $movie->save();
- after deleting you can redirect the user to the list of movies and flash the success message

Last part is to deal with delete button
- in a view for movie detail you will create a <form> with appropriate action
- do not forget to provide csrf token and hidden input saying to Laravel it is a delete method
