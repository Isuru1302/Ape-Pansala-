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

            <li class="nav-item  ">
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
              <a class="navbar-brand" href="javascript:;">Add Temples</a>
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


            <form @submit.prevent="upArticle" class="addarticle-table">

              <p>Article Title:</p>
              <input type="text" v-model="single_article.article_title" >

              <p>Article Content:</p>
              <ckeditor :editor="editor" v-model="single_article.article_content" ></ckeditor>

              <p>Image 1:</p>
              <img v-if="single_article.img1" class="form-img" :src="single_article.img1">
              <input type="file" accept="image/*" @change="getImage1($event)">

              <p>Image 2:</p>
              <img v-if="single_article.img2" class="form-img" :src="single_article.img2">
              <input type="file" accept="image/*" @change="getImage2($event)" >

              <p>Image 3:</p>
              <img v-if="single_article.img3" class="form-img" :src="single_article.img3">
              <input type="file" accept="image/*" @change="getImage3($event)">

              <p>Image 4:</p>
              <img v-if="single_article.img4" class="form-img" :src="single_article.img4">
              <input type="file"  accept="image/*" @change="getImage4($event)">


              <input type="submit" value="Add" class="mt-3">
            </form>

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

        single_article:{
          article_title:'',
          article_content:'',
          img1:'',
          img2:'',
          img3:'',
          img4:'',
        },

      }
    },

    created () {
      this.checkUser();
      this.getArticle();
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

      upArticle(){
        this.$http.post('http://localhost:8000/api/upArticle/'+this.$route.query.id,this.single_article)
          .then(function (response) {
            this.$router.push({ path: '/adminArticles' });
          })
      },

      getArticle() {
        this.$http.get('http://localhost:8000/api/getArticles/'+this.$route.query.id)
          .then(function (response) {
            this.single_article = response.body.article;
          })
      },

      getImage1(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.single_article.img1 = e.target.result;
        }

      },

      getImage2(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.single_article.img2 = e.target.result;
        }
      },

      getImage3(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.single_article.img3 = e.target.result;
        }
      },

      getImage4(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.single_article.img4 = e.target.result;
        }
      },


    }
  }


</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .articles-table thead th,.articles-table  tbody td{
    text-align: center;
  }

  .addarticle-table input,.addarticle-table select{
    width: 100%;
    margin-top: -1em;
    margin-bottom: 0.5em;
    border:1px solid #dddddd;
    padding: 0.3em;
    border-radius: 5px;
  }

  .form-img{
    height: 5em;
    margin-top: -0.5em;
    margin-bottom: 0.8em;
  }

</style>
