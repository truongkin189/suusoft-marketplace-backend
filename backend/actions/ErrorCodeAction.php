<?php
namespace backend\actions;

use common\components\Response;

class ErrorCodeAction extends BaseAction
{
    public function run()
    {
        $data =  Response::getErrorMsg('all');
        return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code'=> 200]);

    }


}

