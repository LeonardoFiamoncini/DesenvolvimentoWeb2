let Usuario = require('../bd/models/usuario.js');
const { getUserToken } = require('./auth.js');

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

async function getNome(req, res) {
    try {
        const userId = await getUserToken(req);
        console.log(userId)
        const usuario = await Usuario.findByPk(userId, {attributes: ['nome', 'email']});
        res.status(200).json(usuario);
    } catch (error) {
        res.status(500).json({message: error.message});
    }
}

module.exports = {
    cadastrar,
    getNome
}