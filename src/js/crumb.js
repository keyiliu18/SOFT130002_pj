function jump(path){
    var i=0;
    var jumpPath = path;
    for(i=0;i<sessionStorage.length;i++){
        var getName=JSON.parse(sessionStorage.getItem(i.toString())).path_name
        if(getName === path){
    //        console.log(true)
            break;
        }
    }
    if (i===sessionStorage.length){    window.location.href = jumpPath ;return;}
    for(i=sessionStorage.length-1;i>=0;i--){
        getName=JSON.parse(sessionStorage.getItem(i.toString())).path_name
        var stringName=JSON.stringify(getName)
        var item =JSON.parse(sessionStorage.getItem(i.toString()));
     //   console.log(":::"+item.path_name)
        if(getName===path){
            break;
        }else {
            sessionStorage.removeItem(i.toString())
        }
    }
  //  console.log(":::"+window.location)
    window.location.href = jumpPath
}

window.onload=function() {
    var items = location.pathname.substr(1).split('/');//构建主路径
    var i=0,same=0;
    var crumb = "<span class='breadcrumb'"
    var num=sessionStorage.length
    var  forePath =location.protocol + "//" + location.host + "/"
    for (i = 0; i < items.length-1; i++) {
        forePath+=items[i];
    }
        var this_name = items[items.length-1];
    for(i=0;i<sessionStorage.length;i++){
        var getName=JSON.parse(sessionStorage.getItem(i.toString())).path_name
        if(getName === this_name){
            same=1;break;
        }
    }
    if(same===0){
        var path_data={path_name:this_name,id:num};
        sessionStorage.setItem(num.toString(),JSON.stringify(path_data))
    }
    //    console.log("sessionStorage:---->"+sessionStorage.getItem('0'))
     //   console.log("sessionStorage.length:---->"+sessionStorage.length)
    for (i=0;i<sessionStorage.length;i++){
      //  console.log(i+" :"+sessionStorage.getItem(i.toString()))
    }
        var breadcrumbTrail = "<div style='display: flex'>";
    for (i=0;i<sessionStorage.length;i++){
        getName=JSON.parse(sessionStorage.getItem(i.toString())).path_name
        var pathName = getName.split('.')[0]//<span>里填入pathname
        breadcrumbTrail+=crumb+" "+"id='" + pathName+"'" + "onclick=jump('"+getName+"')" + ">"+pathName+ "</span>";
        if(i!==sessionStorage.length-1){
            breadcrumbTrail+="<span class='breadcrumb'>></span> ";
        }
    }
        breadcrumbTrail += "</div>";
  //  console.log(breadcrumbTrail)
    document.getElementById("breadcrumb").innerHTML = breadcrumbTrail;
        var pathList=document.getElementsByClassName("breadcrumb");
    //    console.log(pathList)
        for(i=0;i<pathList.length;i++){
    //    console.log(i+" "+pathList[i])
            //设置css
            pathList[i].setAttribute("class","breadcrumb")
        }

    }
