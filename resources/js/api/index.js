import axios from 'axios'

const instance = axios.create({
    baseURL: '/api/',
})

// instance.interceptors.request.use(request => {
//     const token = localStorage.getItem('api-token')

//     if (token) {
//         request.headers.common.Authorization = `Bearer ${token}`
//     }

//     return request
// })

export default instance
