import { httpClient } from '@/services/httpClient';

export const obterAlunos = async () => {
    try {
        const response = await httpClient.get('/alunos/')
        return response.data
      } catch (error) {
        throw error
      }
}

export const obterAlunoPorId = async (id) => {
  try {
      const response = await httpClient.get(`/alunos/${id}`)
      return response.data
    } catch (error) {
      throw error
    }
}

export const criarAluno = async (dadosDoAluno) => {
  try {
      const response = await httpClient.post('/alunos/', dadosDoAluno)
      return response.data
    } catch (error) {
      throw error
    }
}

export const salvarAlunoPorId = async (id, dadosDoAluno) => {
  try {
      const response = await httpClient.put(`/alunos/${id}`, dadosDoAluno)
      return response.data
    } catch (error) {
      throw error
    }
}

export const deletarAluno = async (id) => {
  try {
      await httpClient.delete(`/alunos/${id}`)
    } catch (error) {
      throw error
    }
}