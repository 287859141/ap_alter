<?php
//将数组转化为树形数组
 function arrToTree($data,$pid){
        $tree = array();
        foreach($data as $k => $v){
            if($v['pid'] == $pid){
                $v['pid'] = arrToTree($data,$v['id']);
                $tree[] = $v;
            }
        }        
        return $tree;
 }
 //左边菜单栏输出
 function outMenu($group,$tree){
    $html = '';
    foreach($tree as $t){
      if($t['group_id']==$group){
        if(empty($t['pid'])){
            $html .= '<li><a href="'.__APP__.'/'.$t['name'].'/index/" target="navTab" rel="'.$t['name'].'">'.$t['title'].'</a></li>';
        }else{
            $html .='<li><a>'.$t['title'].'</a><ul>';
            $html .=outMenu($group,$t['pid']);
            $html  = $html.'</ul></li>';
        }
      }
    } 
    return $html;
 }