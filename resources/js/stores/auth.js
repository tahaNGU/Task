import { defineStore } from 'pinia'
import api from '../lib/axios'
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        error: null,
    }),
    actions: {
        async register(payload) {
            try {
                const response = await api.post('/register', payload)
                this.user = response.data.user
                this.error = null
            } catch (err) {
                this.error = err.response?.data?.message || 'ثبت نام با خطا مواجه شد'
            }
        },
    },
})
