<?php 

interface BaseInterFace{

    public  function renderStep(string $fileName,$dotLev='');

    public  static function views(array $params = [],$template=null,$_ext=null,$handler=null,$handlerPath=null) :void;
    public  function renderView(string $fileName,$dotLev='');



    //public static function views(array $params = []);

}


?>