<template>

    <div id="app" v-cloak>

    <div class="wrapper">
      <div id="loader-wrapper" class="loader-wrapper" >

        <div id="loader">
          <p>LOADING</p>
          <div class="circ-one"></div><div class="circ-two"></div>
        </div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

      </div>


      <top_bar/>
      <main_banner/>
      <nav_bar/>

      <!--content area -->
      <div class="container content-main mt-5">
        <div class="row">

          <div class="col-12 col-md-7 col-lg-7 " uk-scrollspy="cls: uk-animation-slide-left; repeat: true;">
            <p class="content-area" v-html="details.description">

            </p>
          </div>


          <div class="col-12 col-md-5 col-lg-5 mr-0" style="padding-right: -1em;!important;" uk-scrollspy="cls: uk-animation-slide-right; repeat: true">

            <div class="" style="width: 100%!important;">
              <ul class="content-2-samples">


                <li class="mb-1" v-for="article in articles.slice(0,4)">
                  <router-link :to="{ path: '/article', query: { id: article.id }}">
                    <div class="row">
                      <img :src="article.img1" style="margin-left: -1.8em;">
                      <p class="content-2-samples-title text-center p-1 pr-2" style="text-align: center"><b>{{article.article_title.slice(0,20)}}...</b></p>
                    </div>
                  </router-link>
                </li>


              </ul>
            </div>

          </div>


        </div>
      </div>

      <!-- Content Area 2 -->
      <div class="container content-main "  uk-scrollspy="cls: uk-animation-fade; repeat: true;delay:200;">
        <div class="row">

          <div class="col-12 col-md-12 col-lg-7 ">
            <div class="row">
              <div class="col-12 col-md-8 mb-2">
                <div class="main-video-area mt-4" v-for="video in videos.slice(0,1)">
                  <div class="main-video">
                    <h5><strong><b>{{video.title}}</b></strong></h5>
                    <iframe width="100%" height="455"
                            :src="video.url">
                    </iframe>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="row">
                  <div class="col-4 col-md-12 mt-md-4 mb-1">
                    <div class="main-video1" v-for="video in videos.slice(1,2)">
                      <p><strong><b>{{video.title}}</b></strong></p>
                      <iframe width="100%" height="100"
                              :src="video.url">
                      </iframe>
                    </div>
                  </div>

                  <div class="col-4 col-md-12 mb-1">
                    <div class="main-video2"  v-for="video in videos.slice(2,3)">
                      <p><strong><b>{{video.title}}</b></strong></p>
                      <iframe width="100%" height="100"
                              :src="video.url">
                      </iframe>
                    </div>
                  </div>

                  <div class="col-4 col-md-12 mb-1">
                    <div class="main-video3" v-for="video in videos.slice(3,4)">
                      <p><strong><b>{{video.title}}</b></strong></p>
                      <iframe width="100%" height="100"
                              :src="video.url">
                      </iframe>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="col-12 col-md-12 col-lg-5 mr-0 section-area" style="padding-right: -1em;;overflow-x: hidden!important;margin-top: -0.5em"  uk-scrollspy="cls: uk-animation-fade; repeat: true;delay:200;">

              <h4 style="margin-top: 0.8em;text-align: center;color: #1aa3ff" class="mb-2">News</h4>

              <div class="news-item mb-2" v-for="s_news in news.slice(0,5)" @click="goToNews(s_news.id)">
                <h6><b>{{s_news.title}}</b></h6>
                <p><i>{{s_news.updated_at}}</i></p>
              </div>
          </div>


        </div>
      </div>

      <!-- Articles -->
      <div class="articles-area mt-3" >
        <div class="container">
          <h4>Temples in Sri Lanka</h4>
          <div class="row">

            <div v-for="temple in temples.slice(0,3)" class="col-6 col-sm-6 col-md-3 text-center article-div mb-sm-2 mb-2" uk-scrollspy="cls: uk-animation-slide-top; repeat: true;delay:200;">
              <router-link :to="{ path: '/temple', query: { id: temple.id }}">
                <div class="article">
                  <img :src='temple.img1' class="img-fluid mob-img">
                </div>
                <div class="article-title mt-3" style="height: 4em">
                  <h6>{{temple.temple_name.substr(0,26)}}</h6>
                </div>
              </router-link>
            </div>
          </div>
          <div class="more-btn">
            <router-link to="/videos">See More</router-link>
          </div>
        </div>
      </div>

      <div class="articles-area mt-3">
        <div class="container">
          <h4>Popular Articles</h4>
          <div class="row">

            <div v-if="articles1" class="col-6 col-sm-6 col-md-3 text-center article-div mb-sm-2 mb-2" uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;delay:200;">
              <router-link v-if="articles1.id" :to="{ path: '/article', query: { id: articles1.id }}">
                <div class="article">
                  <img v-if="articles1.img1" :src='articles1.img1' class="img-fluid mob-img">
                </div>
                <div class="article-title mt-3" style="height: 4em">
                  <h6 v-if="articles1.article_title">{{articles1.article_title.substr(0,26)}}</h6>
                </div>
              </router-link>
            </div>

            <div v-if="articles2" class="col-6 col-sm-6 col-md-3 text-center article-div mb-sm-2 mb-2" uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;delay:200;">
              <router-link v-if="articles2.id" :to="{ path: '/article', query: { id: articles2.id }}">
                <div class="article">
                  <img v-if="articles2.img1" :src='articles2.img1' class="img-fluid mob-img">
                </div>
                <div class="article-title mt-3" style="height: 4em">
                  <h6 v-if="articles2.article_title">{{articles2.article_title.substr(0,26)}}</h6>
                </div>
              </router-link>
            </div>

            <div v-if="articles3" class="col-6 col-sm-6 col-md-3 text-center article-div mb-sm-2 mb-2" uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;delay:200;">
              <router-link v-if="articles3.id" :to="{ path: '/article', query: { id: articles3.id }}">
                <div class="article">
                  <img v-if="articles3.img1" :src='articles3.img1' class="img-fluid mob-img">
                </div>
                <div class="article-title mt-3" style="height: 4em">
                  <h6 v-if="articles3.article_title">{{articles3.article_title.substr(0,26)}}</h6>
                </div>
              </router-link>
            </div>

            <div v-if="articles4" class="col-6 col-sm-6 col-md-3 text-center article-div mb-sm-2 mb-2" uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;delay:200;">
              <router-link v-if="articles4.id" :to="{ path: '/article', query: { id: articles4.id }}">
                <div class="article">
                  <img v-if="articles4.img1" :src='articles4.img1' class="img-fluid mob-img">
                </div>
                <div class="article-title mt-3" style="height: 4em">
                  <h6 v-if="articles4.article_title">{{articles4.article_title.substr(0,26)}}</h6>
                </div>
              </router-link>
            </div>
          </div>
          <div class="more-btn">
            <router-link to="/videos">See More</router-link>
          </div>
        </div>
      </div>

      <div class="directory-main articles-area mt-3" uk-scrollspy="cls: uk-animation-fade; repeat: true;delay:200;">
        <div class="container">
          <h4>List of Temples in Sri Lanka</h4>
          <div class="content-2-section col-12 " style="width: 100%;overflow-x: hidden">
            <!--              <h3 class="text-center">New Section</h3>-->
            <div class="table-responsive">
              <table class="table table-dark dTable" style="overflow-y: scroll;overflow-x: scroll">

                <thead>
                <tr>
                  <th class="col-4">Name</th>
                  <th  class="col-5">Address</th>
                  <th  class="col-5">District</th>
                  <th  class="col-3">Telephone</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="directory in  directoryResults.slice(0,5)">
                  <td>{{directory.name}}</td>
                  <td>{{directory.address}}</td>
                  <td>{{directory.district}}</td>
                  <td>{{directory.telephone}}</td>
                </tr>
                </tbody>

              </table>

            </div>
            <div class="fullD">
              <router-link to="/directories">Full Page >></router-link>
            </div>
          </div>
        </div>
      </div>

      <site_details/>

      </div>
    </div>
