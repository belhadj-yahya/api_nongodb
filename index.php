

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>users</title>
</head>
<body>
    <div class="add">
                <?php
                if($_SERVER["REQUEST_METHOD"] === "POST"){

                    $json_data = json_encode([
                        "name" => $_POST['name'],
                        "skills" => $_POST['skill'],
                        "department" => $_POST['department']
                    ]);
                    if(isset($_POST["add"])){
                        $req = curl_init();
                        curl_setopt($req, CURLOPT_URL, "http://localhost:3000/users");
                        curl_setopt($req,CURLOPT_POST,true); //type of request or methode
                        curl_setopt($req, CURLOPT_HTTPHEADER , ['Content-Type: application/json']); //used for header settings this one work not the CURLOPT_HEADER
                        //this $json_data has nothing yet yahya dont forget to add data to it
                        curl_setopt($req, CURLOPT_POSTFIELDS,$json_data); //data that you will send as you see post fields by other meanes place that you put data to be send
                        curl_setopt($req,CURLOPT_RETURNTRANSFER,1); // this one to return the respons not to print it
                        $respond = curl_exec($req); // you will find the response here that why its writen in the top of the page because you are doing a echo to it yahya please focus more
                        if(curl_errno($req)) {
                            echo "cURL Error: " . curl_error($req);
                        } else {
                            echo $respond;
                            curl_close($req); //close the request
                        }
                    }}
                ?>
            <form method = "post">
                <div>
                    <label for="name">name</label>
                    <input type="text" name="name" id="">
                </div>
                <div>
                    <label for="skill">skills</label>
                    <input type="text" name="skill[]" id="" placeholder="skill 1">
                    <input type="text" name="skill[]" id="" placeholder="skill 2">
                    <input type="text" name="skill[]" id="" placeholder="skill 3">
                </div>
                <div>
                    <label for="department">department</label>
                    <input type="text" name="department" id="">                    
                </div>
                <input type="submit" name="add" value="Add User">
            </form>
    </div>
    <div class="search">
        <?php
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET["find"])){
                if(isset($_GET["search_skill"])){
                    $skill = $_GET["search_skill"];
                    $req = curl_init();
                    curl_setopt($req,CURLOPT_URL,"http://localhost:3000/users/search/$skill");
                    curl_setopt($req,CURLOPT_RETURNTRANSFER,true);
                    $res = curl_exec($req);
                    if(curl_errno($req)){
                        echo curl_error($req);
                    }else{
                        echo $res;
                    }
                }else{
                    echo "<p>you have to enter a skill</p>";
                }
                
            }
        }
         
        
        ?>
        <div>
            <form  method="get">
                    <div>
                        <label for="">enter skill</label>
                        <input type="text" name="search_skill" id="">
                    </div>
                    <input type="submit" name="find" value="search">
            </form>
        </div>
    </div>

</body>
</html>