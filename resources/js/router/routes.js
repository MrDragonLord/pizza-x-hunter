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
            {
                path: '/login',
                component: LoginDashboard,
                name: 'dashboard.login',
            },
        ],
    },
    {
        path: '/dashboard',
        component: DashboardContainer,
        children: [
            {
                path: '/',
                component: IndexDashboard,
                name: 'dashboard',
            },
            {
                path: 'users',
                component: UsersDashboard,
                name: 'dashboard.users',
            },
        ],
    },
]
