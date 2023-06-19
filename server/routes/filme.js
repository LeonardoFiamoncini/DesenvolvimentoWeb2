const router = require("express").Router();
const filmeController = require("../controllers/filme");
const authMiddleware = require("../middlewares/authMiddleware");

router.get("/listar/:limit/:offset/:genero", authMiddleware([]), filmeController.listar);

router.post("/cadastrar", filmeController.cadastrar);

router.delete("/deletar/:id", filmeController.deletar_filme);

router.get("/preencher_filmes", filmeController.preencher_filmes);

router.get("/preco_filmes", filmeController.distribui_precos);

router.post("/comprar/:id",  authMiddleware([]), filmeController.comprar);

module.exports = router;
