# Obtaining the data yourself

## How we generated the data

We first cloned the 443 PHP libraries into the `data/` folder.

**WARNING:** If you are trying this at home you must have at least 5 GB of available disk space and a few hours depending on your bandwidth.

`bash git-clone.sh`. Here are a few examples of the commands:

```
1 git clone https://github.com/paragonie/past.git data/past/
2 git clone https://github.com/laravel/laravel.git data/laravel/
3 git clone https://github.com/symfony/thanks.git data/thanks/
...
441 git clone https://github.com/phpmyadmin/phpmyadmin.git data/phpmyadmin/
442 git clone https://github.com/getgrav/grav.git data/grav/
443 git clone https://github.com/electerious/Lychee.git data/Lychee/
```

Afterwards we parsed every PHP file to find functions that were commented using the PSR convention. Specifically, we turned this:

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

Into two files that are both included in this repo.

```
snippets.dat
protected $connection = 'connection-name';
public function store(Request $request) { $flight = new Flight; $flight->name = $request->name; $flight->save(); }
...
[another 181,935 rows]

comments.dat
The connection name for the model. @var string
Create a new flight instance. @param Request $request @return Response
...
[another 181,935 rows]
```

If you want to generate them yourself you can run `php parser.php`.