<template>
    <div id="app"  >

<!--      <div class="main-banner">-->
<!--        <img class="img-fluid" src="../images/mainbanner.jpg">-->
<!--      </div>-->

      <template>
        <div class="main-banner  uk-margin-remove uk-padding-remove" tabindex="-1" uk-slideshow="animation: scale;
          autoplay: true;autoplay-interval: 6000;pause-on-hover: false;finite: false">

          <ul class="uk-slideshow-items uk-margin-remove uk-padding-remove " >
            <li v-if="mainPage.img1">
              <img :src="mainPage.img1" alt="" class="img-fluid" uk-scrollspy="cls: uk-animation-kenburns; repeat: true">
            </li>
            <li v-if="mainPage.img2">
              <img :src="mainPage.img2" alt="" class="img-fluid uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true">
            </li>
            <li v-if="mainPage.img3">
              <img :src="mainPage.img3" alt="" class="img-fluid" uk-scrollspy="cls: uk-animation-kenburns; repeat: true">
            </li>
            <li v-if="mainPage.img4">
              <img :src="mainPage.img4" alt="" class="img-fluid uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true">
            </li>
            <li v-if="mainPage.img5">
              <img :src="mainPage.img5" alt="" class="img-fluid" uk-scrollspy="cls: uk-animation-kenburns; repeat: true">
            </li>
          </ul>


        </div>
      </template>

    </div>
</template>

<script>


    export default {
      data() {
        return {
          slide: 0,
          sliding: null,
          mainPage:{
            img1:'',
            img2:'',
            img3:'',
            img4:'',
            img5:'',
          },
        }
      },

      beforeMount () {
        this.getMainPage();
      },



      methods: {
        onSlideStart(slide) {
          this.sliding = true
        },
        onSlideEnd(slide) {
          this.sliding = false
        },

        getMainPage(){
          this.$http.get('http://localhost:8000/api/mainPage')
            .then(function (response) {
              this.mainPage = response.body.mainPage;
            })
        },
      }
    }
</script>

<style scoped>

  .main-banner{

    height: 34em;
    background: transparent;
  }

  .uk-slideshow-items{
    z-index: 99!important;
    position: absolute!important;
    width: 100%;
    height:31em;
    background: transparent;
    min-height: 0!important;
    right: 0;
    top: 3em;
    left: 0;

  }



  .uk-slideshow-items img{
    height:31em;
    width: 100%;

  }

  @media only screen and (max-width: 400px){
    .uk-slideshow-items {
      height: 15em;
    }

    .uk-slideshow-items img{
      height:15em;
    }

    .main-banner{
      height: 18em;
    }
  }

  @media only screen and (min-width: 401px) and (max-width: 600px) {
    .uk-slideshow-items {
      height: 17em;
    }

    .uk-slideshow-items img{
      height:17em;
    }

    .main-banner{
      height: 20em;
    }
  }

  @media only screen and (min-width: 601px) and (max-width: 1150px) {
    .uk-slideshow-items {
      height: 23em;
    }

    .uk-slideshow-items img{
      height:23em;
    }

    .main-banner{
      height:26em;
    }
  }


</style>
