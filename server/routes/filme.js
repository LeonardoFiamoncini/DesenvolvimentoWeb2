const router = require("express").Router();
const filmeController = require("../controllers/filme");


router.get("/listar", filmeController.listar);

router.post("/cadastrar", filmeController.cadastrar);

router.get("/preencher_filmes", filmeController.preencher_filmes);

module.exports = router;