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
              <li class="nav-item active  ">

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
                <a class="navbar-brand" href="javascript:;">Dashboard</a>
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

              <h4><b>Main Page</b></h4>
              <br>

              <form @submit.prevent="submitForm">
                <h5>Main Banner</h5>

                <p>Image1: </p>
                <img v-if="mainPage.img1" class="form-img" :src="mainPage.img2">
                <input type="file" accept="image/*" @change="getImage1($event)" >

                <p>Image2: </p>
                <img v-if="mainPage.img2" class="form-img" :src="mainPage.img2">
                <input type="file" accept="image/*" @change="getImage2($event)">

                <p>Image3: </p>
                <img v-if="mainPage.img3" class="form-img" :src="mainPage.img3">
                <input type="file" accept="image/*" @change="getImage3($event)" >

                <p>Image4: </p>
                <img v-if="mainPage.img4" class="form-img" :src="mainPage.img4">
                <input type="file" accept="image/*" @change="getImage4($event)" >

                <p>Image5: </p>
                <img v-if="mainPage.img5" class="form-img" :src="mainPage.img5">
                <input type="file" accept="image/*" @change="getImage5($event)" >

                <h5 class="mt-4">Popular Articles</h5>

                <p>Article1: </p>
                <select v-model="mainPage.art1">
                  <option value="0" v-if="mainPage.art1===0">-- Select --</option>
                  <option value="0">-- Select --</option>
                  <option v-for="article in articles" :value="article.id">{{article.article_title}}</option>
                </select>

                <p>Article2: </p>
                <select v-model="mainPage.art2">
                  <option value="0" v-if="mainPage.art2===0">-- Select --</option>
                  <option value="0">-- Select --</option>
                  <option v-for="article in articles" :value="article.id">{{article.article_title}}</option>
                </select>

                <p>Article3: </p>
                <select v-model="mainPage.art3">
                  <option value="0" v-if="mainPage.art3===0">-- Select --</option>
                  <option value="0">-- Select --</option>
                  <option v-for="article in articles" :value="article.id">{{article.article_title}}</option>
                </select>

                <p>Article4: </p>
                <select v-model="mainPage.art4">
                  <option value="0" v-if="mainPage.art4===0">-- Select --</option>
                  <option value="0">-- Select --</option>
                  <option v-for="article in articles" :value="article.id">{{article.article_title}}</option>
                </select>

                <input type="submit" value="submit">
              </form>

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
        articles:{
        },
        mainPage:{
          img1:'',
          img2:'',
          img3:'',
          img4:'',
          img5:'',
          art1:'',
          art2:'',
          art3:'',
          art4:'',
        },
      }
    },

    created () {
      this.checkUser();
      this.getArticles();
      this.getMainPage();
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

      getMainPage(){
        this.$http.get('http://localhost:8000/api/mainPage')
          .then(function (response) {
            this.mainPage = response.body.mainPage;
          })
      },

      getArticles(){
        this.$http.get('http://localhost:8000/api/getArticles')
          .then(function (response) {
            this.articles = response.body.articles;
          })
      },

      submitForm(){
        this.$http.post('http://localhost:8000/api/updateMainPage',this.mainPage)
          .then(function (response) {
            alert('successfully updated!!');
          })
      },

      getImage1(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.mainPage.img1 = e.target.result;
        }

      },

      getImage2(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.mainPage.img2 = e.target.result;
        }
      },

      getImage3(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.mainPage.img3 = e.target.result;
        }
      },

      getImage4(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.mainPage.img4 = e.target.result;
        }
      },

      getImage5(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.mainPage.img5 = e.target.result;
        }
      },

    }
  }


</script>

<style scoped>
    @import "../../static/styles/material-dashboard.css";

    .form-img{
      height: 5em;
      margin-top: -0.5em;
      margin-bottom: 0.8em;
    }
</style>
