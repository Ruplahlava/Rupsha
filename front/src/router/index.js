import Vue from 'vue'
import Router from 'vue-router'
import Grid from '../components/Grid.vue'

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'grid',
      component: Grid
    }
  ]
})
