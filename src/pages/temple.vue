<template>

  <div id="app" v-cloak>
    <top_bar/>
    <main_banner/>
    <nav_bar/>

    <div class="temple-details-area mt-4 mb-4" uk-scrollspy="cls: uk-animation-fade; repeat: true;">

      <div class="container">

        <div class="row">
          <div class=" col-sm-12 col-md-8 ">

            <div class="details-area" >

              <h3>{{temple.temple_name}}</h3>

              <iframe
                :src="'https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.localhost%3A8080%2Ftemple%3Fid%3D'+temple.id+'&layout=button_count&size=small&width=78&height=20&appId'"
                width="78" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media">
              </iframe>


              <p v-html="temple.temple_des"> </p>

            </div>

            <hr class="uk-divider-icon">

            <div class="similar-temple-images" style="display:none;">

              <div class="container">
                <div class="row">

                  <div class="col-6 col-sm-6 col-md-3 mb-sm-2 mb-2 mb-md-0" v-for="n in 2">

                    <img src="static/articleImages/mainbanner.jpg" class="img-fluid" >

                  </div>

                  <div class="col-6 col-sm-6 col-md-3 mb-sm-2 mb-2 mb-md-0" v-for="n in 2">

                    <img src="static/articleImages/sample1.jpg" class="img-fluid" >

                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class=" col-sm-12 col-md-4 right-area" >

            <h5 style="text-align: center">Images of {{temple.temple_name}}</h5>
            <div uk-grid uk-lightbox="animation: slide" >
                <div class="row">

                  <div class="col-12 col-sm-6 col-md-12 mb-2 temple-image-area" v-if="temple.img1">
                    <a class="uk-inline " :href="temple.img1">
                      <img :src="temple.img1" class="temple-images">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-12 mb-2 temple-image-area" v-if="temple.img2">
                    <a class="uk-inline" :href="temple.img2">
                      <img :src="temple.img2" class="temple-images">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-12 mb-2 temple-image-area" v-if="temple.img3">
                    <a class="uk-inline" :href="temple.img3">
                      <img :src="temple.img3" class="temple-images">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-12 mb-2 temple-image-area" v-if="temple.img4">
                    <a class="uk-inline" :href="temple.img4">
                      <img :src="temple.img4" class="temple-images">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-12 temple-image-area" v-if="temple.img5">
                    <a class="uk-inline" :href="temple.img5">
                      <img :src="temple.img5" class="temple-images">
                    </a>
                  </div>

                </div>
            </div>

            <hr class="uk-divider-icon">

            <div class="temple-map mt-3">

              <h5 style="text-align: center">Location to {{temple.temple_name}}</h5>

              <iframe
                v-bind:src='temple.temple_location'
                     frameborder="0" style="border:0;" height="300" width="100%"
                      allowfullscreen="" aria-hidden="false" tabindex="0"
              ></iframe>

            </div>
          </div>
        </div>



      </div>

    </div>

    <site_details/>
  </div>
</template>

<script>

  import Top_bar from "../components/topbar";
  import Main_banner from "../components/mainbanner";
  import Nav_bar from "../components/navbar";
  import site_Details from "../components/siteDetails"
  import router from '../router'

  export default {
    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":site_Details,
    },

    data(){
      return{
        temple:{},
      }
    },

    created () {
      this.getTemple();
    },

    methods:{

      getTemple(){
        this.$http.get('http://localhost:8000/api/getTemples/'+this.$route.query.id)
          .then(function (response) {

            if(response.body.temple){
              this.temple = response.body.temple;
            }else{
              router.push('/NotFound');
            }

          })
      },
    },


  }
</script>

<style scoped>

  .similar-temple-images img{
    width: 100%;
    border:3px solid #1d68a7;
    cursor: pointer;
    transition: 0.5s;
    height:7em;
  }

  .similar-temple-images img:hover{
    transform: scale(1.1);
    z-index: 99;
  }

  .temple-details-area{

  }

  .temple-details-area .container{
    background: #eeeeee;
    padding: 1em;
  }

  .temple-images{
    height: 10em;
    width: 15em!important;
  }

  .temple-image-area{
    text-align: center!important;
  }

  @media screen and (min-width: 576px) {
    .right-area{
      border-left:1px solid #dddddd;
    }
  }

</style>
