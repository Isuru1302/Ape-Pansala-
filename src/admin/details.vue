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

            <li class="nav-item   ">
              <router-link to="/adminContacts" class="nav-link admin-nav-link" >
                <i class="material-icons"></i>
                <p>Contact</p>
              </router-link>
            </li>

            <li class="nav-item active ">
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
              <a class="navbar-brand" href="javascript:;">Details</a>
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

            <div class="site-details-area">

              <form @submit.prevent="adDetails">

                Address:
                <input type="text" v-model="site_details.address" >

                <br><br>
                Tp Number:
                <input type="text" v-model="site_details.tp_number">

                <br><br>
                Email:
                <input type="email" v-model="site_details.email">

                <br><br>
                Facebook:
                <input type="text" v-model="site_details.facebook">

                <br><br>
                Twitter:
                <input type="text" v-model="site_details.twitter">

                <br><br>
                Youtube:
                <input type="text" v-model="site_details.youtube">

                <br><br>
                Instagram:
                <input type="text" v-model="site_details.instagram">

                <br><br>
                Details:
                <ckeditor :editor="editor" v-model="site_details.description"></ckeditor>

                <input type="submit" id="subbtn" value="Add" class="mt-4">

              </form>

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
        editor: ClassicEditor,
        site_details: {
          address:'',
          email:'',
          facebook:'',
          youtube:'',
          twitter:'',
          instagram:'',
          tp_number:'',
          description:'',
        },

      }
    },

    created () {
      this.checkUser();
      this.getDetails();

    },

    methods:{

      getDetails()
      {
        this.$http.get('http://localhost:8000/api/getSiteDetails')
          .then(function (response) {
            this.site_details = response.body.details;
          })
      },

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
        this.$router.push('/login');
      },

      adDetails(){

        this.$http.post('http://localhost:8000/api/addDetails',this.site_details)
        .then(function (response) {
          alert("Successfully updated!!");
        });
      }

    }
  }


</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .site-details-area input,.site-details-area textarea{
    width: 100%;
    border-radius: 5px;
    padding: 0.1em 0.5em;
    border:1px solid #dddddd;
    margin-top: 0.1em ;
  }
</style>
