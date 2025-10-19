<template>
  <div class="flex justify-between items-center mb-4">
  <h1 class="text-xl font-bold">Painel de Usuários</h1>
  
    <button 
      v-if="loggedInUser?.roles === 'admin'"
      @click="isModalVisible = true" 
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >
      Novo Usuário
    </button>
</div>
  

  <div v-if="users" class="flex gap-12">
    <ul v-for="user in users" :key="user.id">
      <li>{{user.name }}</li>
      <li>{{ user.email }}</li>
      <li>{{ user.roles }}</li>
    </ul>
  </div>

  <AppModal 
    :visible="isModalVisible" 
    @close="isModalVisible = false"
  >
    <h2 class="text-xl font-bold mb-4">Criar Novo Usuário</h2>
    
    <form @submit.prevent="createUser" class="mt-4">
      <div class="flex flex-col gap-4">
        
        <div class="flex flex-col gap-1">
          <label for="name" class="font-semibold">Nome</label>
          <input 
            id="name"
            v-model="newUser.name" 
            type="text" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

        <div class="flex flex-col gap-1">
          <label for="email" class="font-semibold">Email</label>
          <input 
            id="email"
            v-model="newUser.email" 
            type="email" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

        <div class="flex flex-col gap-1">
          <label for="password" class="font-semibold">Senha</label>
          <input 
            id="password"
            v-model="newUser.password" 
            type="password" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

      
        <div class="flex flex-col gap-1">
          <label for="roles" class="font-semibold">Cargo</label>
          <select
            id = "roles"
            v-model="newUser.roles"
            class="p-2 border rounded-md focus:outline-blue-500"
            default-value="Cargo"
          >
            <option value="admin">admin</option>
            <option value="funcionario">funcionario</option>
          </select>
        </div>


        <div class="flex justify-end mt-4">
          <button 
            type="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
          >
            Salvar
          </button>
        </div>
      </div>
    </form>

  </AppModal>
</template>

<script setup lang="ts">

  import { ref } from 'vue';

  const { data: users, refresh } = await useAsyncData('users', () => 
    useSanctumFetch<User[]>('/api/users')
  );

  const { data: loggedInUser } = await useAsyncData('currentUser', () => 
    useSanctumFetch<User>('/api/user')
  );


  interface User{
    id: string
    name: string
    email: string
    roles: string
  }
  const isModalVisible = ref(false);

  const newUser = ref({
    name: '',
    email: '',
    password: '',
    roles: 'funcionario'
  });

  async function createUser() {
  // 1. Validação simples para não enviar dados em branco
  if (!newUser.value.name || !newUser.value.email || !newUser.value.password) {
    alert('Por favor, preencha todos os campos.');
    return;
  }

  try {
    // 2. Enviamos a requisição POST para a API com os dados do formulário
    await useSanctumFetch('/api/users', {
      method: 'POST',
      body: newUser.value // Acessamos .value por ser um 'ref'
    });

    // 3. Se a requisição foi um sucesso:
    isModalVisible.value = false; // Fecha o modal
    
    // Limpa o formulário para a próxima vez
    newUser.value = { name: '', email: '', password: '', roles: '' }; 
    
    // 4. A MÁGICA: Atualiza a lista de usuários sem precisar recarregar a página!
    await refresh(); 
    
  } catch (error) {
    // 5. Se a API retornar um erro (ex: email já existe), ele será mostrado aqui
    console.error("Erro ao criar usuário:", error);
    alert('Ocorreu um erro ao criar o usuário. Verifique o console.');
  }
}
</script>

<style lang="scss" scoped>

</style>