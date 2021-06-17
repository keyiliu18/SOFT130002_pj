function registerForm() {
    var unMsg,pwMsg1,pwMsg2,eMsg,telMsg;
    var username = document.forms["register"]["UserName"].value;
    var password1 = document.forms["register"]["PassWord1"].value;
    var password2 = document.forms["register"]["PassWord2"].value;
    var email = document.forms["register"]["Email"].value;
    var tel = document.forms["register"]["Tel"].value;
    //邮箱：用户标识符+@+域名
    var regEmail =/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    //密码为数字+字母 长度2-32；
    var regPw =/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{2,32}$/;
    //区号+号码，区号以0开头，3位或4位 号码由7位或8位数字组成
    var regTel =/^0\d{2,3}-?\d{7,8}$/;
    //用户提示信息
    unMsg = document.getElementById("Un");
    pwMsg1 = document.getElementById("Pw1");
    pwMsg2 = document.getElementById("Pw2");
    eMsg = document.getElementById("Email");
    telMsg = document.getElementById("tel");
    if (username === "" ) {
        unMsg.innerHTML="用户名不能为空";
        return false;
    }else{
        //清除提示
        // unMsg.style.display="none";
        unMsg.innerText="";
    }
    if(password1 ==="") {
        pwMsg1.innerText = "密码不能为空";
        return false;
    }else if(!regPw.test(password1)){
        pwMsg1.innerText = "密码必须由数字和字母组成";
        return false;
    }else{
        //清除提示
        // pwMsg1.style.display="none";
        pwMsg1.innerText="";
    }
    if(password2 ===""){
        pwMsg2.innerText="密码不能为空";
        return false;
    }else if(password2 !== password1){
        pwMsg2.innerText="两次密码输入不一致";
        return false;
    }else {
        //清除提示
        // pwMsg2.style.display="none";
        pwMsg2.innerText="";
    }
    if(email ===""){
        eMsg.innerText="邮箱不能为空";
        return false;
    }else if(!regEmail.test(email)){
        eMsg.innerText="请输入合法邮箱";
        return false;
    }else{
        //清除提示
        //  eMsg.style.display="none";
        eMsg.innerText="";
    }
    if(tel !==""){
        if(!regTel.test(tel)){
            telMsg.innerText="请输入合法号码如010-88888888"
            return false;
        }else{
            //  telMsg.style.display="none";
            telMsg.innerText="";
        }
    }else{
        //  telMsg.style.display="none";
        telMsg.innerText="";
    }
    return true;
    //  alert("注册成功");
}
function registerPost(){
    console.log(registerForm())
    if (registerForm()===false){
        return false;
    }else{
        var username = document.forms["register"]["UserName"].value;
        var password = document.forms["register"]["PassWord1"].value;
        var email = document.forms["register"]["Email"].value;
        var address = document.forms["register"]["Address"].value;
        var send_msg="registration=success"
        send_msg+="&username="+username+"&password="+password+"&email="+email+"&address="+address;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        console.log(send_msg)
        xmlhttp.open("POST","php/register_check.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(send_msg);
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState===4){
                if(xmlhttp.status===200){
                    if(xmlhttp.responseText ==='success register'){
                        alert('success register!')
                        loginAfterRegister(username,password)
                    }else if(xmlhttp.responseText ==='exist'){
                        alert(username+' has been registered!')
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
function loginAfterRegister(username,password) {
    var getName=JSON.parse(sessionStorage.getItem((sessionStorage.length-1).toString())).path_name;
    console.log(getName)

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
