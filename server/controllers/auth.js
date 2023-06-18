
const Usuario = require('../bd/models/usuario');
const RefreshToken = require('../bd/models/refreshToken');

const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");

require("dotenv").config();
const moment = require('moment');

async function login(req, res) {
    try {

        const { email, senha } = req.body;
        const usuario = await Usuario.findOne({ where: { email } });
        
        if (!usuario || !usuario?.isPasswordValid(senha)) {
            console.log("senha errada")
            return res.status(405).send({ error: 'Usuário ou senha inválidos' });
        } 

        else {

            const refreshToken = await gerarRefreshToken(usuario.id);
            return res.status(200).send([refreshToken]);
        }


    } catch (error) {
        console.log(error)
        return res.status(500).send(error);
    }

}


async function deslogar(req, res) {
    try {
        const authToken = req.headers.authorization || '';

        if (!authToken){
            
            return res.status(401).send('Ir login');
        }

        const [, token] = authToken.split(' ');

        await RefreshToken.destroy({ where: { token } });
        res.status(204).send();
    } catch (error) {
        res.status(500).json({message: error.message});
    }
}


async function gerarRefreshToken(sub){
    const refreshTokenExpiracao = moment() + 1000 * 60 * 60 * 24 * 30;
    const newRefreshToken = jwt.sign(
        {sub},
        process.env.REFRESH_TOKEN_SECRET,
        { expiresIn: refreshTokenExpiracao }
    )
    try {
        const [refreshToken, created] = await RefreshToken.findOrCreate({
            where: { id: sub },
            defaults: {
                token: newRefreshToken,
                expiresIn: refreshTokenExpiracao
            }
        });
        if (!created) {
            refreshToken.token = newRefreshToken;
            refreshToken.expiresIn = refreshTokenExpiracao;
            await refreshToken.save();
        }
        return newRefreshToken;

    } catch (error) {
        return error;
    }
}

async function getUserToken(req, res) {
    const authToken = req.headers.authorization || '';

    if (!authToken){
        
        return "";
    }

    const [, token] = authToken.split(' ');

    try {
        const payload = jwt.verify(token, process.env.REFRESH_TOKEN_SECRET);
        return payload.sub;
    } catch (error) {
        return error;
    }
}




module.exports = {
    login,
    deslogar,
    getUserToken
}

