<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>

export default {
  name: 'App',
  data(){
    return {     

    }
  },
}
</script>

<style>
*{margin:0;padding:0;}
html,body{height:100%;width:100%;}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  width:100%;
  height:100%;
}
</style>
