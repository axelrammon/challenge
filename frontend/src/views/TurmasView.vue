<script setup>
  import { deletarTurma, obterTurmas } from '@/services/turmaService'
  import { onMounted, ref } from 'vue'

  const turmas = ref([])
  
  const deletar = async (id) => {
    try {
      await deletarTurma(id)
      const indiceTurma = turmas.value.findIndex(turma=>turma.id == id)
      turmas.value.splice(indiceTurma, 1)
    } catch (error) {
      alert("Erro ao deletar")
    }
  }
  
  onMounted(async () => {
    try {
      const response = await obterTurmas()
      turmas.value = response.data

    } catch (e) {
      console.log('erro: ', e)
    }
  })

</script>

<template>
  <div class="turmas">   
    <div class="overflow-x-auto table-container">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">Nome</th>
            <th class="py-2 px-4 border-b">Ano</th>
            <th class="py-2 px-4 border-b">Período</th>
            <th class="py-2 px-4 border-b">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="turma in turmas" :key="turma.id">
            <td class="py-2 px-4 border-b">{{ turma.nome }}</td>
            <td class="py-2 px-4 border-b">{{ turma.ano }}</td>
            <td class="py-2 px-4 border-b">{{ turma.periodo }}</td>
            <td class="py-2 px-4 border-b">
              <RouterLink :to="`/turmas/${turma.id}`" class="botao_acao" title="Editar">
                <svg
                  style="margin: 0px; fill: #fff;" 
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1em">
                  <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                </svg>
              </RouterLink>
              <button @click="deletar(turma.id)" class="botao_acao" title="Deletar">
                <svg 
                  style="margin: 2px; fill: #fff;"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1em">
                  <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                </svg>
              </button>
              <RouterLink :to="`/turmas/${turma.id}/listar`" title="Alunos">
                <svg 
                  style="margin: 2px; fill: #fff;"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" height="1em">
                  <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/>
                </svg>
              </RouterLink>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style>
  .turmas {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px;
  }

  .turmas > div {
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
    background-color: #3f3f3f;
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
  
  .botao_acao {
    background-color: transparent;
    outline: none;
    border: none;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
  }

  @media (max-width: 600px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 8px;
    }
  }

</style>
