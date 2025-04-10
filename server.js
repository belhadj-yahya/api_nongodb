const http = require("http");
const express = require("express");
const app = express();
const server = http.createServer((req,res) =>{
    res.writeHead(200, { 'Content-Type': 'text/plain' });
  res.end('Hello, World!');
})
app.get("/ex",(req,res)=>{
    console.log("hello from get")
   res.send("test express")
})
//this listen will work on what you put like here we are tilling it to listen if the app is called so the server code will not be triggered
app.listen(4000,()=>{
    console.log("server is running")
})
