//the request object (req) contains all information sent by client

//1 req.params

import express from "express";
const app=express();
//app.get("/users/:id",(req,res)=>{
  //  const userId=req.params.id;
    //res.send("user id is" + userId);
//});



//2 req.query is used to get data from query parameters in url
//app.get("/products",(req,res)=>{
  //  const category=req.query.category;
    //const price=req.query.price;

    //res.json({
      //  category:category,
        //price:price
    //});
//});

//3. req.body is used to read data sent in request body

//app.use(express.json());

//app.post("/user",(req,res)=>{
  //  const name=req.body.name;
    //const age=req.body.age;

    //res.json({
      //  message:"user created",
        //name:name,
        //age:age
    //})
//})

//4 req.headers contains metadata about the request
app.get("/headers",(req,res)=>{
    const headers=req.headers;
    res.json(headers);

});
app.listen(3000);