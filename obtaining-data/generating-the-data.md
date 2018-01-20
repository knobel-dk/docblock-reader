# Obtaining the data yourself

## Fetch all the files

**WARNING:** If you are trying this at home you must have at least 5 GB of available disk space and a few hours at hand depending on your bandwidth. 

The file [git-clone.sh](git-clone.sh) will clone 443 PHP libraries into a `data/` folder. To rin this file simply execute `bash git-clone.sh`.

Here are a few examples of the commands that [git-clone.sh](git-clone.sh) will execute:

```
1 git clone https://github.com/paragonie/past.git data/past/
2 git clone https://github.com/laravel/laravel.git data/laravel/
3 git clone https://github.com/symfony/thanks.git data/thanks/
...
441 git clone https://github.com/phpmyadmin/phpmyadmin.git data/phpmyadmin/
442 git clone https://github.com/getgrav/grav.git data/grav/
443 git clone https://github.com/electerious/Lychee.git data/Lychee/
```

## Parse every PHP script into your dataset
Once you have downloaded the GitHub repos as mentioned above, you can run `php parser.php`. This will parse every PHP file to find snippets that were commented using the PSR convention. As an example this Laravel mock file would add two lines to [snippets.dat](../snippets.dat) and two lines to [comments.dat](../comments.dat)

```php
/**
 * The connection name for the model.
 *
 * @var string
 */
protected $connection = 'connection-name';

/**
 * Create a new flight instance.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
    // Validate the request...

    $flight = new Flight;

    $flight->name = $request->name;

    $flight->save();
}
```

Here is how this mock file would look like in [snippets.dat](../snippets.dat):

```
protected $connection = 'connection-name';
public function store(Request $request) { $flight = new Flight; $flight->name = $request->name; $flight->save(); }
```

And [comments.dat](../comments.dat) would look like this:

```
The connection name for the model. @var string 
Create a new flight instance. @param Request $request @return Response
```
