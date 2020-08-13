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

            <li class="nav-item  active ">
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

            <li class="nav-item   ">
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
              <a class="navbar-brand" href="javascript:;">Temples</a>
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

            <div class="add-temple">
              <router-link to="/addTemple" class="add-tm">+</router-link>
            </div>

              <div class="temples-table mt-4">
                <table class="table table-dark" style="width: 100%" :key="render_table">

                  <thead>
                    <tr>
                      <th  class="col-1">Id</th>
                      <th class="col-4">Name</th>
                      <th  class="col-5">Address</th>
                      <th  class="col-1">Edit</th>
                      <th  class="col-1">Delete</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="temple in temples">
                      <td>{{temple.id}}</td>
                      <td>{{temple.temple_name}}</td>
                      <td>{{temple.temple_address}}</td>
                      <td style="cursor: pointer"><router-link :to="{ path: '/editTemple', query: { id: temple.id }}"><i class="fa fa-pencil"></i></router-link></td>
                      <td style="cursor: pointer" @click="deleteTemple(temple.id)">x</td>
                    </tr>
                  </tbody>

                </table>

              </div>

          </div>
        </div>

      </div>

    </div>

  </div>

</template>

<script>
  export default {

    data(){
      return{
        temples:[],
        render_table: 1,
      }
    },

    created () {
      this.checkUser();
      this.getTemples();
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

      getTemples(){
        this.$http.get('http://localhost:8000/api/getTemples')
          .then(function (response) {
            this.temples = response.body.temples;
          })
      },

      render_page(){
        this.$forceUpdate();
        this.getTemples();
        this.render_table +=1;
      },

      deleteTemple(id){
        this.$http.delete("http://localhost:8000/api/deleteTemple/"+id)
          .then(function (response) {
            this.render_page();
          })
      }

    }
  }


</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .temples-table thead th,.temples-table  tbody td{
    text-align: center;
  }

  .add-temple{
    color: #ffffff;
  }

  .add-tm{
    background: #0b75c9;
    color: #ffffff;
    padding: 0.3em 0.6em;
    border-radius: 5px;
    float: right;
    margin-top: -2em;
    margin-bottom: 1em;
    font-size: 1.5em;
  }

  .temples-table table{
    max-height: 100vh;
    overflow-y: scroll;
  }

</style>
