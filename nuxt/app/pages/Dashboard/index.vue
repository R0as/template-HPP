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

  <table v-if="users" class="w-full">
  <thead>
    <tr class="border-b">
      <th class="p-2 text-left font-bold">Nome</th>
      <th class="p-2 text-left font-bold">Email</th>
      <th class="p-2 text-left font-bold">Função</th>
      <th class="p-2 text-left font-bold">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="user in users" :key="user.id" class="border-b">
      <td class="p-2">{{ user.name }}</td>
      <td class="p-2">{{ user.email }}</td>
      <td class="p-2">{{ user.roles }}</td>
      <td class="p-2 flex flex-row gap-4">
        <button class="cursor-pointer hover:text-blue-800">Editar</button>
        <button @click="deleteUser( user.id )" class="cursor-pointer hover:text-red-800">Excluir</button>
      </td>
    </tr>
  </tbody>
</table>


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

async function deleteUser(userId: string){
  if (!confirm('Você tem certeza que deseja excluir este usuário?')) {
    return;
  }
  try{
    await useSanctumFetch(`/api/users/${userId}`,{
      method: 'DELETE',
    })
    await refresh();
    alert("Usuario excluido com sucesso!")
  }catch(error){
    console.log('Erro ao deletar usuário: ', error);
    alert('Ocorreu um erro ao apagar o usuário. Verifique o console.');
  }
}

definePageMeta({
    layout: 'admin', // Aqui você usa o nome do arquivo 'admin.vue'
});
</script>

<style lang="scss" scoped>

</style>