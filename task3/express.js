
import express from "express";
const app=express();
const PORT=3000;
app.get("/",(req,res)=>{
    res.send("Welcome to Express Server");
});

app.listen(PORT,()=>{
    console.log("Server running at :", PORT);
})
