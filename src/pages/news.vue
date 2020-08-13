<template>

  <div id="app" v-cloak>

    <preloader/>
    <top_bar/>
    <main_banner/>
    <nav_bar/>
    <div class="container mt-5">

      <div id="about-content " class="about-content"  uk-scrollspy="cls: uk-animation-fade; repeat:true;">
        <h4 style="text-align: center"><b>{{news.title}}</b></h4>
        <p  v-html="news.description">

        </p>
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
  import preloader from '../components/preloader'
  import router from '../router'

  export default {
    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":site_Details,
      "preloader":preloader,
    },

    created () {
      this.getNews();
    },

    data() {
      return {
        news:{
          title:'',
          description:'',

        },
      }
    },

    methods:{
      getNews()
      {

        this.$http.get('http://localhost:8000/api/news/'+this.$route.query.id)
          .then(function (response) {
            if (response.body.news){
              this.news = response.body.news;
            }else{
              router.push('/NotFound');
            }

          })
      },
    }
  }
</script>

<style scoped>

  .about-content{
    background: #eeeeee;
    padding: 4em;
    border-radius: 5px;
    border:1px solid #ddd;
  }



</style>
