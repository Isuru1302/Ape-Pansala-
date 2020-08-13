<template>
  <div id="app" v-cloak>

    <top_bar/>
    <main_banner/>
    <nav_bar/>

    <div class="container article-area mt-4">

      <div class="uk-margin" style="float: right">
        <form class="uk-search uk-search-default">
          <a href="" class="uk-search-icon-flip" uk-search-icon></a>
          <input class="uk-search-input" type="search" id="searchWord" placeholder="Keyword..." @input="searchVideo">
        </form>
      </div>

      <div class="row ar-area" >

      <template v-if="searchKeyLength<1">
        <div class="nothingToShow" v-if="!videos.length">No Videos to show</div>

        <div  v-for="video in videos.slice(startValue,endValue)" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;">

            <div class="ar-article">

<!--              <b-card body-class="templescard"-->

<!--                      img-alt="Image"-->
<!--                      img-top-->
<!--                      tag="article"-->
<!--                      style="max-width: 20rem;min-height: 13em;"-->
<!--                      class="mb-2"-->
<!--                      img-width="100%"-->
<!--                      img-height="120"-->
<!--              >-->
<!--                -->
<!--                <b-card-text>-->
<!--                  <p class="" style="text-align: center;margin-top: -1em">{{video.title.substr(0,35)}}</p>-->
<!--                </b-card-text>
                      </b-card>-->

              <iframe width="100%" :src="video.url" allowfullscreen></iframe>
              <p class="" style="text-align: center;margin-top: 0em">{{video.title.substr(0,35)}}</p>
            </div>

        </div>
      </template>

      <template  v-if="searchKeyLength>1">
        <div class="nothingToShow" v-if="!searchRes.length">No Videos to show</div>

        <div  v-for="video in searchRes" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;">

          <div class="ar-article">

            <!--              <b-card body-class="templescard"-->

            <!--                      img-alt="Image"-->
            <!--                      img-top-->
            <!--                      tag="article"-->
            <!--                      style="max-width: 20rem;min-height: 13em;"-->
            <!--                      class="mb-2"-->
            <!--                      img-width="100%"-->
            <!--                      img-height="120"-->
            <!--              >-->
            <!--                -->
            <!--                <b-card-text>-->
            <!--                  <p class="" style="text-align: center;margin-top: -1em">{{video.title.substr(0,35)}}</p>-->
            <!--                </b-card-text>
                                  </b-card>-->

            <iframe width="100%" :src="video.url" allowfullscreen></iframe>
            <p class="" style="text-align: center;margin-top: 0em">{{video.title.substr(0,35)}}</p>
          </div>

        </div>
      </template>
      </div>


      <template v-if="searchKeyLength<1">
        <div class="pagination" v-if="totalPages>1 ">
          <b-pagination
            v-model="currentPage"
            :total-rows="videos_length"
            :per-page="itemPerPage"
            first-text="First"
            prev-text="Prev"
            next-text="Next"
            last-text="Last"
            @input="updateValues"
          ></b-pagination>

        </div>
     </template>

    </div>


    <site_details/>
  </div>


</template>

<script>
  import Top_bar from "../components/topbar";
  import Main_banner from "../components/mainbanner";
  import Nav_bar from "../components/navbar";
  import site_Details from "../components/siteDetails";

  export default {
    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":site_Details
    },

    data(){
      return{
        currentPage: 1,
        videos:[],
        searchKeyLength:0,
        searchRes:[],

        videos_length:0,
        itemPerPage:16,
        totalPages:0,
        startValue:0,
        endValue:0,
      }
    },

    created () {

      this.getVideos();

      if(this.currentPage===1){
        this.endValue=this.itemPerPage;
        this.startValue=0;
      }
    },

    methods:{

      getVideos(){
        this.$http.get('http://localhost:8000/api/allvideos')
          .then(function (response) {
            this.videos = response.body.videoResults;
            this.countValues();
          })
      },

      countValues(){
        this.videos_length = this.videos.length;
        this.pagination(this.videos_length);
      },

      pagination(count){
        this.totalPages = Math.ceil(count/this.itemPerPage);
      },

      updateValues(){

        if(this.currentPage===1){
          this.endValue=this.itemPerPage;
          this.startValue=0;
        }else if (this.itemPerPage===1){
          this.endValue = (this.currentPage*this.itemPerPage);
          this.startValue = this.endValue-1;
        }else{
          this.endValue = (this.currentPage*this.itemPerPage)-1;
          this.startValue = (this.endValue-this.itemPerPage)+1;
        }
      },

      searchVideo(){
        var value = $('#searchWord').val();
        this.searchKeyLength = value.length;

        if(value.length>0) {
          this.$http.get('http://localhost:8000/api/searchVideo/' + value)
            .then(function (response) {
              this.searchRes = response.body.search;
            })
        }
      },

    },
  }
</script>

<style scoped>
  .article-area{
    background: #eeeeee;
    padding: 2em;
    border-radius: 5px;
    border:1px solid #ddd;

  }

  .article-area .ar-heading{
    font-weight: bold;
    text-align: center!important;
    width: 100%;
  }

  .ar-article{
    padding: 1em;
    cursor: pointer;
    background: #ffffff;
    transition: 0.5s;
    height: 15em;
  }

  .ar-article:hover{
    transform: scale(1.1);
  }

  .ar-area{
    width: 100%;
    padding: 1em;
    margin-left: 0.3em;
  }

  .ar-area h5{

    color: #1d68a7;
  }

  .pagination{
    margin: 0 auto;
  }

  .uk-search-default .uk-search-input{
    background: #ffffff;
  }


</style>
