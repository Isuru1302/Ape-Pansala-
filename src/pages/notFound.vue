<template>
  <div id="app">
    <top_bar/>
    <main_banner/>
    <nav_bar/>

    <div class="pageNotFound">
      <div class="container">
        <div class="row">

            <div class="page-n col-12 text-center">

              <div class="content">
                <h2>Page Not Found!!</h2>
                <p><a @click="$router.go(-2)">Go back to previous page</a></p>
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
  import siteDetails from "../components/siteDetails";

  export default {


    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":siteDetails
    },
  }


</script>

<style scoped>

  .pageNotFound{
    min-height: 16em;
    width: 100%;
    vertical-align: middle;
  }

  .page-n {
    margin-top:2em;
    text-align: center;
  }

  .content{
    width: auto;
    padding: 4em;
    border-style: dashed;
    border-color: black;
    cursor: default;
  }

  .content p{
    font-weight: bold;
    color: #0b75c9;
  }

</style>
