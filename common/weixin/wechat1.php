<?php
define("TOKEN", "8x9p4s4e6x");
define("APPID", "wx2ffdfc53824c5430");
define("SECRET", "8b501b4335e6559840dbdac18cf0da85");

class wechatCallbackapiTest
{
    /* 
    *  私有成员变量 存token值
    *  因为//access_token是公众号的全局唯一票据，公众号调用各接口时都需使用access_token。
    *  正常情况下access_token有效期为7200秒，重复获取将导致上次获取的access_token失效。
    */
	private $_token;
	
	//构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
        if(APPID && SECRET){
            $this->token = TOKEN;
			$this->appid = APPID;
            $this->appsecret = SECRET;
        }
		$echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
		// 读取XML文件中的数据
		if (file_exists(V_ROOT . "/data/XMLToken.xml")){
			$xml = @simplexml_load_file(V_ROOT . "/data/XMLToken.xml");
			$now  = time();
			$AccessExpires = strtotime($xml->AccessExpires)+7200;
			//echo strtotime($xml->AccessExpires).','.$AccessExpires.','.$now;
			if ($now >= $AccessExpires){//access_token过期
				$this->_token = $this->get_access_token();
				
			}else{
				$this->_token = $xml->AccessToken;
			}
		}else{
			$this->_token = $this->get_access_token();
			$AccessExpires = date('Y-m-d H:i:s');
		}
    }
	public function get_access_token(){
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
		$res = $this->http_request($url);
		$result = json_decode($res, true);
		$content = '<?xml version="1.0" encoding="utf-8"?>
<xml>
<AccessToken>'.$result["access_token"].'</AccessToken>
<AccessExpires>'.date("Y-m-d H:i:s").'</AccessExpires>
</xml>';
		file_put_contents(V_ROOT . "/data/XMLToken.xml",$content);
		return $result["access_token"];
	}
    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）
    protected function http_request($url, $data = null, $needToken = false)
    {
        if($needToken){
			$this -> _token = $this -> get_access_token();
		}
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
		$strjson=json_decode($output);
		//var_dump($strjson);//开启可调试
        if (!empty($strjson-> errcode))  
        {echo $strjson-> errcode;
            switch ($strjson-> errcode){
                  
                case 40001:  
                    $this -> http_request($url, $data, true); //重新取值，可能是过期导致   
                    break;
                case 41001:  
                    throw new Exception("缺少access_token参数:".$strjson->errmsg); 
                    break;
				case 42001://重新取值，可能是access_token过期导致 
                    $this -> http_request($url, $data, true);
                    break;
                default:  
                    throw new Exception($strjson->errmsg); //其他错误，抛出   
                    break;
                  
            }
        }
        return $output;
    }
	//检测函数
    private function checkSignature()
    {
		// you must define TOKEN by yourself
		if (!defined("TOKEN")) {
			throw new Exception('TOKEN is not defined!');
		}
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "text":
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "event":
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "";
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }
	//得到用户发送的文本
    /*private function receiveText($object)
    {
        global $db, $picserver, $siteurl, $bid;
		$funcFlag = 0;
        $contentStr = "你发送的内容为：".$object->Content;
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }*/
	private function receiveText($object)
	{
		$keyword = trim($object->Content);
		if (strstr($keyword, "单图文")){
			$content = array();
			$content[] = array("Title"=>"单图文标题",  "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
		}else if (strstr($keyword, "图文") || strstr($keyword, "多图文")){
			$content = array();
			$content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
			$content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
			$content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
		}else{
			$content = date("Y-m-d H:i:s",time())."\n金桥旅游";
		}
	
		if(is_array($content)){
			if (isset($content[0]['PicUrl'])){
				$result = $this->transmitNews($object, $content);
			}else if (isset($content['MusicUrl'])){
				$result = $this->transmitMusic($object, $content);
			}
		}else{
			$result = $this->transmitText($object, $content);
		}
		return $result;
	}
	//得到用户发送的事件
    private function receiveEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "欢迎关注金桥旅游";
            case "unsubscribe":
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "company":
                        $contentStr[] = array("Title" =>"公司简介", 
                        "Description" =>"金桥旅游提供旅游相关的产品及服务", 
                        "PicUrl" =>"http://weixin.cgbt.net/images/logo.jpg", 
                        "Url" =>"weixin://addfriend/pondbaystudio");
                        break;
                    default:
                        $contentStr[] = array("Title" =>"默认菜单回复", 
                        "Description" =>"您正在使用的是金桥旅游的自定义菜单接口", 
                        "PicUrl" =>"http://weixin.cgbt.net/images/logo.jpg", 
                        "Url" =>"http://weixin.cgbt.net/");
                        break;
                }
                break;
            default:
                break;    

        }
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }
	//翻译内容
    private function transmitText($object, $content, $funcFlag = 0)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>%d</FuncFlag>
</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $resultStr;
    }
	//推送列表信息
    private function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        //首条标题28字，其他标题39字
        if(!is_array($arr_item))
            return;

        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
<FuncFlag>%s</FuncFlag>
</xml>";

        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }
	//得到用户列表
	public function GetUserList()  
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this -> _token;
		$res = $this->http_request($url);
		$result = json_decode($res, true);
        //$openidarr= $result['data']['openid'];
        //var_dump($openidarr);//调试
        return $result;
    }
      
    //得到订阅用户详情（返回对象）   
    public function GetUserDetail($openid)  
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this -> _token."&openid={$openid}";
        $res = $this->http_request($url);
		$strjson = json_decode($res,true);
        return $strjson;
    }
}
/*获取访问信息*/
function traceHttp(){
	logger("REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'].((strpos($_SERVER['REMOTE_ADDR'],"101.226"))?"weixin IP":"unknown IP"));
	logger("QUERY-STRING:".$_SERVER['QUERY_STRING']);
}
/*记录访问信息*/
function logger($content){
	file_put_contents("./log.html",date("Y-m-d H:m:s").$content."<br>",FILE_APPEND);
	//echo $content;
}
?>