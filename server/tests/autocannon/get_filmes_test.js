'use strict'

const autocannon = require('autocannon')

async function teste () {
    const result = await autocannon({
      url: 'http://localhost:3001/filme/listar', // default
      connections: 10, //numeros de conexões simultaneas
      duration: 60, // segundos
      amount: 300, // numero de requisições até terminar o teste
      overallRate: 5 // numero de requisições por segundo
    })
    console.log(result)
  }

  teste()

  