</template>

<script>
    import Top_bar from "../components/topbar";
    import Main_banner from "../components/mainbanner";
    import Nav_bar from "../components/navbar";
    import siteDetails from "../components/siteDetails";

      export default {

      data(){
        return{
          details:[],
          articles:[],
          temples:[],
          videos:[],
          visited:false,
          directoryResults:[],
          articles1:{},
          articles2:{},
          articles3:{},
          articles4:{},
          news:[],
        }
      },


        beforeMount () {
            setTimeout(function() {
              $('.wrapper').addClass('loaded');

            }, 3000);
        },

        beforeCreate () {

        },

        mounted () {
          this.$session.start();

          if(this.$session.get('load')){
            $('#loader-wrapper').hide();
          }else{
            this.$session.set('load',true);
          }

        },

        beforeDestroy () {
          window.addEventListener('unload', this.changeSession)
        },

        created () {
          this.getMainPage();
          this.getDetails();
          this.getArticles();
          this.getTemples();
          this.getVideos();
          this.getDirectory();
          this.getNews();
        window.addEventListener('unload', this.changeSession)
      },

      methods: {

        changeSession(event) {
          this.$session.set('load',false);
        },

        getDetails()
        {
          this.$http.get('http://localhost:8000/api/getSiteDetails')
            .then(function (response) {
              this.details = response.body.details;
            })
        },

        getArticles(){
          this.$http.get('http://localhost:8000/api/getArticles')
            .then(function (response) {
              this.articles = response.body.articles;
            })
        },

        getTemples(){
          this.$http.get('http://localhost:8000/api/getTemples')
            .then(function (response) {
              this.temples = response.body.temples;
            })
        },

        getVideos(){
          this.$http.get('http://localhost:8000/api/allvideos')
            .then(function (response) {
              this.videos = response.body.videoResults;
            })
        },

        getDirectory(){
          this.$http.get('http://localhost:8000/api/getAllDirectories')
            .then(function (response) {
              this.directoryResults = response.body.directories;
            })
        },

        getMainPage(){
          this.$http.get('http://localhost:8000/api/getPopularArticles')
            .then(function (response) {
              this.articles1 = response.body.articles1;
              this.articles2 = response.body.articles2;
              this.articles3 = response.body.articles3;
              this.articles4 = response.body.articles4;
            })
        },

        getNews(){
          this.$http.get('http://localhost:8000/api/news')
            .then(function (response) {
              this.news = response.body.news;
            })
        },

        goToNews(id){
          this.$router.push({ path: '/news', query: { id: id } })
        }

      },



      components: {
        "top_bar":Top_bar,
        "main_banner":Main_banner,
        "nav_bar":Nav_bar,
        "site_details":siteDetails
      },

    }


