<script setup>
  import { obterAlunoPorId, salvarAlunoPorId } from '@/services/alunoService';
  import { obterTurmas } from '@/services/turmaService'
  import { onMounted, ref } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();
  const alunoId = route.params.id;
  
  const form = ref({nome: "", email: "", data_nascimento: "", turma_id: ""})
  const errors = ref([])
  const turmas = ref([])

  const salvarAluno = async () => {
    errors.value = []
    try {
      await salvarAlunoPorId(alunoId, form.value)
      alert("Salvo com sucesso")
    } catch (error) {
      errors.value = error.response.data.errors
    }
  }

  onMounted(async () => {
    try {

      const [ responseAluno, responseTurma ] = await Promise.all([obterAlunoPorId(alunoId), obterTurmas()])
      form.value.nome = responseAluno.data.nome
      form.value.email = responseAluno.data.email
      form.value.data_nascimento = responseAluno.data.data_nascimento
      form.value.turma_id = responseAluno.data.turma_id
      
      turmas.value = responseTurma.data.map(turma => {
        return { id: turma.id, nome: turma.nome }
      })
    
    } catch (error) {
      
    }
    
  })


</script>

<template>
  <div class="formulario">
    <form @submit.prevent="salvarAluno">
      <div>
        <input type="text" name="nome" placeholder="Nome" v-model="form.nome">
        <p v-if="errors['nome']">{{ errors['nome'][0]}}</p>
      </div>
      <div>
        <input type="email" name="email" placeholder="E-mail" v-model="form.email">
        <p v-if="errors['email']">{{ errors['email'][0]}}</p>
      </div>
      <div>
        <input type="date" name="data_nascimento" placeholder="Data de nascimento" v-model="form.data_nascimento">
        <p v-if="errors['data_nascimento']">{{ errors['data_nascimento'][0]}}</p>
      </div>
      <div>
        <select
          id="periodo"
          v-model="form.turma_id"      
        >
          <option value="" disabled>Selecionar turma</option>
          <option v-for="turma in turmas" :key="turma.id" :value="turma.id">{{ turma.nome }}</option>
        </select>
        <p v-if="errors['periodo']">{{ errors['periodo'][0]}}</p>
      </div>
      <input type="submit">

    </form>
  </div>
</template>

<style scoped>

  .formulario {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  /* FORMULÁRIO */
  form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  /* CAMPOS DE TEXTO */
  input[type="text"],
  input[type="email"],
  input[type="date"],
  select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  /* BOTÕES */
  input[type="submit"] {
    background-color: #FFAE00;
    color: #000;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  input[type="submit"]:hover {
    background-color: #e4a620;
  }

</style>
