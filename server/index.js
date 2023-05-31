//index.js
(async () => {
    require("dotenv").config();
    const sequelize = require('./bd/config/db.js');
    const express = require("express");
    const cors = require("cors");
    const app = express();
    
    const PORT = process.env.PORT || 3001;
    
    app.use(cors());
    app.use(express.json());
    
    try {
        await sequelize.sync({ force: false });
    } catch (error) {
        console.log(error);
    }

    app.use("/filme", require("./routes/filme"));
    app.listen(PORT, () => { console.log(`Servidor rodando na porta ${PORT}`) });

})();