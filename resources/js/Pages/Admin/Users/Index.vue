<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex pt-4 pb-2" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="/admin/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Funcionários</span>
              </div>
            </li>
          </ol>
        </nav>
        
        <div class="flex justify-between items-center py-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Gerenciar Funcionários</h1>
            <p class="mt-1 text-sm text-gray-600">Gerencie os funcionários da sua empresa</p>
          </div>
          <button
            @click="openCreateModal"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Novo Funcionário
          </button>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM9 9a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Total de Funcionários</p>
              <p class="text-2xl font-bold text-gray-900">{{ users.length }}</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Funcionários Ativos</p>
              <p class="text-2xl font-bold text-gray-900">{{ users.length }}</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Novos Este Mês</p>
              <p class="text-2xl font-bold text-gray-900">0</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Users Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-medium text-gray-900">Lista de Funcionários</h3>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cidade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                        {{ user.name.charAt(0).toUpperCase() }}
                      </div>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                      <div class="text-sm text-gray-500">{{ formatDate(user.birth_date) }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ user.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ user.position }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ formatCPF(user.cpf) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ user.city }}, {{ user.state }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button
                      @click="openEditModal(user)"
                      class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                    </button>
                    <button
                      @click="confirmDelete(user)"
                      class="text-red-600 hover:text-red-900 transition-colors duration-200"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="users.length === 0">
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                  <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM9 9a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-lg font-medium">Nenhum funcionário encontrado</p>
                    <p class="text-sm">Comece adicionando seu primeiro funcionário</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900">
              {{ isEditing ? 'Editar Funcionário' : 'Novo Funcionário' }}
            </h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <form @submit.prevent="submitForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- Nome -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                <input
                  v-model="form.name"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite o nome completo"
                />
              </div>
              
              <!-- Email -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input
                  v-model="form.email"
                  type="email"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite o email"
                />
              </div>
              
              <!-- Senha -->
              <div v-if="!isEditing">
                <label class="block text-sm font-medium text-gray-700 mb-1">Senha *</label>
                <input
                  v-model="form.password"
                  type="password"
                  :required="!isEditing"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite a senha"
                />
              </div>
              
              <!-- Cargo -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cargo *</label>
                <input
                  v-model="form.position"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite o cargo"
                />
              </div>
              
              <!-- CPF -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CPF *</label>
                <input
                  v-model="form.cpf"
                  type="text"
                  required
                  @input="formatCPFInput"
                  maxlength="14"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="000.000.000-00"
                />
              </div>
              
              <!-- Data de Nascimento -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento *</label>
                <input
                  v-model="form.birth_date"
                  type="date"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
              </div>
            </div>
            
            <!-- CEP -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">CEP *</label>
              <input
                v-model="form.cep"
                type="text"
                required
                @input="handleCEPInput"
                maxlength="9"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="00000-000"
              />
              <p v-if="cepLoading" class="text-sm text-blue-600 mt-1">Buscando endereço...</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- Rua -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rua *</label>
                <input
                  v-model="form.street"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite a rua"
                />
              </div>
              
              <!-- Número -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Número *</label>
                <input
                  v-model="form.number"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite o número"
                />
              </div>
              
              <!-- Complemento -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                <input
                  v-model="form.complement"
                  type="text"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Apto, bloco, etc."
                />
              </div>
              
              <!-- Bairro -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bairro *</label>
                <input
                  v-model="form.district"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite o bairro"
                />
              </div>
              
              <!-- Cidade -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade *</label>
                <input
                  v-model="form.city"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Digite a cidade"
                />
              </div>
              
              <!-- Estado -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                <select
                  v-model="form.state"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                  <option value="">Selecione o estado</option>
                  <option v-for="state in states" :key="state.value" :value="state.value">
                    {{ state.label }}
                  </option>
                </select>
              </div>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200"
              >
                Cancelar
              </button>
              <button
                type="submit"
                :disabled="loading"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 transition-colors duration-200"
              >
                {{ loading ? 'Salvando...' : (isEditing ? 'Atualizar' : 'Criar') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mt-2">Confirmar Exclusão</h3>
          <div class="mt-2 px-7 py-3">
            <p class="text-sm text-gray-500">
              Tem certeza que deseja excluir o funcionário <strong>{{ userToDelete?.name }}</strong>?
              Esta ação não pode ser desfeita.
            </p>
          </div>
          <div class="flex justify-center space-x-3 mt-4">
            <button
              @click="closeDeleteModal"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200"
            >
              Cancelar
            </button>
            <button
              @click="deleteUser"
              :disabled="loading"
              class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:opacity-50 transition-colors duration-200"
            >
              {{ loading ? 'Excluindo...' : 'Excluir' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'

export default {
  name: 'UsersIndex',
  props: {
    users: {
      type: Array,
      default: () => []
    },
    admin: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const showModal = ref(false)
    const showDeleteModal = ref(false)
    const isEditing = ref(false)
    const loading = ref(false)
    const cepLoading = ref(false)
    const userToDelete = ref(null)
    const cepTimeout = ref(null)
    const usersList = ref([...props.users])
    
    const form = reactive({
      name: '',
      email: '',
      password: '',
      position: '',
      cpf: '',
      birth_date: '',
      cep: '',
      street: '',
      number: '',
      complement: '',
      district: '',
      city: '',
      state: ''
    })
    
    const states = [
      { value: 'AC', label: 'Acre' },
      { value: 'AL', label: 'Alagoas' },
      { value: 'AP', label: 'Amapá' },
      { value: 'AM', label: 'Amazonas' },
      { value: 'BA', label: 'Bahia' },
      { value: 'CE', label: 'Ceará' },
      { value: 'DF', label: 'Distrito Federal' },
      { value: 'ES', label: 'Espírito Santo' },
      { value: 'GO', label: 'Goiás' },
      { value: 'MA', label: 'Maranhão' },
      { value: 'MT', label: 'Mato Grosso' },
      { value: 'MS', label: 'Mato Grosso do Sul' },
      { value: 'MG', label: 'Minas Gerais' },
      { value: 'PA', label: 'Pará' },
      { value: 'PB', label: 'Paraíba' },
      { value: 'PR', label: 'Paraná' },
      { value: 'PE', label: 'Pernambuco' },
      { value: 'PI', label: 'Piauí' },
      { value: 'RJ', label: 'Rio de Janeiro' },
      { value: 'RN', label: 'Rio Grande do Norte' },
      { value: 'RS', label: 'Rio Grande do Sul' },
      { value: 'RO', label: 'Rondônia' },
      { value: 'RR', label: 'Roraima' },
      { value: 'SC', label: 'Santa Catarina' },
      { value: 'SP', label: 'São Paulo' },
      { value: 'SE', label: 'Sergipe' },
      { value: 'TO', label: 'Tocantins' }
    ]
    
    const resetForm = () => {
      Object.keys(form).forEach(key => {
        form[key] = ''
      })
    }
    
    const openCreateModal = () => {
      resetForm()
      isEditing.value = false
      showModal.value = true
    }
    
    const formatDateForInput = (date) => {
      if (!date) return ''
      // Se a data já está no formato YYYY-MM-DD, retorna como está
      if (date.match(/^\d{4}-\d{2}-\d{2}$/)) {
        return date
      }
      // Se a data está no formato YYYY-MM-DD HH:MM:SS, extrai apenas a data
      if (date.match(/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/)) {
        return date.split(' ')[0]
      }
      // Se a data está no formato DD/MM/YYYY, converte para YYYY-MM-DD
      if (date.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
        const [day, month, year] = date.split('/')
        return `${year}-${month}-${day}`
      }
      // Tenta criar uma data válida e formatá-la
      try {
        const dateObj = new Date(date)
        if (!isNaN(dateObj.getTime())) {
          return dateObj.toISOString().split('T')[0]
        }
      } catch (e) {
        console.error('Erro ao formatar data:', e)
      }
      return ''
    }

    const openEditModal = (user) => {
      resetForm()
      Object.keys(form).forEach(key => {
        if (user[key] !== undefined) {
          if (key === 'birth_date') {
            form[key] = formatDateForInput(user[key])
          } else {
            form[key] = user[key]
          }
        }
      })
      form.editingId = user.id
      isEditing.value = true
      showModal.value = true
    }
    
    const closeModal = () => {
      showModal.value = false
      resetForm()
    }
    
    const confirmDelete = (user) => {
      userToDelete.value = user
      showDeleteModal.value = true
    }
    
    const closeDeleteModal = () => {
      showDeleteModal.value = false
      userToDelete.value = null
    }
    
    const formatCPF = (cpf) => {
      if (!cpf) return ''
      return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4')
    }
    
    const formatCPFInput = (event) => {
      let value = event.target.value.replace(/\D/g, '')
      if (value.length <= 11) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4')
        form.cpf = value
      }
    }
    
    const formatDate = (date) => {
      if (!date) return ''
      return new Date(date).toLocaleDateString('pt-BR')
    }
    
    const handleCEPInput = (event) => {
      let value = event.target.value.replace(/\D/g, '')
      if (value.length <= 8) {
        value = value.replace(/(\d{5})(\d{3})/, '$1-$2')
        form.cep = value
        
        // Clear previous timeout
        if (cepTimeout.value) {
          clearTimeout(cepTimeout.value)
        }
        
        // Set new timeout for 2 seconds
        if (value.replace(/\D/g, '').length === 8) {
          cepTimeout.value = setTimeout(() => {
            fetchAddressByCEP(value.replace(/\D/g, ''))
          }, 2000)
        }
      }
    }
    
    const fetchAddressByCEP = async (cep) => {
      if (cep.length !== 8) return
      
      cepLoading.value = true
      try {
        const response = await fetch(`/admin/cep?cep=${cep}`)
        const data = await response.json()
        
        if (!data.success) {
          alert(data.message || 'CEP não encontrado')
          return
        }
        
        // Preenche os campos automaticamente
        form.street = data.data.street || ''
        form.district = data.data.district || ''
        form.city = data.data.city || ''
        form.state = data.data.state || ''
      } catch (error) {
        console.error('Erro ao buscar CEP:', error)
        alert('Erro ao buscar CEP')
      } finally {
        cepLoading.value = false
      }
    }
    
    const submitForm = async () => {
      loading.value = true
      try {
        const url = isEditing.value ? `/admin/user/${form.editingId}` : '/admin/user'
        const method = isEditing.value ? 'put' : 'post'
        
        const formData = { ...form }
        delete formData.editingId
        
        // Remove password se estiver vazio durante a edição
        if (isEditing.value && (!formData.password || formData.password.trim() === '')) {
          delete formData.password
        }
        
        const response = await axios[method](url, formData)
        
        if (response.data.success) {
          alert(response.data.message)
          closeModal()
          // Refresh the page to get updated data
          window.location.reload()
        } else {
          alert(response.data.message || 'Erro ao salvar usuário')
        }
      } catch (error) {
        console.error('Erro:', error)
        if (error.response?.data?.message) {
          alert(error.response.data.message)
        } else if (error.response?.data?.errors) {
          const errors = Object.values(error.response.data.errors).flat()
          alert(errors.join('\n'))
        } else {
          alert('Erro ao salvar usuário')
        }
      } finally {
        loading.value = false
      }
    }
    
    const deleteUser = async () => {
      if (!userToDelete.value) return
      
      loading.value = true
      try {
        const response = await axios.delete(`/admin/user/${userToDelete.value.id}`)
        
        if (response.data.success) {
          alert(response.data.message)
          closeDeleteModal()
          // Refresh the page to get updated data
          window.location.reload()
        } else {
          alert(response.data.message || 'Erro ao excluir usuário')
        }
      } catch (error) {
        console.error('Erro:', error)
        alert('Erro ao excluir usuário')
      } finally {
        loading.value = false
      }
    }
    
    return {
      showModal,
      showDeleteModal,
      isEditing,
      loading,
      cepLoading,
      userToDelete,
      form,
      states,
      users: usersList,
      openCreateModal,
      openEditModal,
      closeModal,
      confirmDelete,
      closeDeleteModal,
      formatCPF,
      formatCPFInput,
      formatDate,
      handleCEPInput,
      submitForm,
      deleteUser
    }
  }
}
</script>