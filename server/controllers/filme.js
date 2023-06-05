const { Op } = require("sequelize");
const Filme = require("../bd/models/filme");

async function listar(req, res) {
    const filmes = await Filme.findAll();
        
    // const url = 'https://api.themoviedb.org/3/authentication';
    // const options = {
    // method: 'GET',
    // headers: {
    //     accept: 'application/json',
    //     Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhODExNTM2MDYyOWZhNjE0YjZiNDlhMzE5ZDk1MTQ3MyIsInN1YiI6IjY0N2NmMjc4MjYzNDYyMDEzMzcxMjFiMiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ._wgw0d4IZA2zrEUj-3JVaDJaUg5CYNAI9zjPL9gBlV8'
    // }
    // };

    // fetch(url, options)
    // .then(res => res.json())
    // .then(json => console.log(json))
    // .catch(err => console.error('error:' + err));
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