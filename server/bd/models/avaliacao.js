const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');
const Usuario = require('./usuario.js');
const Filme = require('./filme.js');
 
const Avaliacao = sequelize.define('avaliacao', {
    id: {
        type: Sequelize.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    qtdEstrelas: {
        type: Sequelize.INTEGER,
        allowNull: false
    },
    comentario: Sequelize.STRING
}, { tableName: 'avaliacao'})
 
Avaliacao.hasOne(Usuario, {foreignKey: 'usuarioId'})
Usuario.hasMany(Avaliacao, {foreignKey: 'usuarioId'})

Avaliacao.hasOne(Filme, {foreignKey: 'filmeId'})
Filme.hasMany(Avaliacao, {foreignKey: 'filmeId'})

module.exports = Avaliacao;