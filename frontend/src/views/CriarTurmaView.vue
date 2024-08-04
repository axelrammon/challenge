<script setup>
  import { criarTurma } from '@/services/turmaService';
  import { ref } from 'vue';
  
  const form = ref({nome: "", ano: "", periodo: ""})
  const errors = ref([])

  const limparForm = () => {
    form.value.nome = ""
    form.value.ano = ""
    form.value.periodo = ""
  }

  const criar = async () => {
    errors.value = []
    
    try {
      await criarTurma(form.value)
      limparForm()
      alert("Salvo com sucesso")
    } catch (error) {
      errors.value = error.response.data.errors
    }
  }
</script>

<template>
  <div class="formulario">
    <form @submit.prevent="criar">
      <div>
        <input type="text" name="nome" placeholder="Nome" v-model="form.nome">
        <p v-if="errors['nome']">{{ errors['nome'][0]}}</p>
      </div>
      <div>
        <input type="number" name="ano" placeholder="Ano" v-model="form.ano">
        <p v-if="errors['ano']">{{ errors['ano'][0]}}</p>
      </div>
      <div>
        <select
          id="periodo"
          v-model="form.periodo"
        >
          <option value="" disabled>Selecionar período</option>
          <option value="matutino">Matutino</option>
          <option value="vespertino">Vespertino</option>
          <option value="noturno">Noturno</option>
        </select>
        <p v-if="errors['periodo']">{{ errors['periodo'][0]}}</p>
      </div>
      <input type="submit" value="Criar turma">
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
  input[type="number"],
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