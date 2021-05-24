var aImgs = document.querySelectorAll('.content .introduce_hot');
var btLeft = document.querySelector('.content .left');
var btRight = document.querySelector('.content .right');
var index = 0;        //当前图片下标
var lastIndex = 0;
for(var i=0;i<aImgs.length;i++){
    aImgs[i].className='off';
}
aImgs[0].className = 'on';
change = function (j){
    for(var k=0;k<aImgs.length;k++){
        if(k!==j) {
            aImgs[k].className = 'off';
        }else{
            aImgs[k].className = 'on';
        }
    }
}
btRight.onclick = function(){
    lastIndex = index;
    index++;
    index %= aImgs.length;
    change(index);
}
btLeft.onclick = function(){
    lastIndex = index;
    index--;
    if (index < 0) {
        index = aImgs.length - 1;
    }
    change(index);
}
autoChange = function(){
    lastIndex = index;
    index++;
    index %= aImgs.length;
    change(index);
}
chosen=function(it){
    console.log(it)
    var ch=document.getElementById(it);
}
//setInterval(autoChange,4000);
