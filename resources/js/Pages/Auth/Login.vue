<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-indigo-400 to-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
    </div>
    
    <div class="max-w-md w-full space-y-8 relative z-10">
      <!-- Logo/Icon section -->
      <div class="text-center">
        <div class="mx-auto h-16 w-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
          <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
        </div>
        <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
          Bem-vindo de volta
        </h2>
        <p class="mt-3 text-gray-600 text-lg">
          Acesse sua conta para continuar
        </p>
      </div>
      
      <!-- Login Card -->
      <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/20">
        <form class="space-y-6" @submit.prevent="submit">
          <!-- Seletor de tipo de usuário -->
          <div class="space-y-4">
            <label class="block text-sm font-semibold text-gray-700 mb-3">
              Tipo de Usuário
            </label>
            <div class="grid grid-cols-2 gap-3">
              <label class="relative">
                <input
                  type="radio"
                  v-model="form.user_type"
                  value="user"
                  class="sr-only"
                />
                <div :class="[
                  'flex items-center justify-center p-4 rounded-xl border-2 cursor-pointer transition-all duration-300 transform hover:scale-105',
                  form.user_type === 'user' 
                    ? 'border-indigo-500 bg-indigo-50 text-indigo-700 shadow-lg' 
                    : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300'
                ]">
                  <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  <span class="font-medium">Funcionário</span>
                </div>
              </label>
              <label class="relative">
                <input
                  type="radio"
                  v-model="form.user_type"
                  value="admin"
                  class="sr-only"
                />
                <div :class="[
                  'flex items-center justify-center p-4 rounded-xl border-2 cursor-pointer transition-all duration-300 transform hover:scale-105',
                  form.user_type === 'admin' 
                    ? 'border-purple-500 bg-purple-50 text-purple-700 shadow-lg' 
                    : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300'
                ]">
                  <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                  </svg>
                  <span class="font-medium">Admin</span>
                </div>
              </label>
            </div>
            <div v-if="errors.user_type" class="text-red-500 text-sm mt-2 flex items-center">
              <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ errors.user_type }}
            </div>
          </div>

          <!-- Email -->
          <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700">
              Email
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
              </div>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                v-model="form.email"
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white text-gray-900 placeholder-gray-500"
                placeholder="seu@email.com"
              />
            </div>
            <div v-if="errors.email" class="text-red-500 text-sm flex items-center">
              <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ errors.email }}
            </div>
          </div>

          <!-- Senha -->
          <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700">
              Senha
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                v-model="form.password"
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white text-gray-900 placeholder-gray-500"
                placeholder="••••••••"
              />
            </div>
            <div v-if="errors.password" class="text-red-500 text-sm flex items-center">
              <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ errors.password }}
            </div>
          </div>

          <!-- Lembrar-me -->
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember"
                name="remember"
                type="checkbox"
                v-model="form.remember"
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-colors duration-200"
              />
              <label for="remember" class="ml-3 block text-sm font-medium text-gray-700">
                Lembrar-me
              </label>
            </div>
            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                Esqueceu a senha?
              </a>
            </div>
          </div>

          <!-- Botão de submit -->
          <div class="pt-4">
            <button
              type="submit"
              :disabled="form.processing"
              class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transform transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl"
            >
              <span v-if="form.processing" class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </span>
              <span class="flex items-center">
                <svg v-if="!form.processing" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                {{ form.processing ? 'Entrando...' : 'Entrar na conta' }}
              </span>
            </button>
          </div>
        </form>
        
        <!-- Footer -->
        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Não tem uma conta?
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
              Entre em contato com o administrador
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

// Props
defineProps({
  errors: {
    type: Object,
    default: () => ({})
  }
})

// Form data
const form = useForm({
  email: '',
  password: '',
  user_type: 'user',
  remember: false
})

// Submit form
const submit = () => {
  form.post('/login', {
    onFinish: () => {
      form.reset('password')
    }
  })
}

// Processing state is now handled by the form itself
</script>

<style scoped>
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

/* Glassmorphism effect enhancement */
.backdrop-blur-lg {
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
}

/* Custom gradient text */
.bg-clip-text {
  background-clip: text;
  -webkit-background-clip: text;
}

/* Smooth transitions for all interactive elements */
* {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 300ms;
}

/* Custom focus styles */
input:focus {
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Hover effects for cards */
.hover\:scale-105:hover {
  transform: scale(1.05);
}

.hover\:shadow-xl:hover {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>