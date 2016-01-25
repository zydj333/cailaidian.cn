// JavaScript Document
var currentPosition,timer;  
function GoTop(){  
    timer=setInterval("runToTop()",1);  
}  
function runToTop(){  
    currentPosition=document.documentElement.scrollTop || document.body.scrollTop;   
    currentPosition-=30; // <!--数字用来控制移动速度，越大越快-->
    if(currentPosition>0)  
    {  
        window.scrollTo(0,currentPosition);  
    }  
    else  
    {  
        window.scrollTo(0,0);  
        clearInterval(timer);  
    }  
} 