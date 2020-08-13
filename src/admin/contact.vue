<template>

  <div id="app">

    <div class="wrapper ">

      <div class="sidebar" data-color="purple" data-background-color="white">

        <div class="logo">
          <a href="" class="simple-text logo-normal">
            Blog
          </a>
        </div>

        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item   ">

              <router-link to="/dashboard" class="nav-link admin-nav-link">
                <i class="material-icons"></i>
                <p>Dashboard</p>
              </router-link>

            </li>

            <li class="nav-item " style="display:none;">
                <router-link to="/main" class="nav-link admin-nav-link" >
                  <i class="material-icons"></i>
                  <p>Main Page</p>
                  </router-link>
              </li>

            <li class="nav-item   ">
              <router-link to="/adminArticles" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Articles</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <router-link to="/adminTemple" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Temples</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <router-link to="/directory" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>directory</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <router-link to="/adVideos" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Videos</p>
              </router-link>
            </li>

            <li class="nav-item active  ">
              <router-link to="/adminContacts" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Contact</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <router-link to="/details" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Site Details</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <router-link to="/adNews" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>News</p>
              </router-link>
            </li>

            <li class="nav-item   ">
              <a class="nav-link admin-nav-link" @click="userLogout">
                <i class="material-icons"></i>
                <p>Logout</p>
              </a>
            </li>

            <!-- your sidebar here -->
          </ul>
        </div>

      </div>

      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="javascript:;">Contact</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>

          </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">

            <table id="messageTable" class="table table-dark" :key="render_table">
              <thead>
              <tr>
                <th class="col-1 text-center">ID</th>
                <th class="col-9">Name</th>
                <th class="col-1 text-center">Read</th>
                <th class="col-1 text-center">Delete</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="message in messages">
                <td class="text-center "><span :class="{'readM':message.read_unread===1}">{{message.id}}</span></td>
                <td>{{message.full_name}}</td>
                <td class="text-center" style="cursor:pointer;"
                ><router-link :to="{ path: '/message', query: { id: message.id }}">
                  <i class="fa fa-pencil"></i></router-link></td>
                <td class="text-center" style="cursor:pointer;"
                @click="deleteMessages(message.id)">x</td>
              </tr>

              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>

  </div>

</template>

<script>

  export default {

    created () {
      this.checkUser();
      this.getMessages();
    },

    data(){
      return{
        render_table:1,
        messages:[],
        read:0,
      }
    },

    methods:{

      checkUser(){
        this.$session.start();
        var log_status = this.$session.get('user');

        if(log_status==='true'){


        }else{
          alert("You should login first!!!");
          this.$router.push('/login');

        }
      },

      userLogout(){
        this.$session.destroy();
        this.$router.push('/login')
      },

      getMessages(){
        this.$http.get('http://localhost:8000/api/getMessages')
        .then(function (response) {
          this.messages = response.body.messages;
          this.checkRead();
        })
      },

      render_page(){
        this.$forceUpdate();
        this.getMessages();
        this.render_table +=1;
      },


      deleteMessages(id){
        this.$http.delete('http://localhost:8000/api/deleteMessage/'+id)
        .then(function (response) {
          this.render_page();
        })
      },

      checkRead(){

      },


    }
  }


</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  #messageTable{
    max-height: 40em;
    overflow-y: scroll;
  }

  .readM{
    background: red;
    padding: 0.4em 0.7em!important;
    border-radius: 50%;
  }
</style>
