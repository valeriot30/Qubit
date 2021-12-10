<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 04/09/2019
 * Time: 21:41
 */

namespace App\Pattern\Controllers
{
    use App\Qubit\Framework\Controller;
    use App\Qubit\Database\DB;
    use Pecee\Http\Request;

    class Main extends Controller
    {
        public function index()
        {
            $this->view->render('main', array());
        }
        public function request()
        {
            die($_POST['prova']);
        }
        public function render()
        {
            $this->view->render('prova', array());
        }

    }
}