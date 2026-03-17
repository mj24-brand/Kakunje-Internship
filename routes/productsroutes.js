import express from 'express';
import Product from '../module/Product.js';

const router=express.Router();

router.post("/products",async (req,res)=>{
    try{
        const product =new Product(req.body);
        await product.save();
        res.status(201).json(product);
    }catch(error){
        res.status(500).json({message:error.message});
    }
});
router.get("/products", async(req,res)=>{
    try{
        const products=await Product.find();
        res.json(products);
    }catch(error){
        res.status(500).json({message:error.message});
    }
})
export default router;

//access product with their id
router.get("/products/:id",async (req,res)=>{
    try{
        const product=await Product.findById(req.params.id);
        if(!product){
            return res.status(404).json({message:"product not found"});
        }
        res.json(product);
    }catch(error){
        res.status(500).json({message:error.message});
    }
});



//update product
router.put("/products/:id",async (req,res)=>{
    try{
        const updatedProduct=await Product.findByIdAndUpdate(
            req.params.id,
            req.body,
            {new:true}
        );
        if(!updatedProduct){
            return res.status(404).json({message:"product not found"});
        }
        res.json(updatedProduct);
    }catch(error){
        res.status(500).json({message:error.message});
    }
});


//delete product
router.delete("/products/:id",async(req,res)=>{
    try{
        const deletedProduct=await Product.findByIdAndDelete(req.params.id);

        if(!deletedProduct){
            return res.status(404).json({message:"product not found"});
        }
        res.json({message:"product deleted successfully"});
    }catch(error){
        res.status(500).json({message:error.message});
    }
});
