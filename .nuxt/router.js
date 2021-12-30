import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _24e9482b = () => interopDefault(import('..\\client\\pages\\admin\\index.vue' /* webpackChunkName: "pages/admin/index" */))
const _e928efa0 = () => interopDefault(import('..\\client\\pages\\auth.vue' /* webpackChunkName: "pages/auth" */))
const _2099eba5 = () => interopDefault(import('..\\client\\pages\\dev\\index.vue' /* webpackChunkName: "pages/dev/index" */))
const _5bebf53d = () => interopDefault(import('..\\client\\pages\\dev\\index\\index.vue' /* webpackChunkName: "pages/dev/index/index" */))
const _6c86b765 = () => interopDefault(import('..\\client\\pages\\dev\\index\\artisan.vue' /* webpackChunkName: "pages/dev/index/artisan" */))
const _6520f9e6 = () => interopDefault(import('..\\client\\pages\\dev\\index\\auth.vue' /* webpackChunkName: "pages/dev/index/auth" */))
const _9892694e = () => interopDefault(import('..\\client\\pages\\dev\\index\\bootstrap.vue' /* webpackChunkName: "pages/dev/index/bootstrap" */))
const _ca3445dc = () => interopDefault(import('..\\client\\pages\\dev\\index\\editor.vue' /* webpackChunkName: "pages/dev/index/editor" */))
const _7458eb2e = () => interopDefault(import('..\\client\\pages\\dev\\index\\endpoints.vue' /* webpackChunkName: "pages/dev/index/endpoints" */))
const _e8532dd6 = () => interopDefault(import('..\\client\\pages\\dev\\index\\example.vue' /* webpackChunkName: "pages/dev/index/example" */))
const _3ea42c62 = () => interopDefault(import('..\\client\\pages\\dev\\index\\files.vue' /* webpackChunkName: "pages/dev/index/files" */))
const _18547dce = () => interopDefault(import('..\\client\\pages\\dev\\index\\nav.vue' /* webpackChunkName: "pages/dev/index/nav" */))
const _3e470a04 = () => interopDefault(import('..\\client\\pages\\loteria.vue' /* webpackChunkName: "pages/loteria" */))
const _12c31fc4 = () => interopDefault(import('..\\client\\pages\\loteria\\index.vue' /* webpackChunkName: "pages/loteria/index" */))
const _1ffa438b = () => interopDefault(import('..\\client\\pages\\loteria\\_type.vue' /* webpackChunkName: "pages/loteria/_type" */))
const _07a17f50 = () => interopDefault(import('..\\client\\pages\\admin\\files.vue' /* webpackChunkName: "pages/admin/files" */))
const _1385dd6e = () => interopDefault(import('..\\client\\pages\\admin\\loterias\\index.vue' /* webpackChunkName: "pages/admin/loterias/index" */))
const _76561bda = () => interopDefault(import('..\\client\\pages\\admin\\settings.vue' /* webpackChunkName: "pages/admin/settings" */))
const _14b80f68 = () => interopDefault(import('..\\client\\pages\\admin\\settings\\index.vue' /* webpackChunkName: "pages/admin/settings/index" */))
const _7986859c = () => interopDefault(import('..\\client\\pages\\admin\\settings\\email.vue' /* webpackChunkName: "pages/admin/settings/email" */))
const _c09d87b6 = () => interopDefault(import('..\\client\\pages\\admin\\settings\\user.vue' /* webpackChunkName: "pages/admin/settings/user" */))
const _28e6f301 = () => interopDefault(import('..\\client\\pages\\admin\\users\\index.vue' /* webpackChunkName: "pages/admin/users/index" */))
const _20bd0135 = () => interopDefault(import('..\\client\\pages\\admin\\loterias\\_type.vue' /* webpackChunkName: "pages/admin/loterias/_type" */))
const _53e7c1a9 = () => interopDefault(import('..\\client\\pages\\admin\\users\\_id.vue' /* webpackChunkName: "pages/admin/users/_id" */))
const _5d70947a = () => interopDefault(import('..\\client\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/admin",
    component: _24e9482b,
    name: "admin"
  }, {
    path: "/auth",
    component: _e928efa0,
    name: "auth"
  }, {
    path: "/dev",
    component: _2099eba5,
    children: [{
      path: "",
      component: _5bebf53d,
      name: "dev-index"
    }, {
      path: "artisan",
      component: _6c86b765,
      name: "dev-index-artisan"
    }, {
      path: "auth",
      component: _6520f9e6,
      name: "dev-index-auth"
    }, {
      path: "bootstrap",
      component: _9892694e,
      name: "dev-index-bootstrap"
    }, {
      path: "editor",
      component: _ca3445dc,
      name: "dev-index-editor"
    }, {
      path: "endpoints",
      component: _7458eb2e,
      name: "dev-index-endpoints"
    }, {
      path: "example",
      component: _e8532dd6,
      name: "dev-index-example"
    }, {
      path: "files",
      component: _3ea42c62,
      name: "dev-index-files"
    }, {
      path: "nav",
      component: _18547dce,
      name: "dev-index-nav"
    }]
  }, {
    path: "/loteria",
    component: _3e470a04,
    children: [{
      path: "",
      component: _12c31fc4,
      name: "loteria"
    }, {
      path: ":type",
      component: _1ffa438b,
      name: "loteria-type"
    }]
  }, {
    path: "/admin/files",
    component: _07a17f50,
    name: "admin-files"
  }, {
    path: "/admin/loterias",
    component: _1385dd6e,
    name: "admin-loterias"
  }, {
    path: "/admin/settings",
    component: _76561bda,
    children: [{
      path: "",
      component: _14b80f68,
      name: "admin-settings"
    }, {
      path: "email",
      component: _7986859c,
      name: "admin-settings-email"
    }, {
      path: "user",
      component: _c09d87b6,
      name: "admin-settings-user"
    }]
  }, {
    path: "/admin/users",
    component: _28e6f301,
    name: "admin-users"
  }, {
    path: "/admin/loterias/:type",
    component: _20bd0135,
    name: "admin-loterias-type"
  }, {
    path: "/admin/users/:id",
    component: _53e7c1a9,
    name: "admin-users-id"
  }, {
    path: "/",
    component: _5d70947a,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
