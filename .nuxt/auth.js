import Middleware from './middleware'
import { Auth, authMiddleware, ExpiredAuthSessionError } from '~auth/runtime'

// Active schemes
import { LaravelJWTScheme } from '~auth/runtime'

Middleware.auth = authMiddleware

export default function (ctx, inject) {
  // Options
  const options = {
  "resetOnError": false,
  "ignoreExceptions": false,
  "scopeKey": "scope",
  "rewriteRedirects": true,
  "fullPathRedirect": false,
  "watchLoggedIn": true,
  "redirect": {
    "login": "/",
    "logout": "/",
    "home": false,
    "callback": false
  },
  "vuex": {
    "namespace": "auth"
  },
  "cookie": {
    "prefix": "auth.",
    "options": {
      "path": "/"
    }
  },
  "localStorage": {
    "prefix": "auth."
  },
  "defaultStrategy": "jwt"
}

  // Create a new Auth instance
  const $auth = new Auth(ctx, options)

  // Register strategies
  // jwt
  $auth.registerStrategy('jwt', new LaravelJWTScheme($auth, {
  "url": "/",
  "name": "jwt",
  "endpoints": {
    "login": {
      "url": "/api/login",
      "method": "POST"
    },
    "refresh": {
      "url": "/api/refresh",
      "method": "POST"
    },
    "logout": {
      "url": "/api/logout",
      "method": "POST"
    },
    "user": {
      "url": "/api/me",
      "method": "POST"
    }
  },
  "token": {
    "property": "access_token",
    "maxAge": 3600
  },
  "refreshToken": {
    "property": false,
    "data": false,
    "maxAge": 1209600,
    "required": false,
    "tokenRequired": true
  },
  "user": {
    "property": false
  },
  "clientId": false,
  "grantType": false
}))

  // Inject it to nuxt context as $auth
  inject('auth', $auth)
  ctx.$auth = $auth

  // Initialize auth
  return $auth.init().catch(error => {
    if (process.client) {
      // Don't console log expired auth session errors. This error is common, and expected to happen.
      // The error happens whenever the user does an ssr request (reload/initial navigation) with an expired refresh
      // token. We don't want to log this as an error.
      if (error instanceof ExpiredAuthSessionError) {
        return
      }

      console.error('[ERROR] [AUTH]', error)
    }
  })
}
