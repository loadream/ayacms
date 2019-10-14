<?php 

/**
 * @param $title string 进行分词的标题
 * @param $content string 进行分词的内容
 * @param $encode string API返回的数据编码
 * @return  array 得到的关键词数组
 */

    if($title == ''){
        return false;
    }

    $title=preg_replace("/\[.+?\]/U", '', $title);
    $content=preg_replace("/\[.+?\]/U", '', $content);
    
    $title = rawurlencode(strip_tags($title));
    $content = strip_tags($content);
    if(strlen($content)>2400){ //在线分词服务有长度限制
        $content =  mb_substr($content, 0, 800, $encode);
    }
    $content = rawurlencode($content);
    
    $url = 'http://keyword.discuz.com/related_kw.html?title='.$title.'&content='.$content.'&ics='.$encode.'&ocs='.$encode;
    $xml_array=simplexml_load_file($url);                        //将XML中的数据,读取到数组对象中  
    $result = $xml_array->keyword->result;
    $data = array();
    foreach ($result->item as $key => $value) {
            array_push($data, (string)$value->kw);
    }
    if(count($data) > 0){
        return $data;
    }else{
        return false;
    }
    