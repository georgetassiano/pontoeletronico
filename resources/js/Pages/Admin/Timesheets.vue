<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <h1 class="text-xl font-semibold text-gray-900">
              Registros de Ponto - Administrador
            </h1>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-gray-700">Olá, {{ admin.name }}</span>
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
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-between items-center">
              <div>
                <h2 class="text-lg font-medium text-gray-900 mb-2">
                  Todos os Registros de Ponto
                </h2>
                <p class="text-gray-600">
                  Visualize todos os registros de ponto dos funcionários.
                </p>
              </div>
              <div class="flex space-x-3">
                <button
                  @click="goToDashboard"
                  class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium"
                >
                  Voltar ao Dashboard
                </button>
                <button
                  @click="refreshData"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium"
                >
                  Atualizar
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Alert Messages -->
        <div v-if="message" class="mb-6">
          <div :class="[
            'rounded-md p-4',
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
                ]">
                  {{ message }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-center items-center py-8">
              <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span class="ml-2 text-gray-600">Carregando registros...</span>
            </div>
          </div>
        </div>

        <!-- Timesheets List -->
        <div v-else-if="timesheets.length > 0" class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="space-y-4">
              <div v-for="timesheet in timesheets" :key="timesheet.id" class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                      <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                        <span class="text-white font-medium text-sm">
                          {{ timesheet.user_name ? timesheet.user_name.charAt(0).toUpperCase() : 'U' }}
                        </span>
                      </div>
                    </div>
                    <div class="ml-3">
                      <p class="text-sm font-medium text-gray-900">
                        {{ timesheet.user_name || 'Usuário não encontrado' }}
                      </p>
                      <p class="text-sm text-gray-500">
                        {{ timesheet.position || 'Cargo não informado' }} - {{ timesheet.age || 'N/A' }} anos
                      </p>
                      <p class="text-xs text-gray-400 mt-1">
                        {{ timesheet.date }} às {{ timesheet.time }}
                      </p>
                    </div>
                  </div>
                  <div class="flex-shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      Registrado
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="text-center py-8">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum registro encontrado</h3>
              <p class="mt-1 text-sm text-gray-500">Ainda não há registros de ponto no sistema.</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

export default {
  name: 'AdminTimesheets',
  props: {
    admin: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const timesheets = ref([])
    const loading = ref(false)
    const message = ref('')
    const messageType = ref('success')

    const fetchTimesheets = async () => {
      loading.value = true
      message.value = ''
      
      try {
        const response = await fetch('/admin/timesheet', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          credentials: 'same-origin'
        })
        
        const data = await response.json()
        
        if (response.ok) {
          timesheets.value = data.timesheets || []
          console.log('Timesheets carregados:', timesheets.value)
        } else {
          message.value = data.message || 'Erro ao carregar registros'
          messageType.value = 'error'
        }
      } catch (error) {
        console.error('Erro ao buscar registros:', error)
        message.value = 'Erro ao carregar registros'
        messageType.value = 'error'
      } finally {
        loading.value = false
      }
    }

    const formatDateTime = (dateTime) => {
      if (!dateTime) return 'Data não disponível'
      
      try {
        const date = new Date(dateTime)
        return date.toLocaleString('pt-BR', {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit'
        })
      } catch (error) {
        return 'Data inválida'
      }
    }

    const goToDashboard = () => {
      router.visit('/admin/dashboard')
    }

    const refreshData = () => {
      fetchTimesheets()
    }

    const logout = () => {
      router.post('/logout')
    }

    onMounted(() => {
      fetchTimesheets()
    })

    return {
      timesheets,
      loading,
      message,
      messageType,
      fetchTimesheets,
      formatDateTime,
      goToDashboard,
      refreshData,
      logout
    }
  }
}
</script>