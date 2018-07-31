//验证码区
function buildVer(verSubject,verU,verP,verUrl,toUrl){
verSubject.css({"height":"100%","width":"100%","background-color":"#fff"});
var user_vercode = "";
var sys_vercode = "";
sys_vercode = setVerification();
      verSubject.on("click","td",function(){
      if($(this).attr("on")==1){
        $(this).css("color","#008FC5");
        $(this).attr("on",0);
        user_vercode=user_vercode.replace($(this).attr("dataid"),'');
      }else if(user_vercode.split("").length<=4){
          user_vercode = user_vercode+$(this).attr("dataid");
          $(this).css("color","#18B93F");
          $(this).attr("on",1);
          if((user_vercode.split("").length==4)&&(user_vercode==sys_vercode)){   
            setError("yzs");
            var logindata = {
              "username":verU.val(),
              "password":verP.val()
            };
            setTimeout(function(){    
              $.post(verUrl,logindata,function(serverdata){
                serverdata = JSON.parse(serverdata);
                var status = serverdata.status;
                var token = serverdata.token;
                if(status=="1111"){
                  setError(status);
                  sessionStorage.setItem("yf_edu_token",token);
                  window.location.href=toUrl;
                }else{
                  setError(status);
                  setTimeout(function(){
                    initVerification();
                    user_vercode="";
                    sys_vercode = setVerification();
                  },1000);
                }
              });
            },700);
          }else if(user_vercode.split("").length==4){
            setError("yze");
            setTimeout(function(){
              initVerification();
              user_vercode="";
              sys_vercode = setVerification();
            },1000);
          }
      } 
    });
    verSubject.on("click","img",function(){
      initVerification();
      user_vercode="";
      sys_vercode = setVerification();
    });
}
function getJsonP(data){
  console.log("callback:"+data);
}
function getArgs(){
  return new Array(verSubject,verU,verP,verUrl);
}
function initVerification(){
  $(".verificate-div").html("");
}
function setVerification(){
  var ordercode = getorderCode().split('');
  var express = getExpresstion().split('');
  var vercode = getVerCode().split('');
  $("<table style='height:100%;width:100%;'></table>").appendTo(".verificate-div");
  $.each(ordercode,function(i,val){
    var ele = "<td dataid="+vercode[val]+" on=0 style='height:100%;width:20%;vertical-align: middle;color:#008FC5;'>"+express[val]+"</td>";
    $(ele).appendTo(".verificate-div>table");
  })
  $("<img src='image/ref.png' style='height:60%;margin-top:15%;'/>").appendTo(".verificate-div>table");
  return vercode.join('');
}
function getVerCode(){
  return "3b5s";
}
function getorderCode(){
  var code = new Array();
  while(code.length<4){
    var bool = true;
    var rad = parseInt(Math.random()*4);
    for(var z=0;z<code.length;z++){
      if(code[z]==rad){
        bool = false;
      }
    }
    if(bool){
      code = code + rad;
    }
  }
  return code;
}
function getExpresstion(){
  var expressLib = new Array(
    "悬梁刺股","勤学好问","勤学苦练","专心致志","勤俭节约"
  );
  var rad = parseInt(Math.random()*expressLib.length);
  return expressLib[rad];
}

function setError(rearg){
  initVerification();
  var sence = '';
  switch(rearg){
    case "0010":
      sence='用户名不存在';
      img='error.png';
      color="#CD0B0B";
      break;
    case "0011":
      sence='用户名或密码错误';
      img='error.png';
      color="#CD0B0B";
      break;
    case "5555":
      sence='未知错误，请稍等';
      img='error.png';
      color="#CD0B0B";
      break;
    case "1111":
      sence='登录成功，请稍等';
      img='success.png';
      color="#0FAD3C";
      break;
    case "yze":
      sence='验证错误';
      img='error.png';
      color="#CD0B0B";
      break;
    case "yzs":
      sence='验证成功，请稍等';
      img='success.png';
      color="#0FAD3C";
      break;
    default:
      sence='未知错误'+rearg;
      img='error.png';
      color="#CD0B0B";
      break;
  }
  $("<table style='height:100%;width:100%;'></table>").appendTo(".verificate-div");
  $("<td style='text-align:center;width:80%;height:100%;padding-left:20%;color:"+color+"'>"+sence+"</td>").appendTo(".verificate-div>table");
  $("<img src='image/"+img+"' style='height:60%;margin-top:15%;'/>").appendTo(".verificate-div>table");
}