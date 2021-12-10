
# Qubit
Qubit is a mini-framework which follows MVC architecture built in PHP
# Installation
1. Use the composer manager to install ([https://getcomposer.org/](https://getcomposer.org/))

 > `composer install`

2. Open "App\Configuration\site-default.php" and fill up with your mysql data
3. Use Framework Installation
4. Enjoy


# Usage (Documentation)

## Router

To add routes, open App\Qubit\Routes.php and add your own route
Here's an example: 

    public function start()
    {
            Router::setDefaultNamespace('\App\Pattern\Controllers');
            Router::get('/', 'Index@index')->setname('index'); 
            Router::start();
    }
You can choose to use Qubit's router or SkipperBent's Simple Router:

> https://github.com/skipperbent/simple-php-router

## MVC

Controllers are stored in the App/Pattern/Controllers directory and extends the Controller class.
You can add a controller and handle in the router with the following structure:

**Controller**

    namespace App\Pattern\Controllers
	{
	    use App\Qubit\Framework\Controller;

	    class Main extends Controller
	    {
	        public function index()
	        {
	            $this->view->render('main'); // render your view
	        }
	    }
	}

**View**

Views are static files which the application returns as response. At runtime, the application replaces variables in these files with actual values, and transforms the content into an HTML file sent to the client.

Traditionally, view files are located in app/Views, but this can be changed in the views configuration file.

 See Twig documentation: 
 

> https://github.com/twigphp/Twig

## Database
Create your own model that use DB's Hydrahon Query Builder. Here's an example:

    namespace App\Pattern\Models
	{

	    use App\Qubit\Database\DB;
	    use App\Qubit\Framework\Model;
	    use PDO;
	    
	    class Users extends Model
	    {
		    @Override
	        public static function getTable()
	        {
				
	        }
	    }
	}	

Full doc here:

> https://clancats.io/hydrahon/master/

## Validation

Qubit has a built-in Validation wrapper. Multiple rules and parameters handling:

			    $email = input()->post('email')->value;
                $pass = input()->post('password')->value;

                $validator = new Validator([
                    'email' => $email,
                    'pass' => $pass
                ]);

                $validation = $validator->validate([
                    'email' => 'required|email',
                    'pass' => 'required|min=5|max=10'
                ]);

                if($validation->isSuccess())
                {
                    // do something
                }

                echo $validation->displayErrors();

You can also add multiple errors in another class:

    $validation->setError("Custom error");

## Language

Qubit has a Language System that allows you to change the system locale or decide to load the language according to browser's default one.

 You can find and set differents locale at App\Qubit\Language\langs

    Language::handleLang('lang');

# Utils
## Session
Qubit can also handle session and cookies requests (Namespace: App\Qubit\Session)

    Session::set('sessionname', 'value');

And you can easily get a session:
 

    Session::get('sessionname');

You can also check if a session is alive:

    Session::isAlive('sessionname'); // returns bool 

And finally stop a session or destroy all

    Session::stop('sessionanme');
    Session::end();

## Filters and Sanitize

You can protect yourself by XSS and injections attack with Sanitize Class, for example:

    Sanitize::sanitizeEmail($email);
    Sanitize::sanitizeFullSpecialCharacters($string);
    Sanitize::sanitizeUrl($url);
Return a sanitizied string.

## Hashing

Thanks to Hashing class, you can crypt your file with your prefered algorithm

    Hashing::hash($data, ALGORITHM);
or

    Hashing::verify($data1, $data2); // returns bool
and finally

    Hashing::generateRandom() // create a pseudo-random string

##  Helpers
 Use Qubit's Helpers like:
 

    response()->redirect('/');
    response()->getUrl();

And more functions . . . 

# Update in the future
- Plugins Manager
- Custom Template Manager
- Custom ORM
-  JSON handling

# Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

# License    
[MIT](https://choosealicense.com/licenses/mit/)
