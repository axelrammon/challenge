<script setup>
  import { deletarAluno, obterAlunos } from '@/services/alunoService' 
  import { onMounted, ref } from 'vue'
  import { obterTurmas } from '@/services/turmaService'

    const alunos = ref([])
   
    const turmas = ref([])
    

    const deletar = async (id) => {
      try {
        // handleDelete()
        await deletarAluno(id)
        const indiceAluno = alunos.value.findIndex(aluno=>aluno.id == id)
        alunos.value.splice(indiceAluno, 1)
      } catch (error) {
        alert("Erro ao deletar")
      }
    }

    onMounted(async () => {
      try {
        const response = await obterAlunos()
        alunos.value = response.data

      } catch (e) {
        console.log('erro: ', e)
      }
    })
</script>

<template>
  <div class="alunos">   
    <div class="overflow-x-auto table-container">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">Nome</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Data de nascimento</th>
            <!-- <th class="py-2 px-4 border-b">Turma</th> -->
            <th class="py-2 px-4 border-b">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="aluno in alunos" :key="aluno.id">
            <td class="py-2 px-4 border-b">{{ aluno.nome }}</td>
            <td class="py-2 px-4 border-b">{{ aluno.email }}</td>
            <td class="py-2 px-4 border-b">{{ aluno.data_nascimento }}</td>
            <!-- <td class="py-2 px-4 border-b">{{ turmas. }}</td> -->
            <td class="py-2 px-4 border-b">
              <RouterLink :to="`/alunos/${aluno.id}`" class="botao_editar">
                <svg
                  style="margin: 0px; fill: #fff;" 
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1em">
                  <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                </svg>
              </RouterLink>
              <button @click="deletar(aluno.id)" class="botao_editar">
                <svg 
                  style="margin: 2px; fill: #fff;"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1em">
                  <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
  
<style>
  .alunos {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px;
  }

  .alunos > div {
    margin: 10px;
  }

  .table-container {
    width: 100%;
    max-width: 800px;
    overflow-x: auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  thead {
    border-bottom: 2px solid #673D20;
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #673D20;
  }

  th {
    font-weight: bold;
  }

  tr:hover {
    background-color: #3f3f3f;
  }

  @media (max-width: 600px) {
    table {
      font-size: 14px;
    }

    th, td {
      padding: 8px;
    }
  }

  .botao_editar {
    background-color: transparent;
    outline: none;
    border: none;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
  }

</style>
  