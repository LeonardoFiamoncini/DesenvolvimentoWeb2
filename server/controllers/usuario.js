let Usuario = require('../bd/models/usuario.js');

// * Cadastro de usuário
// ! Lembrar de fazer a função de verificar cargos
async function cadastrar(req, res) {
    try {
        const usuario = req.body;
        const usuarioCadastrado = await Usuario.create(usuario);
        res.json(usuarioCadastrado);    
    } catch (error) {
        res.status(500).json({message: error.message});
    }
}

// TODO Função que faz o access token