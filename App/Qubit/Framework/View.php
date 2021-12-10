<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 07/09/2019
 * Time: 15:12
 */

namespace App\Qubit\Framework
{

    use App\Environment;
    use Twig;
    use App\Qubit\Language\LanguageSystem as Lang;

    class View
    {
        public function __construct()
        {
            // todo make this general, in another class
            if(Environment::getConfig()['site']['template'] == ''){
                $this->template = 'default';
            }
            $this->lang = new Lang;
            $this->loader = new Twig\Loader\FilesystemLoader( '../App/Pattern/Views/'.Environment::getConfig()['site']['template']);
            $this->twig = new Twig\Environment($this->loader, [
                'debug' => true
            ]);
        }
        public function render($view, $params)
        {
            $vars['translate'] = $this->lang->handle();
            $usefulVars = ['lang' => $vars['translate']];
            $p = array_merge($params, $usefulVars);
            echo $this->twig->render($view.'.twig', $p);
        }
    }
}