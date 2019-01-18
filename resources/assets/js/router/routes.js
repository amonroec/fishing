const Welcome = () => import('~/pages/welcome').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const AddAnimal = () => import('~/pages/add_animal').then(m => m.default || m)

export default [
  { path: '/', name: 'home', component: Home },
  { path: '/add_animal', name: 'add_animal', component: AddAnimal },

  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  // { path: '/home', name: 'home', component: Home },
  // { path: '/settings',
  //   component: Settings,
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: SettingsProfile },
  //     { path: 'password', name: 'settings.password', component: SettingsPassword }
  //   ] },

  { path: '*', component: NotFound }
]
