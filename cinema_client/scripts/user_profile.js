
document.addEventListener("DOMContentLoaded", () => {
  const data = localStorage.getItem("user");

  if (!data) {
    alert("No user data found. Please log in first.");
    window.location = "login.html";
    return;                       
  }

  const user = JSON.parse(data);
  document.getElementById("firstNameBox").textContent = user.first_name  ?? "";
  document.getElementById("lastNameBox").textContent  = user.last_name   ?? "";
  document.getElementById("emailBox").textContent     = user.email       ?? "";
  document.getElementById("phoneBox").textContent     = user.phone_number ?? "";

  document.getElementById("logoutButton").addEventListener("click", () => {
    localStorage.removeItem("user");
    window.location = "login.html";
  });
});   
