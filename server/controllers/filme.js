const { Op } = require("sequelize");
const Filme = require("../bd/models/filme");

async function listar(req, res) {
    const filmes = await Filme.findAll();
    res.json(filmes);
}

async function cadastrar(req, res) {
    const filme = req.body;
    const filmeCadastrado = await Filme.create(filme);
    res.json(filmeCadastrado);
}

module.exports = {
    listar,
    cadastrar
}