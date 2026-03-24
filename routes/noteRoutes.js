import express from 'express';
import { addNote,deleteNote,getNotes, updateNote } from '../controllers/noteController.js';
import authMiddleware from "../middleware/authMiddleware.js";

const router=express.Router();
router.post("/",authMiddleware,addNote);
router.get("/",authMiddleware,getNotes);
router.put("/:id",authMiddleware,updateNote);
router.delete("/:id",authMiddleware,deleteNote);

export default router;