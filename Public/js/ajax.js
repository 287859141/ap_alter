//alert('link OK');
var xmlhttp_request = '';
var post_res = '';
var return_res='';

function postAjax(url,post_res,callback){
	
	if(window.ActiveXObject)
    {
        xmlhttp_request=new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if(window.XMLHttpRequest)
    {
        xmlhttp_request=new XMLHttpRequest();
    } 	
	xmlhttp_request.open('POST',url,true);
	xmlhttp_request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmlhttp_request.send(post_res);
	xmlhttp_request.onreadystatechange = function(){
		if (xmlhttp_request.readyState == 4) {
			if (xmlhttp_request.status == 200) { // 信息已经成功返回，开始处理信息 
				return_res=xmlhttp_request.responseText;
				callback(return_res);
			}
		}
	}
}

function callback(return_res){
	alert(return_res);
}