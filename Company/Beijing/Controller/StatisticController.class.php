<?php

namespace Beijing\Controller;

use Think\Controller;
class StatisticController extends Controller {
	
	//成本核算
    public function costing(){
       $this->display();
    }
	//数据分析
	public function data_analysis(){
       $this->display();
    }
	//数据导出
	public function data_export(){
       $this->display();
    }
	

}