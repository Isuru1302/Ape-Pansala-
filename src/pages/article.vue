<template>
    <div class="app" v-cloak>

      <top_bar/>
      <main_banner/>
      <nav_bar/>


      <div class="container article-area mt-4" uk-scrollspy="cls: uk-animation-fade; repeat: true;">
        <div class="row">
            <h4 class="ar-heading">{{singlearticle.article_title}}</h4>

              <p class="article-content m-4" v-html="singlearticle.article_content">

              </p>

          <div class="article-images">

            <div uk-grid uk-lightbox="animation: slide">
                <div  class="row">

                  <div class="col-12 col-sm-6 col-md-3 img-div mb-4" v-if="singlearticle.img1">
                    <a class="uk-inline" :href="singlearticle.img1">
                      <img :src="singlearticle.img1">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-3 img-div mb-4" v-if="singlearticle.img2">
                    <a class="uk-inline" :href="singlearticle.img2">
                      <img :src="singlearticle.img2">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-3 img-div mb-4" v-if="singlearticle.img3">
                    <a class="uk-inline" :href="singlearticle.img3">
                      <img :src="singlearticle.img3">
                    </a>
                  </div>

                  <div class="col-12 col-sm-6 col-md-3 img-div mb-4" v-if="singlearticle.img4">
                    <a class="uk-inline" :href="singlearticle.img4">
                      <img :src="singlearticle.img4">
                    </a>
                  </div>

                </div>
            </div>

          </div>

        </div>
        <iframe
          :src="'https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.localhost%3A8080%2Farticle%3Fid%3D'+singlearticle.id+'&layout=button_count&size=small&width=78&height=20&appId'"
          width="78" height="20" class="mb-4 float-right" style="border:none;overflow:hidden;position:relative; float:right!important;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media">
        </iframe>

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
          singlearticle:{}

        }
      },

      created () {
        this.getArticle();
      },

      methods:{
        scrollToElement() {
          const el = this.$el.getElementsByClassName('ar-heading')[0];

          if (el) {
            el.scrollIntoView();
          }
        },

        getArticle(){



          this.$http.get('http://localhost:8000/api/getArticles/'+this.$route.query.id)
            .then(function (response) {
              if(response.body.article){
                this.singlearticle = response.body.article;
              }else{
                router.push('/NotFound');
              }

            })
        },
      },

      mounted() {
        this.scrollToElement();
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

  .article-images{
    width: 100%!important;
  }

  .article-images img{
    border:3px solid #1d68a7;
    height: 10em!important;
    cursor: pointer;
    transition: 0.5s;
    width: 15em!important;
  }

  .img-div{
    text-align: center;
  }

  .article-images img:hover{
    color: #424242;
    -webkit-transition: all .3s ease-in;
    -moz-transition: all .3s ease-in;
    -ms-transition: all .3s ease-in;
    -o-transition: all .3s ease-in;
    transition: all .3s ease-in;
    opacity: 1;
    transform: scale(1.15);
    -ms-transform: scale(1.15); /* IE 9 */
    -webkit-transform: scale(1.15); /* Safari and Chrome */
  }



  @media only screen and (min-width: 768px) {
    .article-images img{
      width:25em!important;
    }
  }

</style>
