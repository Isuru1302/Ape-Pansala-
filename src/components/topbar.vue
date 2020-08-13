<template>
  <div id="app">
    <div class="top-bar" id="top_bar">
      <div class="container-fluid">
        <div class="">

          <ul class="left-badges float-left">
            <li class="fb-icon" v-if="site_details.facebook">
              <a :href="site_details.facebook"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
            </li>
            <li class="twitter-icon" v-if="site_details.twitter">
              <a :href="site_details.twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </li>
            <li class="ytb-icon" v-if="site_details.youtube">
              <a :href="site_details.youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            </li>
            <li class="insta-icon" v-if="site_details.instagram">
              <a :href="site_details.instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </li>
          </ul>


          <ul class="right-badges" style="display: none">
            <li class="lg-sinhala">සිං</li>
          </ul>


        </div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {

    data(){
      return{
        site_details:{},
      }
    },

    created () {
      this.getDetails();
    },

    methods:{
      getDetails()
      {
        this.$http.get('http://localhost:8000/api/getSiteDetails')
          .then(function (response) {
            this.site_details = response.body.details;
          })
      },
    },
  }
</script>

<style scoped>
  .top-bar{
    position: absolute;
    z-index:999!important;
    background-color: #1aa3ff;
    height: 3em;
    line-height: 1.5em;
    color:#ffffff;
    margin-bottom: 0em!important;
    right: 0;
    top: 0;
    left: 0;
  }

  .left-badges{
    margin-top: -2px;

  }

  .left-badges li{
    list-style: none;
    float: left;
    padding: 1em 0.6em;
  }

  .left-badges li .fa{
    font-size: 20px;
    color:#ffffff;
  }

  .right-badges{
    margin-right: 1em;
    float: right;
  }

  .right-badges li{

    font-weight: bold;
    list-style: none;
    padding: 0em 0.1em;
    float: left;
    font-size: 18px;
  }
</style>
