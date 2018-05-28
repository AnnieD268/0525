<?php
namespace app\home\controller;

use core\Controller;
use core\model\Model;
use core\view\View;
use system\model\Article;

class Entry extends Controller{

    public function index(){




        return View::make() -> with('version','版本:v1.0');

    }

}



?>