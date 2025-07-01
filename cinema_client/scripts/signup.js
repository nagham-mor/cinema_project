const form = document.getElementById("signup");
const errorBox = document.getElementById("signupError");
 

form.addEventListener("submit", async(e)=>{
    const first_name = document.getElementById("first_name").value.trim();
    const last_name = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const phone_number = document.getElementById("phone_number").value.trim();

    e.preventDefault();

    try{

        //use method get in login.php
        const response = await axios.get("http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/register.php",
            {
               params: {first_name, last_name, email, password, phone_number},
            }
        );

    console.log("Sending:", {first_name, last_name, email, password, phone_number});

    if (response.data.ok){
        localStorage.setItem("user", JSON.stringify(response.data.user));
        window.location="../index.html";
    } else{
        errorBox.textContent = response.data.error ||"Registration failes";
    }
    
    }catch(error){
        console.error("axios error", error);
    };
    
});





        //use json.encode in login.php
        // const response = await axios.post("http://localhost/SE_Factory_applications/cinema_project/cinema_server/controllers/login.php",
        //     {email, password}, 
        //     {headers: { "Content-Type": "application/json" } 
        // });
