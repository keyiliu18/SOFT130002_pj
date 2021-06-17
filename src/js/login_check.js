function loginForm() {
    var username = document.forms["login"]["UserName"].value;
    var password = document.forms["login"]["PassWord"].value;
    //上一个页面
    var getName=JSON.parse(sessionStorage.getItem((sessionStorage.length-1).toString())).path_name
    console.log(getName)
    if (username === "" ||  password=== "" ||username==null || password==null) {
        alert("用户名或密码不能为空！");
        return false;
    }else{
        var send_msg="registration=success"
        send_msg+="&username="+username+"&password="+password;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        console.log(send_msg)
        xmlhttp.open("POST","php/login_check.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(send_msg);
        xmlhttp.onreadystatechange=function()
        {
            console.log(xmlhttp.readyState)
            if (xmlhttp.readyState===4){
                if(xmlhttp.status===200){
                    if(xmlhttp.responseText ==='success'){
                        alert('success login!')
                        window.location.href = getName;//跳转到上一个页面
                    }else{
                        alert(xmlhttp.responseText)
                    }
                }else{
                    alert("wrong:"+xmlhttp.status)
                }
            }
        }
    }

}
