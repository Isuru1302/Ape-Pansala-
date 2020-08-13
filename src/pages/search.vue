<template>
  <div id="app">

    <top_bar/>
    <main_banner/>
    <nav_bar/>

      <div class="container article-area mt-1">

        <div class="" style="text-align: center;margin:0em auto;" v-if="checkSearch===false">

          <h5 style="text-transform: uppercase"><b>Search Results</b></h5>
          <p><b>No Results Have Been Found</b></p>

        </div>

        <div class="" style="margin:2em auto;" v-if="checkSearch===true">
          <div class="container">
            <div class="row">
              search results for {{searchWord}}
            </div>
          </div>

        <div class="row ar-area">


          <div v-for="result in searchResults" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;">
            <router-link :to="{ path: '/article', query: { id: result.id }}">
              <div class="ar-article">

                <b-card body-class="templescard"
                        :img-src='result.img1'
                        img-alt="Image"
                        img-top
                        tag="article"
                        style="max-width: 20rem;min-height: 13em;"
                        class="mb-2"
                        img-width="100%"
                        img-height="120"
                >
                  <b-card-text>
                    <p class="" style="text-align: center;margin-top: -1em" v-if="result.temple_name">{{result.temple_name.substr(0,35)}}</p>
                    <p class="" style="text-align: center;margin-top: -1em" v-if="result.article_title">{{result.article_title.substr(0,35)}}</p>
                  </b-card-text>


                </b-card>
              </div>
            </router-link>
          </div>
        </div>

<!--        <div class="pagination" style="display:none;">-->
<!--          <b-pagination-->
<!--            v-model="currentPage"-->
<!--            :total-rows="rows"-->
<!--            :per-page="perPage"-->
<!--            first-text="First"-->
<!--            prev-text="Prev"-->
<!--            next-text="Next"-->
<!--            last-text="Last"-->
<!--          ></b-pagination>-->

<!--        </div>-->


      </div>


    </div>

    <site_details/>

  </div>

</template>

<script>
  import Top_bar from "../components/topbar";
  import Main_banner from "../components/mainbanner";
  import Nav_bar from "../components/navbar";
  import site_Details from "../components/siteDetails";
  import router from '../router'
  export default {
    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":site_Details
    },

    data(){
      return{
        checkSearch:false,
        searchWord:"",
        searchResults:[]
      }
    },

    created () {
      this.searchCheck();
    },

    mounted () {
      this.searchCheck();
    },

    watch:{
      $route (to, from){
        this.searchCheck();
      }
    },

    methods:{

      searchCheck(){

        var sQueryLength = Object.keys(this.$route.query).length;
        if(sQueryLength<1){
          this.checkSearch=false;

        }else{
          var sQuery = (this.$route.query.s);

          if(sQuery){
            this.checkSearch=true;
            this.searchWord = sQuery;
            this.getSearchResults();
          }else {
            this.checkSearch=false;
          }
        }
      },

      getSearchResults(){
        this.$http.get('http://localhost:8000/api/getSearchResults/'+this.$route.query.s)
          .then(function (response) {
            this.searchResults = response.body.search;
            console.log(this.searchResults)
          });
      },

    }
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

  .card-title{
    font-size: 15px;
    color: black;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
  }

  .card-text{
    font-size: 14px;
  }

  .card-img-top{
    height: 8.5em!important;
  }

  .card-body{
    height:4em!important;
  }
</style>
