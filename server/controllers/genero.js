const Genero = require('../bd/models/genero.js');
const Filme = require('../bd/models/filme.js');

// * Função que cadastra um genero
async function cadastrar(req, res) {
    try {
        const genero = req.body;
        const generoCadastrado = await Genero.create(genero);
        res.json(generoCadastrado);    
    } catch (error) {
        res.status(500).json({message: error.message});
    }
    
}

// * Função que lista todos os gêneros
async function listar(req, res) {
    try {
        const generos = await Genero.findAll();
        res.status(200).json(generos);
    } catch (error) {
        res.status(500).json({message: error.message});
    }
}

// * Função que adiciona uma lista de gêneros a um filme
async function addGeneroFilme(req, res){
    try {
        let filmeSelecionado = await Filme.findByPk(req.params.idFilme);
        if (!filmeSelecionado){
            res.status(404).json({message: "Filme não encontrado"});
        }

        for (let genero of req.generos){
            let generoSelecionado = await Genero.findByPk(genero.id);
            if (!generoSelecionado){
                res.status(404).json({message: "Gênero não encontrado"});
            }
            await filmeSelecionado.addGenero(generoSelecionado);
        }
        res.status(200).json({message: "Gêneros adicionados com sucesso"});

    } catch (error) {
        console.log(error)
        res.status(500).json({message: error.message});
    }

}

// * preencher generos com a api
async function preencher_generos(req, res) {
    try {
        const url = `https://api.themoviedb.org/3/genre/movie/list?api_key=${process.env.API_KEY_MOVIE}&language=pt-BR&page=${1}`;
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
                json.genres.forEach(async (genero) => {
                    console.log(genero)
                    const generoCadastrado = await Genero.create({
                        nome: genero.name,
                        id: genero.id
                    });
                });
            })
            .catch(err => console.error('error:' + err));

    } catch (error) {
        console.log(error)
    }
}

async function editar_genero(req, res) {
    try {
        const genero = req.body;
        const generoCadastrado = await Genero.update(genero, {
            where: {
                id: req.params.id
            }
        });
        res.json(generoCadastrado);
    } catch (error) {
        res.status(500).json({message: error.message});
    }
}

module.exports = {
    cadastrar,
    addGeneroFilme,
    preencher_generos,
    listar,
    editar_genero
}