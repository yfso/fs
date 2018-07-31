<template>
  <div id="loginback">
    <div id="maindiv">
      <img id="logo" src="@/assets/logo_s.png"/>
      <Input prefix="ios-contact" placeholder="用户名" size="large" class="inputs" :disabled="substatus.loading" v-model="user.username"/>
      <Input prefix="ios-lock" placeholder="密码" size="large" class="inputs" type="password" :disabled="substatus.loading" v-model="user.password"/>
      <Input prefix="md-mail" placeholder="内部码" size="large" class="inputs" :disabled="substatus.loading" v-model="user.vercode"/><br>
      <a id="forgetpass">忘记密码</a>
      <Button class="submitbutton" :type="substatus.successorerror" size="large" :loading="substatus.loading" @click="toLogin">
        <span>{{substatus.tips}}</span>
      </Button>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import qs from 'qs'

export default{
  name: 'Login',
  methods:{
    toLogin () {
      if((this.user.username=='')||(this.user.vercode=='')||(this.user.password=='')){
        this.substatus.status='0011'    
        let _this = this;
        setTimeout(function(){
          _this.substatus.status='';
        },2000)
      }else{
        axios.post('login', qs.stringify({logininfo:this.user}))
        .then(response => {
          this.substatus.status = response.data.status
          if(this.substatus.status=='1111'){
            sessionStorage.setItem('yftoken',response.data.token)
            setTimeout(function(){
              window.location.href='/';
            },1000)
          }else{
            let _this = this
            setTimeout(function(){
              _this.substatus.status='';
            },2000)
          }
        })
        .catch(err => {
          console.log(err)
        })
      }
    },                                                        
  },
  watch:{
    'user.username': function() {
      this.user.username=this.user.username.replace(/[\W]/g,'');
    },
    'substatus.status':function(){
      if(this.substatus.status==''){
        this.substatus.successorerror='success'
        this.substatus.tips='登录'
        this.substatus.loading=false
      }else if(this.substatus.status=='0000'){
        this.substatus.successorerror='error'
        this.substatus.tips='不存在用户'
        this.substatus.loading=true        
      }else if(this.substatus.status=='0001'){
        this.substatus.successorerror='error'
        this.substatus.tips='用户名或密码错误'
        this.substatus.loading=true  
      }else if(this.substatus.status=='0002'){
        this.substatus.successorerror='error'
        this.substatus.tips='内部码错误'
        this.substatus.loading=true  
      }else if(this.substatus.status=='0010'){
        this.substatus.successorerror='error'
        this.substatus.tips='登录信息设置失败'
        this.substatus.loading=true  
      }else if(this.substatus.status=='0011'){
        this.substatus.successorerror='error'
        this.substatus.tips='输入框不能为空'
        this.substatus.loading=true  
      }else if(this.substatus.status=='5555'){
        this.substatus.successorerror='error'
        this.substatus.tips='未知错误'
        this.substatus.loading=true  
      }else if(this.substatus.status=='1111'){
        this.substatus.successorerror='success'
        this.substatus.tips='登录成功'
        this.substatus.loading=true
      }
    },
    deep: true
  },
  data(){
    return {     
      user:{
        username:'',
        password:'',
        vercode:'',
      },
      substatus:{
        loading:false,
        successorerror:'success',
        status:'',
        tips:'登录',
      },
    }
  }
}
</script>

<style>
#loginback{height:100%;width:100%;background-color:#1F7A90;position:absolute;z-index:-1;}
#maindiv{height:30rem;width:25rem;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;margin-top:10rem;text-align:center;}
#maindiv>#logo{width:15rem;margin-bottom:1rem;}
#maindiv>.inputs{width:15rem;margin-bottom:1rem;transition:width 0.5s;}
#maindiv>.inputs:hover{width:18rem;}
#maindiv>#forgetpass{width:15rem;display:block;margin:0 auto;text-align:left;color:#fff;margin-top:-0.5rem;}
#maindiv>#forgetpass:hover{color:#ABC0C3;}
#maindiv>.submitbutton{width:15rem;margin:1rem;}
</style>
