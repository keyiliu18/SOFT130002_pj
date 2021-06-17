function viewOrder(val){
    console.log(val);
    var artist= document.forms["searchForm"]["type"];
    var input= document.forms["searchForm"]["search_req"].value;
    var len=artist.length;
    var send_msg="registration=success&order="+val;
    for(var i=0;i<len;i++){
    if (artist[i].checked)
    send_msg+="&type[]="+artist[i].value;
    }
    send_msg+="&search_req="+input;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
    xmlhttp=new XMLHttpRequest();
    }
    else{
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.status===200) {
        document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
        //   alert(xmlhttp.responseText)
        }
    }
    console.log(send_msg)
    xmlhttp.open("POST","php/search_result.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(send_msg);
}

function searchResult(){
    console.log("调用搜索")
    var artist= document.forms["searchForm"]["type"];
    var input= document.forms["searchForm"]["search_req"].value;
    var len=artist.length;
    var send_msg="registration=success"
    for(var i=0;i<len;i++){
    if (artist[i].checked)
    send_msg+="&type[]="+artist[i].value;
    }
    send_msg+="&search_req="+input;
    var xmlhttp;
    if (window.XMLHttpRequest){
    // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    xmlhttp=new XMLHttpRequest();
    } else {
    // IE6, IE5 浏览器执行代码
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    console.log(send_msg)
    xmlhttp.open("POST","php/search_result.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(send_msg);
    xmlhttp.onreadystatechange=function()
    {
        if ( xmlhttp.status===200) {
    document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    //
        }else{
         alert("wrong:"+xmlhttp.status)
        }
    }
}
function changePage(val){
    console.log(val);
    var change_page =val;
    var current_page  = document.getElementById("currentPage").value;
    console.log(current_page);
    if(val === -1 ){
    change_page = ++current_page;
         console.log(change_page);
    }else if(val === -2){
         change_page = --current_page;
         console.log(change_page);
    }
    var artist= document.forms["searchForm"]["type"];
    var input= document.forms["searchForm"]["search_req"].value;
    var order = document.getElementById("order").value;
    var len=artist.length;

    var send_msg="registration=success&order="+order;
    for(var i=0;i<len;i++){
    if (artist[i].checked)
    send_msg+="&type[]="+artist[i].value;
}
    send_msg+="&search_req="+input;
    send_msg+="&page="+change_page;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
    xmlhttp=new XMLHttpRequest();
    }
    else
    {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    // alert(xmlhttp.readyState)
    if (xmlhttp.status===200)
    {
    document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    }
}
    console.log(send_msg)
    xmlhttp.open("POST","php/search_result.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(send_msg);
}

