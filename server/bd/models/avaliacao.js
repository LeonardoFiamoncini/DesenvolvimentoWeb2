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
 
Usuario.hasMany(Avaliacao, {foreignKey: 'usuarioId'})
Avaliacao.belongsTo(Usuario)

Filme.hasMany(Avaliacao, {foreignKey: 'filmeId'})
Avaliacao.belongsTo(Filme)

module.exports = Avaliacao;