<template>
  <div class="p-4 border rounded-xl max-w-md mx-auto">
    <h2 class="text-xl mb-4">فرم ثبت‌نام</h2>
    <form @submit.prevent="handleRegister">
      <input v-model="form.name" placeholder="نام" class="border p-2 mb-2 w-full" />
      <input v-model="form.lastname" placeholder="نام خانوادگی" class="border p-2 mb-2 w-full" />
      <input v-model="form.email" placeholder="ایمیل" type="email" class="border p-2 mb-2 w-full" />
      <input v-model="form.password" placeholder="رمز عبور" type="password" class="border p-2 mb-2 w-full" />
      <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded w-full mt-2">ثبت‌نام</button>
      <div v-if="authStore.error" class="text-red-500 mt-2">{{ authStore.error }}</div>
      <div v-if="authStore.user" class="text-green-500 mt-2">ثبت‌نام موفق بود!</div>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useAuthStore } from '../stores/auth'

const authStore = useAuthStore()

const form = reactive({
  name: '',
  lastname: '',
  email: '',
  password: ''
})

const handleRegister = async () => {
  await authStore.register(form)
}
</script>
