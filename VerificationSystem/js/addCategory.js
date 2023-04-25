const departmentSelect = document.getElementById("department");
const programsDiv = document.getElementById("programs");
const programInput = document.getElementById("program");
const majorInput = document.getElementById("major");

departmentSelect.addEventListener("change", () => {
  programsDiv.innerHTML = "";
  programsDiv.style.display = "block";
  const selectedDepartment = departmentSelect.value;
  // Here you can fetch the list of programs for the selected department from a server or hardcode them in JavaScript
  const programs = [
    { name: "Program 1", id: "program1" },
    { name: "Program 2", id: "program2" },
    { name: "Program 3", id: "program3" },
  ];
  programs.forEach((program) => {
    const programDiv = document.createElement("div");
    programDiv.innerHTML = program.name;
    programDiv.dataset.programId = program.id;
    programsDiv.appendChild(programDiv);
  });
});

programInput.addEventListener("input", () => {
  majorInput.value = "";
});

majorInput.addEventListener("input", () => {
  programInput.value = "";
});