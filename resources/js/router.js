import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Login from './pages/Login'
import Register from './pages/Register'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'

import Companies from './pages/Companies'
import Articles from './pages/Articles'
import About from './pages/About'


// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/about',
    name: 'about',
    component: About,
    meta: {
        auth: undefined
    }
   },
    {
        path: '/companies',
        name: 'companies',
        component: Companies,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/articles',
        name: 'articles',
        component: Articles,
        meta: {
            auth: undefined
        }
    },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router
