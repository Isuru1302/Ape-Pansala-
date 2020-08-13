import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Import Pages
import Homepage from '../pages/home'
import Aboutpage from '../pages/about'
import Contactpage from '../pages/contact'
import Articlespage from '../pages/articles'
import SingleArticlespage from '../pages/article'
import AllTemples from '../pages/temples'
import Templepage from '../pages/temple'
import SearchPage from '../pages/search'
import DashboardPage from '../admin/home'
import adminArticlesPage from '../admin/articles'
import adminContactsPage from '../admin/contact'
import DetailsPage from '../admin/details'
import mainPage from '../admin/mainpage'
import adminTemples from '../admin/temples'
import loginPage from '../admin/login'
import adVideosPage from '../admin/adminVideos'
import videosPage from '../pages/videos'
import addTemple from '../admin/addTemple'
import editTemple from '../admin/editTemple'
import addArticle from '../admin/addArticle'
import editArticle from '../admin/editArticle'
import message from '../admin/message'
import directory from '../admin/directory'
import editDirectory from '../admin/editDirectory'
import directories from '../pages/directories'
import news from '../pages/news'
import adNews from '../admin/adNews'
import editNews from '../admin/editNews'

import pagNotFound from '../pages/pagNotFound'
import notFound from '../pages/notFound'

const routes = [
  {path: '/', name:Homepage , component: Homepage},
  {path: '/about', name:Aboutpage , component: Aboutpage},
  {path: '/contact', name:Contactpage , component: Contactpage},
  {path: '/articles', name:Articlespage , component: Articlespage},
  {path: '/article', name:SingleArticlespage , component: SingleArticlespage},
  {path: '/temples', name:AllTemples , component: AllTemples},
  {path: '/temple', name: Templepage , component: Templepage},
  {path: '/search', name: SearchPage , component: SearchPage},
  {path: '/videos', name: 'videosPage', component: videosPage},
  {path: '/news', name: 'news', component: news},
  {path: '/directories', name: 'directories', component: directories},
  {path: '/PagNotFound', name: 'pagNotFound', component: pagNotFound},
  {path: '/NotFound', name: 'notFound', component: notFound},


  {path: '/dashboard', name: 'DashboardPage', component: DashboardPage},
  {path: '/adminArticles', name: 'adminArticlesPage', component: adminArticlesPage},
  {path: '/adminContacts', name: 'adminContactsPage', component: adminContactsPage},
  {path: '/details', name: 'detailsPage', component: DetailsPage},
  {path: '/main', name: 'mainPage', component: mainPage},
  {path: '/adminTemple', name: 'adminTemples', component: adminTemples},
  {path: '/login', name: 'loginPage', component: loginPage},
  {path: '/adVideos', name: 'adVideosPage', component: adVideosPage},
  {path: '/addTemple', name: 'addTemple', component: addTemple},
  {path: '/editTemple', name: 'editTemple', component: editTemple},
  {path: '/addArticle', name: 'addArticle', component: addArticle},
  {path: '/editArticle', name: 'editArticle', component: editArticle},
  {path: '/message', name: 'message', component: message},
  {path: '/directory', name: 'directory', component: directory},
  {path: '/editDirectory', name: 'editDirectory', component: editDirectory},
  {path: '/adNews', name: 'adNews', component: adNews},
  {path: '/editNews', name: 'editNews', component: editNews},

  {path: '*',name:pagNotFound,component: pagNotFound },
];

const router = new VueRouter({
  mode: 'history',
  base:process.env.BASE_URL,
  routes
})

export default router

