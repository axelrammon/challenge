import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/turmas',
      name: 'turmas',
      component: () => import('../views/TurmasView.vue')
    },
    {
      path: '/turmas/:id',
      name: 'editarturma',
      component: () => import('../views/EditarTurmaView.vue')
    },
    {
      path: '/turmas/:id/listar',
      name: 'listaralunos',
      component: () => import('../views/AlunosTurmaView.vue')
    },
    {
      path: '/turmas/novaturma',
      name: 'novaturma',
      component: () => import('../views/CriarTurmaView.vue')
    },
    {
      path: '/alunos',
      name: 'alunos',
      component: () => import('../views/AlunosView.vue')
    },
    {
      path: '/alunos/:id',
      name: 'editaraluno',
      component: () => import('../views/EditarAlunoView.vue')
    },
    {
      path: '/alunos/novoaluno',
      name: 'novoaluno',
      component: () => import('../views/CriarAlunoView.vue')
    }
  ]
})

export default router
