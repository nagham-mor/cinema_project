const form = document.getElementById("login-form");
const errorBox = document.getElementById("loginError");
 

form.addEventListener("submit", async(e)=>{
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    e.preventDefault();

    try{

        //use json.encode in login.php
        // const response = await axios.post("http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/login.php",
        //     {email, password}, 
        //     {headers: { "Content-Type": "application/json" } 
        // });

        //use method get in login.php
        const response = await axios.get("http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/login.php",
            {
                params: { email, password } 
            }
        );

    console.log("Sending:", { email, password });

    if (response.data.ok){
        localStorage.setItem("user", JSON.stringify(response.data.user));
        window.location="../index.html";
    } else{
        errorBox.textContent = response.data.error ||"login failes";
    }
    


    }catch(error){
        console.error("axios error", error);
    };
    
});

