<template>

  <div id="app" v-cloak>

    <preloader/>
    <top_bar/>
    <main_banner/>
    <nav_bar/>
    <div class="container mt-5">

      <div id="about-content " class="about-content"  uk-scrollspy="cls: uk-animation-fade; repeat:true;">
        <p  v-html="details.description">

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

    export default {
      components: {
        "top_bar":Top_bar,
        "main_banner":Main_banner,
        "nav_bar":Nav_bar,
        "site_details":site_Details,
        "preloader":preloader,
      },

      created () {
        this.getDetails();
      },

      data() {
        return {
          details:{
            description:'',
          }
        }
      },

      methods:{
        getDetails()
        {
          this.$http.get('http://localhost:8000/api/getSiteDetails')
            .then(function (response) {
              this.details = response.body.details;
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
