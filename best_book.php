<?php
require ('test.php');
$name = $_POST['best_book_name'];
$author = $_POST['best_book_author'];
$information = $_POST['best_book_information'];
$file = $_FILES['file'];//得到传输的数据
//得到文件名称
$img_name = $file['name'];
$type = strtolower(substr($img_name,strrpos($img_name,'.')+1)); //得到文件类型，并且都转化成小写
$allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
//判断文件类型是否被允许上传
if(!in_array($type, $allow_type)){
    //如果不被允许，则直接停止程序运行
    return ;
}
//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
    //如果不是通过HTTP POST上传的
    return ;
}
$upload_path = "./img/"; //上传文件的存放路径
//开始移动文件到相应的文件夹
if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
    $img_url = 'img/'.$file['name'];
}
$no = $_POST['inlineRadioOptions'];

$q="UPDATE best_book SET best_book_name='$name',best_book_author='$author',best_book_information='$information',best_book_img='$img_url' WHERE id='$no'";
if(@mysqli_query($con, $q)){

    $url="./admin_function.php";         //设置重定向的URL
    function redirect($url)
    {           //重定向函数
        echo "<script language=\"javascript\">";
        echo "location.href=\"$url\"";
        echo "</script>";
    }
    redirect($url);                  //重定向页面

}