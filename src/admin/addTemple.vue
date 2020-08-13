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

            <li class="nav-item  active">
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


            <form @submit.prevent="addTemple" class="addtemple-table">

              <p>Temple Name:</p>
              <input type="text" v-model="temple_details.temname" required>

              <p>Temple Location:</p>
              <input type="text" v-model="temple_details.loca" required>

              <p>Temple Address:</p>
              <input type="text" v-model="temple_details.addr" required>

              <p>Temple District:</p>
              <select v-model="temple_details.district" required>
                <option value="">-- Select District -- </option>
                <option v-for="district in districts" :value="district">{{district}}</option>
              </select>

              <p>Description:</p>
              <ckeditor :editor="editor" v-model="temple_details.dis"  :config="editorConfig" required></ckeditor>

              <p>Image 1:</p>
              <input type="file" accept="image/*" @change="getImage1($event)">

              <p>Image 2:</p>
              <input type="file" accept="image/*" @change="getImage2($event)" >

              <p>Image 3:</p>
              <input type="file" accept="image/*" @change="getImage3($event)">

              <p>Image 4:</p>
              <input type="file"  accept="image/*" @change="getImage4($event)">

              <p>Image 5:</p>
              <input type="file" accept="image/*"  @change="getImage5($event)">

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
        editorConfig:{

        },
        temple_details:{
          temname:'',
          loca:'',
          addr:'',
          district:'',
          dis:'',
          img1:'',
          img2:'',
          img3:'',
          img4:'',
          img5:'',
        },
        districts:['Ampara','Anuradhapura','Badulla','Batticaloa','Colombo','Galle','Gampaha','Hambantota',
          'Jaffna','Kalutara','Kandy','Kegalle','Kilinochchi','Kurunegala','Mannar','Matale',
          'Matara','Moneragala','Mullaitivu','Nuwara Eliya','Polonnaruwa','Puttalam','Ratnapura',
          'Trincomalee','Vavuniya'],
      }
    },

    created () {
      this.checkUser();

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

      addTemple(){
        this.$http.post('http://localhost:8000/api/addTemples',this.temple_details)
        .then(function (response) {
          this.$router.push({ path: '/adminTemple' });
        })
      },

      getImage1(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.temple_details.img1 = e.target.result;
        }

      },

      getImage2(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.temple_details.img2 = e.target.result;
        }
      },

      getImage3(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.temple_details.img3 = e.target.result;
        }
      },

      getImage4(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.temple_details.img4 = e.target.result;
        }
      },

      getImage5(e){
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = (e)=>{
          this.temple_details.img5 = e.target.result;
        }
      },

    }
  }


</script>

<style scoped>
  @import "../../static/styles/material-dashboard.css";

  .temples-table thead th,.temples-table  tbody td{
    text-align: center;
  }

  .addtemple-table input,.addtemple-table select{
    width: 100%;
    margin-top: -1em;
    margin-bottom: 0.5em;
    border:1px solid #dddddd;
    padding: 0.3em;
    border-radius: 5px;
  }



</style>
