<template>
  <div id="app" v-cloak>

    <top_bar/>
    <main_banner/>
    <nav_bar/>

    <div class="container article-area mt-4 " >

      <div class="row ar-area">

        <div class="nothingToShow" v-if="!articles.length">No Articles to show</div>

        <div v-for="article in articles.slice(startValue,endValue)" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;">
          <router-link :to="{ path: '/article', query: { id: article.id }}">
          <div class="ar-article">

            <b-card

              :title="article.article_title.substr(0,35)"
              :img-src='article.img1'
              img-alt="Image"
              img-top
              tag="article"
              style="max-width: 20rem;"
              class="mb-2 bcard"
            >
              <b-card-text>

              </b-card-text>


            </b-card>
          </div>
          </router-link>
        </div>

      </div>

      <div class="pagination" v-if="totalPages>1">
        <b-pagination
          v-model="currentPage"
          :total-rows="articles_length"
          :per-page="itemPerPage"
          first-text="First"
          prev-text="Prev"
          next-text="Next"
          last-text="Last"
          @input="updateValues"
        ></b-pagination>

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
        articles:[],

        articles_length:0,
        itemPerPage:16,
        totalPages:0,
        startValue:0,
        endValue:0,
      }
    },

    created () {
      this.getArticles();

      if(this.currentPage===1){
        this.endValue=this.itemPerPage;
        this.startValue=0;
      }
    },

    methods:{

        getArticles(){
          this.$http.get('http://localhost:8000/api/getArticles')
            .then(function (response) {
              this.articles = response.body.articles;
              this.countValues();
            })
        },

      countValues(){
        this.articles_length = this.articles.length;
        this.pagination(this.articles_length);
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
      }

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
    height: 6.5em!important;
  }

  .card-body{
    height:7em!important;
  }
</style>
