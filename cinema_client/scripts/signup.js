const form = document.getElementById("signup");
const errorBox = document.getElementById("signupError");

const API_BASE = "http://localhost/SE_Factory_applications/cinema_project/cinema_server";

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  errorBox.textContent = "";

  const first_name   = document.getElementById("first_name").value.trim();
  const last_name    = document.getElementById("last_name").value.trim();
  const email        = document.getElementById("email").value.trim();
  const password     = document.getElementById("password").value;
  const phone_number = document.getElementById("phone_number").value.trim();

  try {
    const response = await axios.get(`${API_BASE}/register`, {
      params: { first_name, last_name, email, password, phone_number }
    });

    console.log("Server response:", response.data);

    if (response.data.status === 200 && response.data.payload) {
      localStorage.setItem("user", JSON.stringify(response.data.payload));
      window.location.href = "../index.html";
    } else {
      errorBox.textContent = response.data.error || "Registration failed";
    }
  } catch (err) {
    console.error("Network or server error:", err);
    errorBox.textContent = "Cannot reach server. Try again later.";
  }
});
