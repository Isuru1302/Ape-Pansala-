<template>

  <div id="app">


    <b-navbar toggleable="lg" id="nav_bar" style="background-color: #1aa3ff!important;" type="dark" variant="info" v-bind:class="{'sticky':scrollPoint>500}">
    <!--<b-navbar-brand href="#">NavBar</b-navbar-brand>-->

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <router-link to="/" class="back-to-home"><i class="fa fa-home"></i></router-link>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-md-5">
          <b-nav-item ><router-link class="nav-path" to="/">Home</router-link></b-nav-item>
          <b-nav-item><router-link class="nav-path" to="/about">About Us</router-link></b-nav-item>
          <b-nav-item><router-link class="nav-path" to="/contact">Contact</router-link></b-nav-item>
          <b-nav-item><router-link class="nav-path" to="/temples">Temples</router-link></b-nav-item>
          <b-nav-item><router-link class="nav-path" to="/articles">Articles</router-link></b-nav-item>
          <b-nav-item><router-link class="nav-path" to="/videos">Videos</router-link></b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="nav-search ml-lg-auto">
          <form v-on:keydown.enter.prevent>
            <ul class="search-area">
              <li><b-form-input size="md" id="search_text" class="search-form-input"  :placeholder="searchWord"
                  @keypress="suggestions" @keydown="suggestions" @keyup="suggestions" @input="suggestions"></b-form-input></li>
              <li><b-button size="md" variant="light outline-light" @click="searchBtn" class=" my-sm-0 search-form-button"><i class="fa fa-search"></i></b-button></li>
              <ul class="suggestions-area" id="suggestions-area" v-if="searchResults.length>0" >
                <li v-for="result in searchResults.slice(0,2)">
                  <img :src="result.img1">
                  <p v-if="result.article_title" @click="goToSearchPage(result.id,'/article')">{{result.article_title.slice(0,35)}}...</p>
                  <p v-else-if="result.temple_name" @click="goToSearchPage(result.id,'/temple')">{{result.temple_name.slice(0,35)}}...</p>
                </li>
              </ul>
            </ul>
          </form>


        </b-navbar-nav>
      </b-collapse>
    </b-navbar>


    <div class="back-to-top" v-bind:class="{'hide':scrollPoint<720}">

        <button @click="scrollToTop"><i class="fa fa-arrow-up"></i></button>

    </div>
  </div>

</template>

<script>

    import router from '../router'

    export default {
      data() {
        return {
          scrollPoint: 0,
          searchWord:"Search...",
          sugWord:"",
          searchResults:[],
        }
      },

      mounted() {
        window.addEventListener('scroll', this.scrollPosition);
        this.getSearchWord();
      },

      created () {
        this.getSearchWord();
      },

      watch:{
        $route (to, from){
          this.getSearchWord();
        }
      },


        methods:{
        scrollPosition(){
          this.scrollPoint = window.pageYOffset
        },

        scrollToTop(){
          document.getElementById('top_bar').scrollIntoView();
        },
        searchBtn(){
          var searchText = $( "#search_text" ).val();
          router.push({path:"/search?s="+searchText});
        },

        suggestions(){
          this.sugWord = $("#search_text").val();

          if(this.sugWord.length>1){
            $("#suggestions-area").css("display", "block");
            this.$http.get('http://localhost:8000/api/getSearchResults/'+this.sugWord)
              .then(function (response) {
                this.searchResults = response.body.search;
                console.log(this.searchResults)
              });
          }else{
            $("#suggestions-area").css("display", "none");
          }
        },

        goToSearchPage(sId,pathTo){
          router.push({ path: pathTo, query: { id: sId } });
        },

        getSearchWord(){
          var sQueryLength = Object.keys(this.$route.query).length;
          if(sQueryLength<1){
            this.searchWord="Search...";

          }else{
            var sQuery = (this.$route.query.s);

            if(sQuery){
              this.searchWord=sQuery;
            }else {
              this.searchWord="Search...";
            }
          }
        },

      },



    }
</script>

<style scoped>

  .search-area li{
    list-style: none;
    float: left;
  }

  .nav-search{
    margin-left: -2.5em;
  }

  #nav-collapse{
    color: #fff!important;
    font-weight: bold;
    margin-right: 1em;
    font-size: 16px;
  }

  .nav-path{
    color: #fff!important;
    font-weight: bold;
    margin-right: 1em;
    text-decoration: none;
    font-size: 16px;
  }

  .search-form-input{
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .search-form-button{
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;

  }

  .sticky {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
  }

  .back-to-top{
    position: fixed;
    right: 0;
    margin-right: 1em;
    z-index: 999!important;
  }

  .back-to-top button{
    background: -webkit-linear-gradient(to right, #b3d9ff, #0066cc);
    background: linear-gradient(to right, #b3d9ff, #0066cc);
    padding: 1em;
    border-radius: 50%;
    transition: 1s;
    border: 1px solid blue;
    outline: 0;

  }

  .back-to-top:focus{
    outline-style: none;
  }

  .back-to-top button:hover{
    background: -webkit-linear-gradient(to right, #0066cc, #b3d9ff)!important;
    background: linear-gradient(to right, #0066cc, #b3d9ff)!important;;
  }

  .back-to-top .fa{
    color: #ffffff;
    font-size: 2em;
    font-weight: 100 ;
  }

  .hide{
    display: none!important;
  }

  .suggestions-area{
    display: none;
    position: absolute;
    margin-top: 2.3em;
    margin-left: -1.9em;
    width: 100%;
    z-index: 999;
  }

  .suggestions-area li {
    background: #ffffff;
    width: 100%;
    z-index: 999;
    border: 1px solid #ddd;
    padding: 0.5em;
    color: black;
    font-weight: 400;
    cursor: pointer;
  }

  .suggestions-area img{
    height: 3em;
    width: 4em;
    float: left;
    margin-right: 0.5em;
  }

  @media only screen and (min-width: 768px) {
    .suggestions-area{
      width:18.7em!important;
    }


  }

  @media only screen and (min-width: 992px) {
    .back-to-home{
      display: none!important;
    }
  }

  .back-to-home{
    color:#ffffff;
    border-style: double;
    border-color: #ffffff;
    padding: 0.25em 0.3em;
    border-radius: 50%;
    transition: 0.5s;
  }

  .back-to-home:hover {
    transform: scale(1.1);
  }


  .back-to-home i{
    font-size: 22px;
    color:#ffffff;
  }

</style>
