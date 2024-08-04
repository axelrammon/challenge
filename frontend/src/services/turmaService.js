import { httpClient } from '@/services/httpClient';

export const obterTurmas = async () => {
    try {
        const response = await httpClient.get('/turmas/')
        return response.data
      } catch (error) {
        throw error
      }
}

export const obterTurmaPorId = async (id) => {
  try {
      const response = await httpClient.get(`/turmas/${id}`)
      return response.data
    } catch (error) {
      throw error
    }
}

export const criarTurma = async (dadosDaTurma) => {
  try {
      const response = await httpClient.post('/turmas/', dadosDaTurma)
      return response.data
    } catch (error) {
      throw error
    }
}

export const salvarTurmaPorId = async (id, dadosDaTurma) => {
  try {
      const response = await httpClient.put(`/turmas/${id}`, dadosDaTurma)
      return response.data
    } catch (error) {
      throw error
    }
}

export const deletarTurma = async (id) => {
  try {
      await httpClient.delete(`/turmas/${id}`)
    } catch (error) {
      throw error
    }
}