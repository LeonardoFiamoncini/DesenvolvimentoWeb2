const router = require("express").Router();
const filmeController = require("../controllers/filme");
const authMiddleware = require("../middlewares/authMiddleware");

router.get("/listar/:limit/:offset", authMiddleware([]), filmeController.listar);

router.post("/cadastrar", filmeController.cadastrar);

router.get("/preencher_filmes", filmeController.preencher_filmes);

router.get("/preco_filmes", filmeController.distribui_precos);

module.exports = router;
