<script setup>

</script>

<template>
  <div class="header">
      <ul>
      <li><RouterLink to="/">Home</RouterLink></li>
      <li><RouterLink to="/turmas">Turmas</RouterLink></li>
      <li><RouterLink to="/alunos">Alunos</RouterLink></li>
      <li><RouterLink to="/turmas/novaturma">Criar Turma</RouterLink></li>
      <li><RouterLink to="/alunos/novoaluno">Criar Aluno</RouterLink></li>
    </ul>
  </div>
</template>

<style scoped>

  .header {
    width: 100%;
    height: 50px;
    background-color: #908d96;
    display: flex;
    /* justify-content: center; */
  }

  .header ul {
    display: flex;
    list-style: none;
    align-items: center;
  }

  .header ul li {
    padding: 8px;
    margin: 0 5px;
    border-radius: 4px;
    transition: .5s;
  }

  .header ul li:hover {
    background-color: #5e5a66;
    transition: .5s;
  }


</style>
