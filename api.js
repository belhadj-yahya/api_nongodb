
let express = require('express'); // for using express for sending and reseving requests
let read_json = require("fs"); //for reading json files yahya you have to learn how to use it
let app = express();
let port = 3000;

//the '/something/:parametars' are endpoints that will trigger a effect
app.use(express.json()); // this line is verey importent its for leting the api turn the json data into an object but only when it send from another file not when we get it from a json file

//syntax for reading json file
/*
  read_json.readfile(path[r],options[o],call back function(error,data from the file))
*/
//syntax for writing in json file
/*
  read_json.writeFile(path[r],data[r],options[o],call back function(error))
*/
app.post('/users',(req,res)=>{
  let jdata = JSON.parse(read_json.readFileSync('data.json'))
  let data = req.body;
  if(!data){
    res.status(400).send("you didnt enter all data")
    return;
  }else{
    for (const element of jdata) {
      if(element.name.trim() == data.name.trim() && element.department.trim() == data.department.trim()){
        res.send("user allready exist")
        // res.json({test:"work"}) // this one allowes you to send json as a respons like {"test":"work"} then you can turn it into array using php if i want 
        return;
       } 
    }
    let id = Number(jdata[jdata.length - 1].id + 1)
    data = {id:id, ...data};
    jdata.push(data)

    res.status(200).send("User Was added");
    try {
      read_json.writeFileSync('data.json',JSON.stringify(jdata),'utf8')
    } catch (error) {
      console.log("an error acured")
    }
    
  }
})
app.get('/users/search/:skill',(req,res)=>{
  console.log("we are in the get request")
   let {skill} = req.params;
   let users_with_skill = [];
   let json_data = JSON.parse(read_json.readFileSync('data.json'))
   for (const element of json_data) {
      for(let i = 0;i < element.skills.length;i++){
         if(element.skills[i].trim() == skill.trim()){
             users_with_skill.push(element)
         }
      }
   }
   if(users_with_skill.length == 0){
    res.send("no user with that skill was found")
   }else{
    res.send(users_with_skill)
   }
})

app.listen(port,()=>{
    console.log("server is running");
})