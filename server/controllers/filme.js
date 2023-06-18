const { Op } = require("sequelize");
const Filme = require("../bd/models/filme");
require("dotenv").config();
async function listar(req, res) {
    const filmes = await Filme.findAll();
        
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

async function distribui_precos(req, res){
    try {
        let filmes = await Filme.findAll()
        let listaPrecos = [10.50,10.99,25.00,50.00,12.60, 18.90, 20.00, 19.99, 28.98, 100];
        for (let filme of filmes){
            let preco = listaPrecos[Math.floor(Math.random() * 10)]
            await filme.update({
                preco
            })
        }
        res.status(200)
    } catch (error) {
        console.log(error)
        res.status(500)
    }
}


module.exports = {
    distribui_precos,
    listar,
    cadastrar,
    preencher_filmes
}
