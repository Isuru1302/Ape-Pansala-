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

            <li class="nav-item  ">
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

            <li class="nav-item active ">
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
              <a class="navbar-brand" href="javascript:;">Videos</a>
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


            <div class="add-videos">
                <form @submit.prevent="addVideo" id="videoaddform">
                    <p>title:</p>
                    <input type="text" ref="v_title" id="vtitle" name="vtitle" v-model="videos.title" required>
                    <p>Url:</p>
                    <input type="text" ref="v_url" id="vurl" name="vurl" v-model="videos.url" required>
                    <br>
                    <input type="submit" value="Add" class="mt-3">
                </form>
            </div>

            <div class="videos-table table-responsive mt-4">

              <h5 style="text-align: center">Avialable videos</h5>
              <table class="table table-dark" :key="render_table">
                <thead>
                  <tr>
                    <th  class="col-1">Id</th>
                    <th class="col-5">Title</th>
                    <th  class="col-5">Url</th>
                    <th  class="col-1">Delete</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="result in  videoResults">
                    <td>{{result.id}}</td>
                    <td>{{result.title}}</td>
                    <td>{{result.url}}</td>
                    <td style="cursor: pointer" @click="deleteVideo(result.id)">x</td>
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

        videos:{
          title:'',
          url:'',
        },
        videoResults:[],
        render_table:1,

      }
    },

    created () {
      this.checkUser();
      this.getVideo();
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

      getVideo(){
          this.$http.get('http://localhost:8000/api/allvideos')
            .then(function (response) {

              this.videoResults = response.body.videoResults;
            })
      },

      addVideo(){

        this.$http.post("http://localhost:8000/api/addvideos",this.videos)
          .then(function (response) {
            this.resetTable();
            this.render_page();
          })
      },

      deleteVideo(id){
        this.$http.delete("http://localhost:8000/api/deleteVideo/"+id)
        .then(function (response) {
          this.render_page();
        })
      },

      render_page(){
        this.$forceUpdate();
        this.getVideo();
        this.render_table +=1;
      },

      resetTable(){
        document.getElementById("videoaddform").reset();
      }
    }
  }



</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .add-videos{
    border:3px double black;
    padding: 1em;
  }

  .add-videos input{
    margin-top: -2em;
    width: 100%;
  }

  .videos-table thead th,.videos-table  tbody td{
    text-align: center;
  }

  .videos-table{
    max-height: 25em;
    overflow-y: scroll;
  }

</style>
