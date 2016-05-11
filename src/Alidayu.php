<?php

namespace xiao345\alidayu;

include "TopSdk.php";

date_default_timezone_set('Asia/Shanghai');


class Alidayu
{
    private $topclient;

    public function __construct()
    {
        $this->topclient = new \TopClient(env('ALIDAYU_APP_KEY'), env('ALIDAYU_APP_SECRETKEY'));
    }

    public function sendSms($phone, $template_code, $name,  Array $msg_param=null, $extend=null){
        $req = new \AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($name);
        if($msg_param){
            $req->setSmsParam(json_decode($msg_param));
        }
        if($extend){
            $req->setExtend($extend);
        }
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($template_code);

        return $this->topclient->execute($req);
    }
}