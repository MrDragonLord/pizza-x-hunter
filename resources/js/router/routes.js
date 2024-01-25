const DashboardContainer = () => import('~/layouts/DashboardContainer')
const MainContainer = () => import('~/layouts/MainContainer')

const Index = () => import('~/pages/index')
const IndexDashboard = () => import('~/pages/dashboard/index')
const LoginDashboard = () => import('~/pages/dashboard/index')

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
        children: [
            {
                path: '/',
                component: IndexDashboard,
                name: 'dashobard',
            },
            {
                path: '/login',
                component: LoginDashboard,
                name: 'login.dashboard',
            },
        ],
    },
]
