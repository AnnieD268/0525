<?php
namespace app\admin\controller;

use core\view\View;
use system\model\Grade as g;
use system\model\Edit as e;

class Grade extends Common{

//    班级列表方法
    public function index(){
//        获取班级表中的所有数据
        $data = g::get() -> toArray();
//        加载班级表模板
        return View::make() -> with('grade',$data);
    }

//    添加班级模板
    public function create(){
//        加载添加班级模板
        return View::make();
    }

//    添加方法
    public function add(){
//        获取post数据
        $post = $_POST;
//        将post数据插入grade表中
        $result = g::add($post);
//        判断返回结果是否为真，提示不同消息
        if ($result){
            return $this -> redirect('index.php?s=admin/grade/index') -> message('班级添加成功');
        }else{
            return $this -> redirect() -> message('班级添加失败');
        }

    }

//    编辑方法
    public function edit(){

//        获取需要修改的班级id
        $id = $_GET['id'];
//        通过id找到对应班级数据
        $gname = g::find($id) -> toArray();
//        如果有post数据
        if ($_POST){
//            获取post 数据
            $post = $_POST;
//            调用框架的edit方法来修改数据
            $result = g::edit($post);
//        判断结果是否为真，为真返回成功，为假返回失败
            if ($result){
                return $this -> redirect('index.php?s=admin/grade/index') -> message('编辑成功');
            }else{
                return $this -> redirect() -> message('编辑失败');
            }
        }
//        加载编辑学生模板，分配修改的数据
        return View::make() -> with('gname',$gname);
    }

//    跳转删除方法
    public function delete(){
//        获取需要删除的班级id
        $id = $_GET['id'];
//        删除对应id
        $result = g::delete($id);
//        判断返回结果是否为真，提示消息并跳转
        if($result){
            return $this -> redirect('index.php?s=admin/grade/index') -> message('班级数据删除成功');
        }else{
            return $this -> redirect() -> message('班级数据删除失败');
        }

    }

    public function ajaxDelete(){
//        获取需要删除的班级id
        $id = $_GET['id'];
//        删除对应id
        $result = g::delete($id);
//        判断$result返回结果是否为真,来返回给前台不同的处理结果
        if ($result){
//            如果为真,代表删除成功
            return json_encode(['valid' => 1,'message' => '班级数据删除成功']);
        }else{
//            如果为假,代表删除失败
            return json_encode(['valid' => 0,'message' => '班级数据删除失败']);
        }
    }


}


?>