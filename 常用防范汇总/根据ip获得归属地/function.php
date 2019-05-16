 <?php
 //根据ip获取归属地
    private function get_area_by_ip($ip){
        $data = array('province'=>'','city'=>'','district'=>'');
        $json = iconv('GBK','UTF-8',file_get_contents('http://whois.pconline.com.cn/ipJson.jsp?callback=testJson&ip='.$ip));
        $json = str_replace("if(window.testJson) {testJson(","",$json);
        $json = str_replace(");}","",$json);
        $arr = json_decode($json,true);
        
        //$arr = $this->get_area_detail_by_ip($ip);
        $data['province'] = substr($arr['pro'],0,6);
        $data['city'] = substr($arr['city'],0,6);
        $data['district'] = substr($arr['region'],0,6);
        if($data['province']==$data['city']){
            $data['city'] = $data['district'];
            $data['district'] = '';
        }
        $this->iplocation = implode('',$data);
        return $data;
    }
    
    private function get_area_detail_by_ip($ip) {
    	$data = array('province' => '', 'city' => '', 'district' => '');
    	$json = iconv('GBK', 'UTF-8', file_get_contents('http://whois.pconline.com.cn/ipJson.jsp?callback=testJson&ip=' . $ip));
    	$json = str_replace("if(window.testJson) {testJson(", "", $json);
    	$json = str_replace(");}", "", $json);
    	$arr = json_decode($json, true);
    	$data['province'] = $arr['pro'];
    	$data['city'] = $arr['city'];
    	$data['district'] = $arr['region'];
    	return $data;
    }