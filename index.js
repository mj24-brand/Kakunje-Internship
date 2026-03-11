//const fs=require("fs");
//fs.mkdirSync("newfolder");

//remove folder
//fs.rmdirSync("newfolder");

const fs=require("fs");
fs.writeFile("text.txt","heloooo", (err)=>{
    if(err){
        console.log(err);
    }else{
        console.log("file created");
    }
});