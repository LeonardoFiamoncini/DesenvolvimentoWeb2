const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');
const Filme = require('./filme.js');
 
const Genero = sequelize.define('genero', {
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
    descricao: Sequelize.STRING
}, { tableName: 'genero'})
 
Genero.belongsToMany(Filme, {through: 'filme_genero', foreignKey: 'generoId'})
Filme.belongsToMany(Genero, {through: 'filme_genero', foreignKey: 'filmeId'})

module.exports = Genero;