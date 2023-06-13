const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');
const Usuario = require('./usuario.js');
 
const Filme = sequelize.define('filme', {
    id: {
        type: Sequelize.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    nome: {
        type: Sequelize.STRING,
        allowNull: false
    },
    preco: {
        type: Sequelize.DOUBLE
    },
    descricao: Sequelize.STRING,
    imagem: Sequelize.STRING,
    data_lancamento: Sequelize.DATE,
    nota: Sequelize.DOUBLE,
}, { tableName: 'filme'})
 
Filme.belongsToMany(Usuario, {through: 'usuario_filme', foreignKey: 'filmeId'})
Usuario.belongsToMany(Filme, {through: 'usuario_filme', foreignKey: 'usuarioId'})

module.exports = Filme;