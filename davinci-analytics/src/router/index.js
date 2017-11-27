import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Program from '@/components/Program'
import Events from '@/components/Events'
import individualEvent from '@/components/individualEvent'
import Students from '@/components/Students'
import individualStudent from '@/components/individualStudent'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/program',
      name: 'Program',
      component: Program
    },
    {
      path: '/events',
      name: 'Events',
      component: Events
    },
    {
      path: '/events/:id',
      name: 'individualEvent',
      component: individualEvent
    },
    {
      path: '/students',
      name: 'students',
      component: Students
    },
    {
      path: '/students/:id',
      name: 'individualStudent',
      component: individualStudent
    }
  ]
})
