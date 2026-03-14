import express from "express";

const app=express();
app.use(express.json());
let products=[
    {id:1,name:"Laptop",price:"50000"},
    {id:2,name:"Mobile", price:"20000"}
];

app.get("/products",(req,res)=>{
    res.json(products);
});
app.post("/products",(req,res)=>{
    const newProduct={
        id:products.length + 1,
        name:req.body.name,
        price:req.body.price
    };
    products.push(newProduct);
    res.status(201).json(newProduct)
});

app.put("/products/:id",(req,res)=>{
    const id=parseInt(req.params.id);
    const product=products.find(p=>p.id===id);
    if(!product){
        return res.status(404).send("product not found");
    }
    product.name=req.body.name;
    product.price=req.body.price;
    res.json(product);
});

app.delete("/products/:id",(req,res)=>{
    const id=parseInt(req.params.id);

    products=products.filter(p=>p.id !==id);
    res.send("Product deleted");
});
app.listen(3000,()=>{
    console.log("server is running");
});