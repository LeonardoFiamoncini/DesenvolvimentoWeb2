const { Op } = require("sequelize");
const Filme = require("../bd/models/filme");
require("dotenv").config();
async function listar(req, res) {
    const filmes = await Filme.findAll({limit: req.params.limit, offset: req.params.offset});
        
    // const url = 'https://api.themoviedb.org/3/authentication';
    // const options = {
    // method: 'GET',
    // headers: {
    //     accept: 'application/json',
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

async function preencher_filmes(req, res) {
    let totalPaginas = 50;
    for (let i = 1; i <= totalPaginas; i++) {
        const url = `https://api.themoviedb.org/3/movie/popular?api_key=${process.env.API_KEY_MOVIE}&language=pt-BR&page=${i}`;
        const options = {
            method: 'GET',
            headers: {
                accept: 'application/json',
                Authorization: process.env.ACESS_TOKEN_MOVIE
            }
        };

        fetch(url, options)
            .then(res => res.json())
            .then(json => {
                console.log(json.results)
                json.results.forEach(async (filme) => {
                    const filmeCadastrado = await Filme.create({
                        nome: filme.title,
                        descricao: filme.overview,
                        nota: filme.vote_average,
                        data_lancamento: filme.release_date,
                        imagem: filme.poster_path
                    });
                });
            })
            .catch(err => console.error('error:' + err));
    }
    res.json({ message: "Filmes cadastrados com sucesso!" });

}


module.exports = {
    listar,
    cadastrar,
    preencher_filmes
}