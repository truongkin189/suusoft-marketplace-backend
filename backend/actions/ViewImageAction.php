<?php
namespace backend\actions;

use common\components\FHtml;

class ViewImageAction extends BaseAction
{

    public function run()
    {
        $d = isset($_REQUEST['d']) ? $_REQUEST['d'] : '';  //directory
        $f = isset($_REQUEST['f']) ? $_REQUEST['f'] : '';  //file name
        $s = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';  //thumb

        $file = FHtml::getImagePath($s.$f, $d); ///also works
        //$file = FHtml::getFileURL($s.$f, $d, BACKEND, \Globals::NO_IMAGE);
		
		//echo $file;die;

        $info = getimagesize($file);

        header("Content-type: {$info['mime']}");

        readfile($file);
    }

}
