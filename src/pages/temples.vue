<template>
  <div id="app" v-cloak>

    <top_bar/>
    <main_banner/>
    <nav_bar/>

    <div class="container article-area mt-4">

      <div class="row ar-area">

        <div class="districts mb-3" uk-scrollspy="cls: uk-animation-fade; repeat: true;">
          <ul>
            <li @click="redirectPage('all')" v-bind:class="{'activePage':activePage==='All'}">All</li>
            <li v-for="district in districts" @click="redirectPage(district)"
                v-bind:class="{'activePage':activePage===district}">{{district}}</li>
          </ul>
        </div>
        <div class="nothingToShow" v-if="!temples.length && !activePage ">No Temples to show</div>
        <div class="nothingToShow" v-if="!temples2.length && activePage && activePage!=='All'">No Temples to show</div>
        <div v-if="!activePage || activePage==='All'" v-for="temple in temples.slice(startValue,endValue)" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;delay:200;">

          <router-link :to="{ path: '/temple', query: { id: temple.id }}">
            <div class="ar-article">

              <b-card body-class="templescard"
                :img-src='temple.img1'
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 20rem;min-height: 13em;"
                class="mb-2"
                img-width="100%"
                img-height="120"
              >
                <b-card-text>
                  <p class="" style="text-align: center;margin-top: -1em">{{temple.temple_name.substr(0,35)}}</p>
                </b-card-text>


              </b-card>
            </div>
          </router-link>
        </div>

        <div v-if="activePage" v-for="temple in temples2.slice(startValue,endValue)" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mb-2 ar"  uk-scrollspy="cls: uk-animation-slide-bottom; repeat: true;">

          <router-link :to="{ path: '/temple', query: { id: temple.id }}">
            <div class="ar-article">

              <b-card body-class="templescard"
                      :img-src='temple.img1'
                      img-alt="Image"
                      img-top
                      tag="article"
                      style="max-width: 20rem;min-height: 13em;"
                      class="mb-2"
                      img-width="100%"
                      img-height="120"
              >
                <b-card-text>
                  <p class="" style="text-align: center;margin-top: -1em">{{temple.temple_name.substr(0,35)}}</p>
                </b-card-text>


              </b-card>
            </div>
          </router-link>
        </div>

      </div>

      <div class="pagination" v-if="totalPages>1">
        <b-pagination
          v-model="currentPage"
          :total-rows="temple_length"
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
        temples:[],
        temples2:[],
        districts:['Ampara','Anuradhapura','Badulla','Batticaloa','Colombo','Galle','Gampaha','Hambantota',
                    'Jaffna','Kalutara','Kandy','Kegalle','Kilinochchi','Kurunegala','Mannar','Matale',
                    'Matara','Moneragala','Mullaitivu','Nuwara Eliya','Polonnaruwa','Puttalam','Ratnapura',
                    'Trincomalee','Vavuniya'],
        activePage:"All",
        refreshPage:1,


        temple_length:0,
        itemPerPage:16,
        totalPages:0,
        startValue:0,
        endValue:0,
      }
    },

    created () {
      this.activePage='all';
      this.getTemples();
      this.checkLocation();

      if(this.currentPage===1){
        this.endValue=this.itemPerPage;
        this.startValue=0;
      }
    },

    mounted () {
      this.checkLocation();
    },

    methods:{

      getTemples(){
        this.$http.get('http://localhost:8000/api/getTemples')
          .then(function (response) {
            this.temples = response.body.temples;
            this.countValues();
          })
      },

      checkLocation(){
        var query = this.$route.query.l;

        if(query === undefined){
          this.activePage = 'All';
        }

        if(query==="all" || query ===""){
          this.activePage = "All";
        }else{
          this.activePage = query;
        }
      },

      redirectPage:function (district) {

        if(district==='all'){
          this.activePage="All";
        }

        this.$http.get('http://localhost:8000/api/getTemplesbyLoc/'+district)
        .then(function (response) {
            this.temples2 = response.body.temple;

            if(this.activePage==="All"){
              this.countValues();
            }else{
              this.countValues2();
            }

        })

        this.$router.push({ path: '/temples', query: { l: district } });
        this.checkLocation();
      },


      countValues(){
        this.temple_length = this.temples.length;
        this.pagination(this.temple_length);
      },

      countValues2(){
        this.temple_length = this.temples2.length;
        this.pagination(this.temple_length);
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

  .templescard{
    min-height: 4.5em;
  }

  .districts{
    background: #ffffff!important;
    border:1px solid #dddddd;
    padding: 1em;
    border-radius: 4px;
  }

  .districts ul li{
    margin-left: 1em;
    margin-right: 1em;
    float: left;
    color: #0a6ebd;
    padding:0.1em 0.2em;
    cursor: pointer;
  }

  .article-area{
    background: #eeeeee;
    padding: 2em;
    border-radius: 5px;
    border:1px solid #ddd;
  }

  .districts ul .activePage{
    background: #0b3251;
    color: #ffffff;
  }

  .hide{
    display: none;
  }



  .card-img-top{
    height: 6.5em!important;
  }

  .card-body{
    height:4em!important;
  }

</style>
