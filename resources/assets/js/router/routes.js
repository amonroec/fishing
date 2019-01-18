const Welcome = () => import('~/pages/welcome').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const Contact = () => import('~/pages/contact_us').then(m => m.default || m)
const Admin = () => import('~/pages/admin/admin').then(m => m.default || m)
const PreForm = () => import('~/pages/forms/pre_market_form').then(m => m.default || m)
const MarketAnalysis = () => import('~/pages/market_analysis_form').then(m => m.default || m)
const OrdersTable = () => import('~/pages/orders_table').then(m => m.default || m)
const FormsTable = () => import('~/pages/forms_table').then(m => m.default || m)
const OrderPreview = () => import('~/pages/order_preview').then(m => m.default || m)
const FormDisplay = () => import('~/pages/form_display').then(m => m.default || m)
const FormsReviewTable = () => import('~/pages/forms_review_table').then(m => m.default || m)
const MdaPdf = () => import('~/pages/mda_pdf').then(m => m.default || m)
const Settings = () => import('~/pages/settings/index').then(m => m.default || m)
const SettingsProfile = () => import('~/pages/settings/profile').then(m => m.default || m)
const SettingsPassword = () => import('~/pages/settings/password').then(m => m.default || m)
const Cart = () => import('~/pages/cart/cart').then(m => m.default || m)
const Checkout = () => import('~/pages/cart/checkout').then(m => m.default || m)
const OrderSummary = () => import('~/pages/cart/order_summary').then(m => m.default || m)
const MyOrders = () => import('~/pages/my_orders').then(m => m.default || m)
const InvoiceTable = () => import('~/pages/invoice_table').then(m => m.default || m)

export default [
  { path: '/', name: 'home', component: Home },

  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  // { path: '/home', name: 'home', component: Home },
  { path: '/contact_us', name: 'contact', component: Contact },
  { path: '/cart', name: 'cart', component: Cart },
  { path: '/checkout', name: 'checkout', component: Checkout },
  { path: '/admin', name: 'admin', component: Admin },
  { path: '/market_analysis_form', name: 'preform', component: PreForm },
  { path: '/orders_table', name: 'orders_table', component: OrdersTable },
  { path: '/forms_table', name: 'forms_table', component: FormsTable },
  { path: '/mda_pdf', name: 'mda_pdf', component: MdaPdf },
  { path: '/order_summary/:token', name: 'order_summary', component: OrderSummary, props: true },
  { path: '/forms_review_table', name: 'forms_review_table', component: FormsReviewTable },
  { path: '/my_orders', name: 'myorders', component: MyOrders },
  { path: '/invoice_table', name: 'invoice_table', component: InvoiceTable },
  { path: '/market_analysis_form/:type', name: 'marketanalysis', component: MarketAnalysis, props: true },
  { path: '/order/:id', name: 'orderpreview', component: OrderPreview, props: true },
  { path: '/form/:id', name: 'formdisplay', component: FormDisplay, props: true },
  { path: '/settings',
    component: Settings,
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: SettingsProfile },
      { path: 'password', name: 'settings.password', component: SettingsPassword }
    ] },

  { path: '*', component: NotFound }
]