</script>

<style scoped>


  @import url(https://fonts.googleapis.com/css?family=Oxygen);
  @import url(http://weloveiconfonts.com/api/?family=entypo);

  .content-area{
    min-height: 21.5em;
  }

  .article-div .article{
    border:2px solid #00a5bb;
  }

  .main-video1 p,.main-video2 p,.main-video3 p{
    height: 4.2em!important;
  }

  .main-video1 iframe,.main-video2 iframe,.main-video3 iframe{
    height: 6em!important;
  }

  .more-btn{
    display: none;
    float: right;
    background: #00a5bb;
    color: #ffffff;
    font-weight: bold;
    padding: 1em;
    position: relative;
  }



  #loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
  }

  #loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;


    z-index: 1001;
    animation: spin 2s linear infinite;


  &:before {
     content: "";
     position: absolute;
     top: 5px;
     left: 5px;
     right: 5px;
     bottom: 5px;
     border-radius: 50%;
     animation: spin 3s linear infinite;
   }

  &:after {
     content: "";
     position: absolute;
     top: 15px;
     right: 15px;
     left: 15px;
     bottom: 15px;
     border-radius: 50%;

   }
  }

  #loader-wrapper .loader-section {
    position: fixed;
    top: 0;
    width: 51%;
    height: 100%;
    background-color: lightblue;

    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-blend-mode: multiply;
    z-index: 1000;
    transform: translateX(0);
  }

  #loader-wrapper .loader-section.section-left {
    left: 0;
  }

  #loader-wrapper .loader-section.section-right {
    right: 0;
  }

  #loader {
    display: block;
    width: 100px;
    height: 100px;
    margin: 50 auto;
  }

  .circ-one {
    position: relative;
    display: block;
    width: 50px;
    height: 50px;
    background: rgba(217,91,67,1);
    border-radius: 100%;
    float: left;
    animation: load-x 1s cubic-bezier(0.445, 0.100, 0.550, 0.900) infinite;
  }

  .circ-two {
    position: relative;
    display: block;
    width: 50px;
    height: 50px;
    background: rgba(84,36,55,1);
    border-radius: 100%;
    float: right;
    animation: load-y 1s cubic-bezier(0.445, 0.100, 0.550, 0.900) infinite;
  }

  @keyframes load-x {
    0%   { left: -10px; transform: scale(1); }
    25%  { transform: scale(1.5); z-index: 2; }
    50%  { left: 60px; transform: scale(1); }
    75%  { transform: scale(0.5); z-index: 1; }
    100% { left: -10px; transform: scale(1); }
  }

  @keyframes load-y {
    0%   { right: -10px; transform: scale(1); }
    25%  { transform: scale(0.5); }
    50%  { right: 60px; transform: scale(1); z-index: 1; }
    75%  { transform: scale(1.5); z-index: 2; }
    100% { right: -10px; transform: scale(1); }
  }

  #loader p {
    text-align: center;

    font-weight: 50;
    color:rgba(192,41,66,1);
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes pulse {
    50% { opacity: 0.5; }
  }

     .loaded #loader-wrapper .loader-section.section-left {
       transform: translateY(-100%);
       transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
     }

  .loaded #loader-wrapper .loader-section.section-right {
    transform: translateY(100%);
    transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
  }

  .loaded #loader {
    opacity: 0;
    transition: all 0.3s ease-out;
  }

  .loaded #loader-wrapper {
    visibility: hidden;
    transform: translateX(-100%);
    transition: all 0.3s 1s ease-out;
  }


  [class*="entypo-"]:before {
    font-family: 'entypo', sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  .preload * {
    transition: none !important;
  }


  .fullD{
    float: right;
    background: #0b75c9;
    color: #ffffff;
    font-weight: bold;
    padding: 0.5em 0.7em;
    transition: 0.5s;
    border:1px solid #0b75c9;
    border-radius: 4px;
    margin-bottom: 0em!important;
  }

  .fullD:hover{
    transform: scale(1.1);
  }

  .cusHR{
    border: 0.01em solid #1aa3ff;
  }

  @media only screen and (max-width: 400px) {
    .mob-img{
      height: 5em!important;
    }
  }

  .news-item{
    background: #1D68A7;
    height: 4em;
    padding: 0.5em;
    color: #ffffff;
    cursor: pointer;
  }

  .news-item h6{
    color: #ffffff!important;
  }

  .news-item p{
    float: right;
  }

  .table-dark{
    background-color: #1AA3FF!important;
  }

  .table-dark td, .table-dark th, .table-dark thead th{
    border-color: #ffffff!important;
  }

</style>
