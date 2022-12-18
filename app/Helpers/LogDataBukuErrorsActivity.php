<?php

namespace App\Helpers;
use Request;
use App\Models\LogDataBukuError;

class LogDataBukuErrorsActivity{
    public static function addToLog($message, $status, $action, $id_buku){
        $log = [];
    	$log['kode_peminjaman'] = $id_buku;
    	$log['message'] = $message;
    	$log['status'] = $status;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['user_agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    	$log['action'] = $action;
    	LogDataBukuError::create($log);
    }
}