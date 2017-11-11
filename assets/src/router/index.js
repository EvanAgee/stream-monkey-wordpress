import Vue from "vue"
import Router from "vue-router"
Vue.use(Router)

// Components
import Splash from '../views/Splash.vue'
import Video from '../views/Video.vue'
import Series from '../views/Series.vue'

const router = new Router({
  routes: [
    {
      path: "/",
      name: "Splash",
      component: Splash
    },
    {
      path: "/video/:id",
      name: "Video",
      component: Video
    },
    {
      path: "/series/:id",
      name: "Series",
      component: Series
    }
  ],
  
  scrollBehavior(to, from, savedPosition) {
    return { x: 0, y: 0 }
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
})

// router.afterEach((to, from) => {
// })

export default router
