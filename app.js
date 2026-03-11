//const http = require("http");

//import http from "http";

//const server=http.createServer((req,res)=>{
  //  res.write("welcome to node server");
    //res.end();
//})

//server.listen(3000,()=>{
  //  console.log("Server running on http://localhost:3000");

//});

import http from "http";
const server = http.createServer((req,res)=>{
    console.log("request received:",req.url);
    res.writeHead(200,{"Content-Type":"text/plain"});

    if(req.url==="/"){
        res.write("Welcome to home page");
        console.log("Home page");
    }else if(req.url==="/about"){
         res.write("Welcome to about page");
    }
    else{
        res.write("404 page not found");
    }
    res.end();
});
server.listen(3000,()=>{
    console.log("server is running at http://localhost:3000");
})

