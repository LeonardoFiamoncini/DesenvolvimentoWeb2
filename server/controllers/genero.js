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

module.exports = {
    cadastrar,
    addGeneroFilme
}