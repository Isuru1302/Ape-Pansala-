<template>

  <div id="app" v-bind:style='{background:backgroundColor,height:height}'>

    <div class="login-page">

        <div class="login-area">

          <div class="login-form col-9 col-sm-8 col-md-6 col-lg-6">
              <h2>Account Login</h2>

              <form @submit.prevent="addLoginDetails">
                <input type="text" name="uname" v-model="loginDetails.username"
                       placeholder="Username or Email" class="mb-1" required>
                <input type="password" name="upassword" v-model="loginDetails.password"
                       placeholder="Password" required>

                <input type="submit" id="subbtn" name="subbtn" value="Login">


                <p id="wrong" style="color:red;"></p>
              </form>

          </div>
        </div>

    </div>

  </div>

</template>

<script>
  import router from '../router'

  export default {

    data(){
      return{
        backgroundColor:"#d1ffff",
        height:"100vh",
        loginDetails:{
          username:'',
          password:'',
        },

      }
    },

    methods:{

      addLoginDetails(){
        this.$http.post("http://localhost:8000/api/loginCheck",this.loginDetails)
          .then(function (response) {
            if (response.body.login_message===false){
              $('#wrong').text("UserName or Password is wrong. Please try again!!");
            }else{
              this.$session.start();
              this.$session.set('user','true');
              router.push('/dashboard');
            }
          })

      },




    },

  }
</script>

<style scoped>

.login-form{
  background: #ffffff;
  position: absolute;
  top: 50%;
  left: 50%;
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  padding: 4em 4em;
  border: 1px solid;
  box-shadow: 5px 10px 8px #888888;
}

.login-form h2{
  text-align: center;
  margin-bottom: 2em;
}

.login-form input{
  width: 100%;
  padding: 0.5em;
}

#subbtn{
  margin-top: 2em;
  background: #0b75c9;
  border:1px solid #0b75c9;
  color: #ffffff;
}


</style>
