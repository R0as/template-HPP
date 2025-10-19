<template>
  <div class="flex justify-between items-center mb-4" v-if="loggedInUser?.roles === 'admin'">
    
    <h1 class="text-xl font-bold">Painel de Usuários</h1>
    
    <button 
      @click="openCreateModal()" 
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
        <button @click="openEditModal(user)" class="cursor-pointer hover:text-blue-800">Editar</button>
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
    
    <form @submit.prevent="saveUser" class="mt-4">
      <div class="flex flex-col gap-4">
        
        <div class="flex flex-col gap-1">
          <label for="name" class="font-semibold">Nome</label>
          <input 
            id="name"
            v-model="userForm.name" 
            type="text" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

        <div class="flex flex-col gap-1">
          <label for="email" class="font-semibold">Email</label>
          <input 
            id="email"
            v-model="userForm.email" 
            type="email" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

        <div class="flex flex-col gap-1">
          <label for="password" class="font-semibold">Senha</label>
          <input 
            id="password"
            v-model="userForm.password" 
            type="password" 
            required
            class="p-2 border rounded-md focus:outline-blue-500"
          />
        </div>

      
        <div class="flex flex-col gap-1">
          <label for="roles" class="font-semibold">Cargo</label>
          <select
            id = "roles"
            v-model="userForm.roles"
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

  const userForm = ref({
  id: '', // O ID começa vazio
  name: '',
  email: '',
  password: '',
  roles: 'funcionario'
});

  async function saveUser() {
  try {
    // Se o formulário TEM um ID, nós estamos EDITANDO
    if (userForm.value.id) {
      await useSanctumFetch(`/api/users/${userForm.value.id}`, {
        method: 'PUT', // Método para ATUALIZAR
        body: userForm.value
      });
    } 
    // Se NÃO TEM um ID, nós estamos CRIANDO
    else {
      await useSanctumFetch('/api/users', {
        method: 'POST', // Método para CRIAR
        body: userForm.value
      });
    }

    // Código que roda em ambos os casos (sucesso)
    isModalVisible.value = false; // Fecha o modal
    await refresh(); // Atualiza a lista na tela

  } catch (error) {
    console.error("Erro ao salvar usuário:", error);
    alert('Ocorreu um erro ao salvar o usuário.');
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

function openCreateModal() {
  // Garante que o formulário esteja limpo
  userForm.value = {
    id: '',
    name: '',
    email: '',
    password: '',
    roles: 'funcionario'
  };
  isModalVisible.value = true;
}

// Função para o botão "Editar"
function openEditModal(userToEdit: User) {
  // Preenche o formulário com os dados do usuário da linha
  userForm.value = { ...userToEdit, password: '' }; // O '...' copia todos os dados. Deixamos a senha em branco por segurança.
  isModalVisible.value = true;
}

</script>

<style lang="scss" scoped>

</style>