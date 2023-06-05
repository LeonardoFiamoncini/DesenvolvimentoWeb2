//index.js
(async () => {
    require("dotenv").config();
    const Filme = require("./bd/models/filme.js");
    const Genero = require("./bd/models/genero.js");
    const Usuario = require("./bd/models/usuario.js");
    const Avaliacao = require("./bd/models/avaliacao.js");

    
    const sequelize = require('./bd/config/db.js');
    const express = require("express");
    const cors = require("cors");
    const app = express();
    const PORT = process.env.PORT || 3001;
    
    app.use(cors());
    app.use(express.json());
    
    try {
        await sequelize.sync({ force: true });
    } catch (error) {
        console.log(error);
    }

    app.use("/filme", require("./routes/filme"));
    app.listen(PORT, () => { console.log(`Servidor rodando na porta ${PORT}`) });

})();