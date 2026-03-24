import Note from "../models/Note.js";

export const addNote = async (req,res)=>{
    const note=await Note.create({
        userId:req.user.id,
        text:req.body.text
    });
    res.json(note);
};

export const getNotes=async (req,res)=>{
    const notes=await Note.find({userId:req.user.id});
    res.json(notes)
};

export const updateNote = async(req,res)=>{
    try{
        const note=await Note.findById(req.params.id);

        if(!note){
            return res.status(404).json({message:"note not found"});
        }
        note.text=req.body.text || note.text;
        const updatedNote = await note.save();
        res.json(updatedNote);
    }catch(error){
        res.status(500).json({message:error.message});
    }
}

export const deleteNote = async(req,res)=>{
    try{
        const note =await Note.findById(req.params.id);
        if(!note){
            return res.status(404).json({message:"note not found"});
        }
        await note.deleteOne();

        res.json({message:"note deleted"})

    }catch(error){
        res.status(500).json({message:error.message})
    }
}