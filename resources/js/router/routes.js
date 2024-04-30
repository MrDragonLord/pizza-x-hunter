const DashboardContainer = () => import('~/layouts/DashboardContainer')
const MainContainer = () => import('~/layouts/MainContainer')

const Index = () => import('~/pages/index')
const IndexDashboard = () => import('~/pages/dashboard/index')
const LoginDashboard = () => import('~/pages/dashboard/login')
const UsersDashboard = () => import('~/pages/dashboard/crud/users')

export default [
    {
        path: '/',
        component: MainContainer,
        children: [
            {
                path: '/',
                component: Index,
                name: 'index',
            },
        ],
    },
    {
        path: '/dashboard',
        component: DashboardContainer,
        meta: {
            auth: true,
        },
        children: [
            {
                path: 'home',
                component: IndexDashboard,
                name: 'dashboard',
            },
            {
                path: 'users/:page?',
                component: UsersDashboard,
                name: 'dashboard.users',
            },
        ],
    },
    {
        path: '/dashboard/login',
        component: LoginDashboard,
        name: 'dashboard.login',
        meta: {
            guest: true,
        },
    },
]
