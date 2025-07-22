<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <h1 class="text-xl font-semibold text-gray-900">
              Dashboard - Funcionário
            </h1>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-gray-700">Olá, {{ user.name }}</span>
            <button
              @click="logout"
              class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium"
            >
              Sair
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
          <div class="px-4 py-5 sm:p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">
              Bem-vindo ao Sistema de Ponto
            </h2>
            <p class="text-gray-600">
              Aqui você pode registrar seu ponto e visualizar seus registros.
            </p>
          </div>
        </div>

        <!-- User Info Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
          <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
              Suas Informações
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <p class="mt-1 text-sm text-gray-900">{{ user.name }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-sm text-gray-900">{{ user.email }}</p>
              </div>
              <div v-if="user.position">
                <label class="block text-sm font-medium text-gray-700">Cargo</label>
                <p class="mt-1 text-sm text-gray-900">{{ user.position }}</p>
              </div>
              <div v-if="user.birth_date">
                <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <p class="mt-1 text-sm text-gray-900">{{ formatDate(user.birth_date) }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Message Alert -->
        <div v-if="message" :class="[
          'mb-6 p-4 rounded-md',
          messageType === 'success' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'
        ]">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg v-if="messageType === 'success'" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              <svg v-else class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="ml-3">
              <p :class="[
                'text-sm font-medium',
                messageType === 'success' ? 'text-green-800' : 'text-red-800'
              ]">{{ message }}</p>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
              Ações Rápidas
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <button
                @click="registerTimesheet"
                :disabled="isLoading"
                :class="[
                  'px-4 py-3 rounded-md text-sm font-medium flex items-center justify-center transition-colors duration-200',
                  isLoading 
                    ? 'bg-gray-400 cursor-not-allowed text-white' 
                    : 'bg-green-600 hover:bg-green-700 text-white'
                ]"
              >
                <svg v-if="isLoading" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ isLoading ? 'Registrando...' : 'Registrar Ponto' }}
              </button>
              
              <button
                @click="viewTimesheets"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-md text-sm font-medium flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Ver Registros
              </button>
              
              <button
                @click="editProfile"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-md text-sm font-medium flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Editar Perfil
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal de Registros -->
    <div v-if="showTimesheetsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" @click="closeModal">
      <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white" @click.stop>
        <div class="mt-3">
          <!-- Header do Modal -->
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900">Meus Registros de Ponto</h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <!-- Loading State -->
          <div v-if="loadingTimesheets" class="flex justify-center items-center py-8">
            <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="ml-2 text-gray-600">Carregando registros...</span>
          </div>

          <!-- Content -->
          <div v-else-if="timesheets.length > 0" class="max-h-96 overflow-y-auto">
            <div class="space-y-3">
              <div v-for="timesheet in timesheets" :key="timesheet.id" class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                      <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-900">{{ timesheet.date }}</p>
                      <p class="text-sm text-gray-500">{{ timesheet.time }}</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      Registrado
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-else class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum registro encontrado</h3>
            <p class="mt-1 text-sm text-gray-500">Você ainda não possui registros de ponto.</p>
          </div>

          <!-- Footer do Modal -->
          <div class="mt-6 flex justify-end">
            <button @click="closeModal" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium">
              Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import axios from 'axios'
import { ref } from 'vue'

// Props
defineProps({
  user: {
    type: Object,
    required: true
  }
})

// Reactive data
const isLoading = ref(false)
const message = ref('')
const messageType = ref('') // 'success' or 'error'
const showTimesheetsModal = ref(false)
const timesheets = ref([])
const loadingTimesheets = ref(false)

// Methods
const logout = () => {
  router.post('/logout')
}

const registerTimesheet = async () => {
  if (isLoading.value) return
  
  isLoading.value = true
  message.value = ''
  
  try {
    const response = await axios.post('/user/timesheet')
    
    if (response.data.success) {
      message.value = response.data.message
      messageType.value = 'success'
      
      // Mostrar horário de registro
      if (response.data.registered_at) {
        message.value += ` Horário: ${response.data.registered_at}`
      }
    } else {
      message.value = response.data.message || 'Erro ao registrar ponto'
      messageType.value = 'error'
    }
  } catch (error) {
    if (error.response && error.response.data) {
      message.value = error.response.data.message || 'Erro ao registrar ponto'
    } else {
      message.value = 'Erro de conexão. Tente novamente.'
    }
    messageType.value = 'error'
  } finally {
    isLoading.value = false
    
    // Limpar mensagem após 5 segundos
    setTimeout(() => {
      message.value = ''
      messageType.value = ''
    }, 5000)
  }
}

const viewTimesheets = async () => {
  showTimesheetsModal.value = true
  loadingTimesheets.value = true
  
  try {
    const response = await axios.get('/user/timesheet')
    
    if (response.data.success) {
      timesheets.value = response.data.timesheets
    } else {
      timesheets.value = []
      message.value = 'Erro ao carregar registros'
      messageType.value = 'error'
    }
  } catch (error) {
    timesheets.value = []
    message.value = 'Erro ao buscar registros. Tente novamente.'
    messageType.value = 'error'
  } finally {
    loadingTimesheets.value = false
  }
}

const closeModal = () => {
  showTimesheetsModal.value = false
  timesheets.value = []
}

const editProfile = () => {
  // Implementar edição de perfil
  alert('Funcionalidade de edição de perfil será implementada')
}

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('pt-BR')
}
</script>

<style scoped>
/* Estilos adicionais se necessário */
</style>