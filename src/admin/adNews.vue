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

            <li class="nav-item  ">
              <router-link to="/directory" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>directory</p>
              </router-link>
            </li>

            <li class="nav-item ">
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

            <li class="nav-item  active ">
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
              <a class="navbar-brand" href="javascript:;">Directories</a>
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
              <form @submit.prevent="addNews" id="directoryAddForm">
                <p>Title:</p>
                <input type="text" v-model="upNews.title" required>
                <p>Description:</p>
                <ckeditor :editor="editor" v-model="upNews.description"  :config="editorConfig" required></ckeditor>


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
                  <th  class="col-4">Date</th>
                  <th  class="col-1">Edit</th>
                  <th  class="col-1">Delete</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="s_news in  news">
                  <td>{{s_news.id}}</td>
                  <td>{{s_news.title}}</td>
                  <td>{{s_news.updated_at}}</td>
                  <td style="cursor: pointer"><router-link :to="{ path: '/editNews', query: { id: s_news.id }}"><i class="fa fa-pencil"></i></router-link></td>
                  <td style="cursor: pointer" @click="deleteDirectory(s_news.id)">x</td>
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
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

  export default {


    data(){
      return{
        editor:ClassicEditor,
        editorConfig:{

        },
        news:[],
        upNews:{
          title:'',
          description:'',
        },
        render_table:1,
      }
    },

    created () {
      this.checkUser();
      this.getNews();
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

      getNews(){
        this.$http.get('http://localhost:8000/api/news')
          .then(function (response) {
            this.news = response.body.news;
          })
      },

      addNews(){

        this.$http.post("http://localhost:8000/api/addNews",this.upNews)
          .then(function (response) {
            $("#directoryAddForm")[0].reset();
            this.render_page();
          })
      },

      deleteDirectory(id){
        this.$http.delete("http://localhost:8000/api/deleteNews/"+id)
          .then(function (response) {
            this.render_page();
          })
      },

      render_page(){
        this.$forceUpdate();
        this.getNews();
        this.render_table +=1;
      },

    }
  }



</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .add-videos{
    border:3px double black;
    padding: 1em;
  }

  .add-videos input,.add-videos select{
    margin-top: -2em;
    width: 100%;

  }

  .add-videos select{
    border:1px solid grey;
  }

  .videos-table thead th,.videos-table  tbody td{
    text-align: center;
  }

  .videos-table{
    max-height: 25em;
    overflow-y: scroll;
  }

</style>
